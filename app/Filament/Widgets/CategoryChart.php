<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\PieChartWidget;

class CategoryChart extends PieChartWidget
{
    protected static ?string $heading = 'Category Used';



    protected function getData(): array
    {

        $categoryCount = Category::withCOunt('tasks')
            ->orderBy('name')
            ->pluck('tasks_count');

        $pieColor = [];

        foreach ($categoryCount as $count) {
            $red = random_int(0, 255);
            $green = random_int(0, 255);
            $blue = random_int(0, 255);

            array_push($pieColor, "rgb($red, $green, $blue)");
        }

        return [
            'datasets' => [
                [
                    'label' => 'Task Status Chart',
                    'data' => $categoryCount,
                    'backgroundColor' => $pieColor,
                ],
            ],
            'labels' => Category::withCOunt('tasks')
                ->orderBy('name')
                ->pluck('name')
        ];
    }
}
