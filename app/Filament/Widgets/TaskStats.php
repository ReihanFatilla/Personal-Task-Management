<?php

namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class TaskStats extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make(
                'Finished',
                Task::where('status', 'Finished')->count()
            )->color('success'),
            Card::make(
                'In Progress',
                Task::where('status', 'In Progress')->count()
            )->color('danger'),
            Card::make(
                'Not Started',
                Task::where('status', 'Not Started')->count()
            )
        ];
    }
}
