<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cashier1 = User::where('email', 'siti@pos.com')->first();
        $cashier2 = User::where('email', 'budi@pos.com')->first();

        // Transaction 1: Dine In, Cash payment
        Transaction::updateOrCreate(
            ['invoice_number' => 'INV-20261013-0001'],
            [
                'user_id' => $cashier1?->id,
                'customer_name' => 'Andi Pratama',
                'order_type' => 'Dine In',
                'total_price' => 66000,
                'payment_method' => 'Tunai',
                'cash_received' => 70000,
                'change_amount' => 4000,
                'status' => 'Success',
            ]
        );

        // Transaction 2: Take Away, QRIS payment
        Transaction::updateOrCreate(
            ['invoice_number' => 'INV-20261013-0002'],
            [
                'user_id' => $cashier2?->id,
                'customer_name' => 'Citra Kirana',
                'order_type' => 'Take Away',
                'total_price' => 50000,
                'payment_method' => 'QRIS',
                'cash_received' => null,
                'change_amount' => null,
                'status' => 'Success',
            ]
        );
    }
}
