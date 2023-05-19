<?php

namespace Database\Seeders;

use App\Models\Adopt\Adopt;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdoptSeeder extends Seeder
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

            for($i=0; $i < 50; $i++){
                Adopt::create([
                    'user_id' => $admin->id,
                    'status' => rand(1,10) >= 9 ? 0 : 1,
                    'name' => $faker->sentence(3),
                    'image' =>"https://picsum.photos/id/{$i}/500/500",
                    'breed' =>rand(1,10) >= 5 ? $faker->sentence(2) : $faker->sentence(1),
                    'age' => rand(1,15),
                    'location' => $faker->address(),
                    'description' => $faker->paragraph(3),
                     'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

            }
        }catch (\Exception $e){
            \Log::info($e);
        }
    }
}
