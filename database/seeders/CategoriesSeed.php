<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        Category::insert([
            [
                'name' => 'Автомобиль'
            ],
            [
                'name' => 'Зарплата'
            ],
            [
                'name' => 'Другие доходы'
            ],
            [
                'name' => 'Кварплата'
            ],
            [
                'name' => 'Налоги'
            ],
            [
                'name' => 'Связь (интернет, моб.)'
            ],
            [
                'name' => 'Транспорт'
            ],
            [
                'name' => 'Здоровье'
            ],
            [
                'name' => 'Продукты'
            ],
            [
                'name' => 'Развлечения'
            ],
            [
                'name' => 'Одежда'
            ],
            [
                'name' => 'Кредиты'
            ]
        ]);
    }
}
