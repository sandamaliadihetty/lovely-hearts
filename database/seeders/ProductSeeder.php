<?php

namespace Database\Seeders;

use App\Models\Shop\Product;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $faker = Factory::create();
            //select admin by email
            $admin = User::where('email', 'sandamali.adihetty@gmail.com')->first();

            for($i=0; $i < 200; $i++){
                Product::create([
                    'user_id' => $admin->id,
                    'status' => rand(1,10) >= 9 ? Product::INACTIVE : Product::ACTIVE,
                    'title' => $faker->sentence(3),
                    'description' => $faker->paragraph(2,true),
                    'image' => "https://picsum.photos/id/{$i}/500/500",
                    'price' => rand(10,63) * 100,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }catch (\Exception $e){
            \Log::info($e);
        }

    }
}
