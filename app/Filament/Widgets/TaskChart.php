<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\PieChartWidget;

class TaskChart extends PieChartWidget
{
    protected static ?string $heading = 'Task Improvement';

    protected function getData(): array
    {
        $pieColor = [];

        foreach ([1, 2, 3] as $count) {
            $red = random_int(0, 255);
            $green = random_int(0, 255);
            $blue = random_int(0, 255);

            array_push($pieColor, "rgb($red, $green, $blue)");
        }

        return [
            'datasets' => [
                [
                    'label' => 'Task Status Chart',
                    'data' => Task::select(DB::raw("COUNT(*) as count"))
                        ->groupBy("status")
                        ->orderBy("status")
                        ->pluck('count'),
                    'backgroundColor' => $pieColor,
                ],
            ],
            'labels' => [
                'Finished',
                'In Progress',
                'Not Started',
            ]
        ];
    }

    public static function canView(): bool 
    {
        return auth()->user()->role == 'premium';
    } 
}
