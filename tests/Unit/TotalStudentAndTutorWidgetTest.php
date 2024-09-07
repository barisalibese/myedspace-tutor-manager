<?php

namespace Tests\Unit;

use App\Filament\Widgets\AverageHourlyRateAndHighestPaidSubjectWidget;
use App\Filament\Widgets\TotalStudentAndTutorWidget;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class
TotalStudentAndTutorWidgetTest extends TestCase
{
    use DatabaseTransactions;

    public function test_total_student_and_tutors_widget_can_be_rendered()
    {
        $widget = new TotalStudentAndTutorWidget();
        $view = $widget->render();

        $this->assertNotEmpty($view); // Check if the view content is not empty
        // Add more assertions based on what you expect the widget to contain
    }
}
