<?php

namespace App\Filament\Widgets;

use App\Services\StudentService;
use App\Services\TutorService;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalStudentAndTutorWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $studentService = new StudentService;
        $tutorService = new TutorService;

        return [
            Stat::make('Total Students', $studentService->getTotalNumberOfRegisteredStudents()),
            Stat::make('Total Active Tutors', $tutorService->getTotalActiveTutors()),
        ];
    }
}
