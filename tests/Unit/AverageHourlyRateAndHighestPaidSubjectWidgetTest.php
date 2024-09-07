<?php

namespace Tests\Unit;

use App\Filament\Widgets\AverageHourlyRateAndHighestPaidSubjectWidget;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class
AverageHourlyRateAndHighestPaidSubjectWidgetTest extends TestCase
{
    use DatabaseTransactions;

    public function test_average_hourly_rate_and_highest_paid_subject()
    {
        $widget = new AverageHourlyRateAndHighestPaidSubjectWidget();
        $view = $widget->render();

        $this->assertNotEmpty($view); // Check if the view content is not empty
        // Add more assertions based on what you expect the widget to contain
    }
}
