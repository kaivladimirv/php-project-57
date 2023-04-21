<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    public function run(): void
    {
        TaskStatus::firstOrCreate(['name' => 'новый']);
        TaskStatus::firstOrCreate(['name' => 'в работе']);
        TaskStatus::firstOrCreate(['name' => 'на тестировании']);
        TaskStatus::firstOrCreate(['name' => 'завершен']);
    }
}
