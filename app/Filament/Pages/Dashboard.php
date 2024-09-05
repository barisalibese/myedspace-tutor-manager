<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AverageHourlyRateAndHighestPaidSubjectWidget;
use App\Filament\Widgets\TotalStudentAndTutorWidget;

class Dashboard extends \Filament\Pages\Dashboard
{
    public function getWidgets(): array
    {
        return [
            TotalStudentAndTutorWidget::class,
            AverageHourlyRateAndHighestPaidSubjectWidget::class,
        ];
    }
}
