<?php

namespace App\Filament\Widgets;

use App\Services\TutorService;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AverageHourlyRateAndHighestPaidSubjectWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $tutorService = new TutorService;

        return [
            Stat::make('Average tutor hourly rate', $tutorService->getAverageHourlyRate()),
            Stat::make('HighestPaidSubject', $tutorService->getHighestPaidSubject()),
        ];
    }
}
