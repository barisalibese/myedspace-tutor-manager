<?php

namespace App\Filament\Actions;

use App\Services\TutorService;
use Closure;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;

class TutorBulkRateChangeUpdateAction extends BulkAction
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->label('Update Hourly Rates');
        $this->form($this->form);
        $this->action(function (Collection $records, array $data) {
            $tutorService = new TutorService;

            try {
                $message = $tutorService->updateHourlyRates($records, $data['percentage'], $data['type']);
                Notification::make()
                    ->title($message)
                    ->success()
                    ->send();

                return 'Bulk action completed successfully';
            } catch (\Exception $exception) {
                Notification::make()->title($exception->getMessage())->warning()->send();

                return 'Bulk action failed with error';
            }
        });
        $this->requiresConfirmation()
            ->modalHeading('Are you sure?')
            ->modalSubheading('This action will update the hourly rates for the selected tutors.')
            ->modalButton('Yes, update rates');

    }

    public function form(array|Closure|null $form): static
    {
        $this->form = [
            TextInput::make('percentage')
                ->label('Percentage')
                ->numeric()
                ->required(),
            Radio::make('type')
                ->label('Increase/Decrease')
                ->options(['increase' => 'increase', 'decrease' => 'decrease'])
                ->required(),
        ];

        return $this;
    }
}
