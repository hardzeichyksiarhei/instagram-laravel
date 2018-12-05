<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
      Setting::create([
        'referral_discount' => 5.00
      ]);
    }
}
