<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Wailan Tirajoh',
                'email' => 'wailantirajoh@gmail.com',
                'password' => bcrypt('wailan'),
            ],
            [
                'name' => 'Putri Rinding',
                'email' => 'putririnding21@gmail.com',
                'password' => bcrypt('putri'),
            ],
        ];

        foreach ($users as $user) {
            $user = User::create($user);
        }
    }
}
