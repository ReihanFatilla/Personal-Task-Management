<?php

namespace Database\Factories;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{

    protected $model = Task::class;

    public function definition(): array
    {
        $faker = $this->faker;
        $monthStartDate = Carbon::now()->startOfMonth();
        $monthEndDate = Carbon::now()->endOfMonth();
        $dueTime = $faker->dateTimeBetween($monthStartDate, $monthEndDate)->format('H:i:s');
        
        return [
            'title' => $faker->sentence,
            'description' => $faker->paragraph,
            'due_date' => $faker->date(),
            'due_time' => $dueTime,
            'status' => $faker->randomElement(['Finished', 'In Progress', 'Not Started']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
