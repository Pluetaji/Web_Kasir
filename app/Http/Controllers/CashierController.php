<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CashierController extends Controller
{
    /**
     * Display the cashier POS interface with active products and categories.
     */
    public function index(Request $request): View
    {
        // Ensure access is restricted to authenticated users with cashier or manager role
        if (!in_array($request->user()?->role, ['kasir', 'manager'])) {
            abort(403, 'Akses tidak diizinkan untuk peran ini.');
        }

        $categories = Category::all();
        $products = Product::where('is_active', true)->with('category')->get();

        return view('kasir', compact('categories', 'products'));
    }

    /**
     * Process checkout transaction and save order details.
     */
    public function checkout(Request $request): JsonResponse
    {
        if (!in_array($request->user()?->role, ['kasir', 'manager'])) {
            return response()->json(['success' => false, 'message' => 'Akses tidak diizinkan.'], 403);
        }

        $validated = $request->validate([
            'cart' => 'required|array|min:1',
            'cart.*.id' => 'required|exists:products,id',
            'cart.*.qty' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:100',
            'order_type' => 'required|in:Dine In,Take Away',
            'payment_method' => 'required|in:Tunai,QRIS,Kartu Debit',
            'cash_received' => 'nullable|numeric|min:0',
        ]);

        $productIds = collect($validated['cart'])->pluck('id');
        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        $totalPrice = 0;
        $details = [];

        foreach ($validated['cart'] as $item) {
            $product = $products->get($item['id']);
            if (!$product) continue;

            $qty = (int) $item['qty'];
            $price = (int) $product->price;
            $subtotal = $qty * $price;
            $totalPrice += $subtotal;

            $details[] = [
                'product_id' => $product->id,
                'quantity' => $qty,
                'price' => $price,
                'subtotal' => $subtotal,
            ];
        }

        if (empty($details) || $totalPrice <= 0) {
            return response()->json(['success' => false, 'message' => 'Keranjang kosong atau produk tidak valid.'], 422);
        }

        $paymentMethod = $validated['payment_method'];
        $cashReceived = $paymentMethod === 'Tunai'
            ? (int) ($validated['cash_received'] ?? $totalPrice)
            : $totalPrice;

        if ($paymentMethod === 'Tunai' && $cashReceived < $totalPrice) {
            return response()->json([
                'success' => false,
                'message' => 'Uang tunai yang diterima kurang dari total tagihan.'
            ], 422);
        }

        $changeAmount = $paymentMethod === 'Tunai' ? max(0, $cashReceived - $totalPrice) : 0;
        $customerName = trim($validated['customer_name']);

        // Generate invoice number: INV-YYYYMMDD-XXXX
        $invoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        $transaction = DB::transaction(function () use ($request, $invoiceNumber, $customerName, $validated, $totalPrice, $paymentMethod, $cashReceived, $changeAmount, $details) {
            $tx = Transaction::create([
                'invoice_number' => $invoiceNumber,
                'user_id' => $request->user()->id,
                'customer_name' => $customerName,
                'order_type' => $validated['order_type'],
                'total_price' => $totalPrice,
                'payment_method' => $paymentMethod,
                'cash_received' => $cashReceived,
                'change_amount' => $changeAmount,
                'status' => 'Success',
            ]);

            foreach ($details as $detail) {
                $tx->transactionDetails()->create($detail);
            }

            return $tx;
        });

        return response()->json([
            'success' => true,
            'transaction_id' => $transaction->id,
            'invoice_number' => $transaction->invoice_number,
            'total_price' => $transaction->total_price,
            'cash_received' => $transaction->cash_received,
            'change_amount' => $transaction->change_amount,
        ]);
    }

    /**
     * Display printable receipt for thermal printer.
     */
    public function receipt($id): View
    {
        $transaction = Transaction::with(['transactionDetails.product', 'user'])->findOrFail($id);
        return view('struk', compact('transaction'));
    }
}
