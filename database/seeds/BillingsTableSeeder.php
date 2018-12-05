<?php

use App\Models\Billing;
use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class BillingsTableSeeder extends Seeder
{
    public function run()
    {
      Billing::create([
        'user_id' => 1,
        'amount' => 12534.56,
        'payment_system' => 'Visa/MasterCard',
        'score' => 1223534534412
      ]);

      Billing::create([
        'user_id' => 1,
        'amount' => 13586.34,
        'payment_system' => 'Visa/MasterCard',
        'score' => 1223534534412,
        'status' => 'done'
      ]);
    }
}
