<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\State;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //User::factory()->create([
        //    'name' => 'Test User',
        //    'email' => 'test@example.com',
        //]);

        //State::factory()->create();

        //$this->call([
        //    StateSeeder::class
        //]);

        Device::factory(2)->create();
    }
}
