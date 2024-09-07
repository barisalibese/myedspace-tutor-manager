<?php

namespace Tests\Feature;

use App\Filament\Pages\Dashboard;
use App\Filament\Widgets\AverageHourlyRateAndHighestPaidSubjectWidget;
use App\Filament\Widgets\TotalStudentAndTutorWidget;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DashboardIntegrationTest extends TestCase
{
    use DatabaseTransactions;
    public function testDashboardDisplaysCorrectWidgets()
    {
        $dashboard = new Dashboard();

        $widgets = $dashboard->getWidgets();

        $this->assertContains(TotalStudentAndTutorWidget::class, $widgets);
        $this->assertContains(AverageHourlyRateAndHighestPaidSubjectWidget::class, $widgets);
    }
}
