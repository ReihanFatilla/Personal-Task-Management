<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected $listeners = ['upgradeToPremium' => 'currentUserToPremium']; 

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return TaskResource::getWidgets();
    }

    public function currentUserToPremium(string $id): void 
    { 
        dd('aa');
        $user = User::where('id', $id);
        $user->role = 'premium';
        $user->save();
    } 
    
}
