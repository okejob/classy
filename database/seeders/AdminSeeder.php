<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'vincent',
            'password' => Hash::make('test1234'),
            'name' => 'Vincent',
            'phone' => '081239687792',
            'address' => 'surabaya',
            'email' => 'vincentiusmandala@gmail.com',
            'status' => 'A',
        ])->assignRole('administrator');

        User::create([
            'username' => 'mitchell',
            'password' => Hash::make('test1234'),
            'name' => 'Mitchel',
            'phone' => '0888888888',
            'address' => 'surabaya',
            'email' => 'mitchel@gmail.com',
            'status' => 'A',
        ])->assignRole('administrator');
    }
}
