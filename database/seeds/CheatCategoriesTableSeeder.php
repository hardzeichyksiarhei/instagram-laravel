<?php

use App\Models\CheatCategory;
use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class CheatCategoriesTableSeeder extends Seeder
{
    public function run()
    {
      CheatCategory::create([
        'name' => 'Подписчики'
      ]);

      CheatCategory::create([
        'name' => 'Лайки'
      ]);

      CheatCategory::create([
        'name' => 'Просмотры'
      ]);

      CheatCategory::create([
        'name' => 'Комментарии'
      ]);

      CheatCategory::create([
        'name' => 'Статистика'
      ]);
    }
}
