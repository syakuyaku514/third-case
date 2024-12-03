<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = [
            ['name' => 'クレジットカード'],
            ['name' => '銀行振込'],
            ['name' => 'コンビニ払い'],
        ];

        foreach ($payments as $payment) {
            Payment::updateOrCreate(['name' => $payment['name']], $payment);
        }
    }
}
