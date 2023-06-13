<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class TaskStats extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make(
                'Get Premium to see your Stats',
                'Only 1$'
            )->description('Tap Here to Upgrade')
            ->color('success')
            ->extraAttributes([
                'wire:click' => '$emit("upgradeToPremium", "'.auth()->user()->id.'")',
                'class' => 'transition hover:text-primary-500 cursor-pointer',
            ])
        ];
    }

    public static function canView(): bool 
    {
        return auth()->user()->role == 'free';
    }
}
