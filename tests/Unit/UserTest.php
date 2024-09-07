<?php

namespace Tests\Unit;

use App\Filament\Widgets\AverageHourlyRateAndHighestPaidSubjectWidget;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class
UserTest extends TestCase
{
    use DatabaseTransactions;

    public function test_user_can_be_created_successfully()
    {
        $user=User::factory()->create(['name'=>'TEST','email'=>'test@test.com']);
        $this->assertDatabaseHas('users',['name'=>'TEST','email'=>'test@test.com']);
    }
}
