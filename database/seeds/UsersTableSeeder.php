<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $limit = 10;
        $genders = ['female', 'male'];

        // Create readers
        for ($i=0; $i < $limit; $i++) {
            $gender = $genders[array_rand($genders, 1)];

            DB::table('users')->insert([
                'name' => $faker->firstName($gender) . ' ' . $faker->lastName($gender),
                'email' => $faker->safeEmail(),
                'password' => Hash::make('testpass'),
                'role' => 'reader',
                'receive_notifications' => $faker->numberBetween(0,1),
                'created_at' =>\Carbon\Carbon::now(),
                'updated_at' =>\Carbon\Carbon::now(),
            ]);
        }

        $categories = factory(App\Category::class, 10)->create();
        // Create authors
        $users = factory(App\User::class, 5)->create();

        $bookLimit = 20;
        for ($i=0; $i < $bookLimit; $i++) {
            DB::table('books')->insert([
                'title' => $faker->realText(15),
                'description' => $faker->realText(150),
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'image' => $faker->numberBetween(1, 5) . '.jpg',
                'created_at' =>\Carbon\Carbon::now(),
                'updated_at' =>\Carbon\Carbon::now(),
            ]);
        }
    }
}
