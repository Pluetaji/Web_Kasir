<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Database\Seeder;

class TransactionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trx1 = Transaction::where('invoice_number', 'INV-20261013-0001')->first();
        $trx2 = Transaction::where('invoice_number', 'INV-20261013-0002')->first();

        $nasgor = Product::where('name', 'Nasi Goreng Spesial')->first();
        $esTeh = Product::where('name', 'Es Teh Manis Jumbo')->first();
        $ayamBakar = Product::where('name', 'Ayam Bakar Madu')->first();
        $kopiSusu = Product::where('name', 'Kopi Susu Aren')->first();

        $details = [
            // Details for Transaction 1 (Total: 66,000)
            [
                'transaction_id' => $trx1?->id,
                'product_id' => $nasgor?->id,
                'quantity' => 2,
                'price' => $nasgor ? $nasgor->price : 25000,
                'subtotal' => 2 * ($nasgor ? $nasgor->price : 25000), // 50,000
            ],
            [
                'transaction_id' => $trx1?->id,
                'product_id' => $esTeh?->id,
                'quantity' => 2,
                'price' => $esTeh ? $esTeh->price : 8000,
                'subtotal' => 2 * ($esTeh ? $esTeh->price : 8000), // 16,000
            ],
            // Details for Transaction 2 (Total: 50,000)
            [
                'transaction_id' => $trx2?->id,
                'product_id' => $ayamBakar?->id,
                'quantity' => 1,
                'price' => $ayamBakar ? $ayamBakar->price : 32000,
                'subtotal' => 1 * ($ayamBakar ? $ayamBakar->price : 32000), // 32,000
            ],
            [
                'transaction_id' => $trx2?->id,
                'product_id' => $kopiSusu?->id,
                'quantity' => 1,
                'price' => $kopiSusu ? $kopiSusu->price : 18000,
                'subtotal' => 1 * ($kopiSusu ? $kopiSusu->price : 18000), // 18,000
            ],
        ];

        foreach ($details as $detail) {
            if ($detail['transaction_id'] && $detail['product_id']) {
                TransactionDetail::updateOrCreate(
                    [
                        'transaction_id' => $detail['transaction_id'],
                        'product_id' => $detail['product_id'],
                    ],
                    $detail
                );
            }
        }
    }
}
