<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChoiceSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        DB::table('choices')->insert([
            ['name' => 'Option 1', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Option 2', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Option 3', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Option 4', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}