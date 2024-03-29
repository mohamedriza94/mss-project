<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Lock Hood',
            'email' => 'lh@gmail.com',
        ]);

        \App\Models\Warehouse::factory()->create([
            'warehouseNo' => '0001',
            'location' => '-',
            'username' => 'warehouse_one',
        ]);

        \App\Models\Administrator::factory()->create([
            'username' => 'LockHood',
        ]);
    }
}
