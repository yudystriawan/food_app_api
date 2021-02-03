<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Food;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Food::truncate();
        Transaction::truncate();
        DB::table('category_food')->truncate();

        // To remove event listener from provider like send email verification
        User::flushEventListeners();
        Category::flushEventListeners();
        Food::flushEventListeners();
        Transaction::flushEventListeners();

        $userQuantity = 1000;
        $categoryQuantity = 30;
        $foodQuantity = 1000;
        $transactionQuantity = 1000;

        User::factory()->count($userQuantity)->create();
        Category::factory()->count($categoryQuantity)->create();

        Food::factory()->count($foodQuantity)->create()->each(
            function($food)
            {
                $categories = Category::all()->random(mt_rand(1,5))->pluck('id');

                $food->categories()->attach($categories);
            }
        );

        Transaction::factory()->count($transactionQuantity)->create();
    }
}
