<?php

namespace Database\Seeders;

use App\Models\Diagnostic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiagnosticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Diagnostic::factory(6)->create();
    }
}
