<?php

namespace Tests\Core\Tasks\Domain\VO;

use App\Core\Tasks\Domain\VO\TaskTimePeriod;
use DomainException;
use Illuminate\Support\Facades\Date;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TaskTimePeriodTest extends TestCase
{
    #[Test]
    public function itShouldCorrectlyInstantiate()
    {
        // Arrange
        $startDate = Date::now()->add('1D')->toDate();
        $endDate = Date::now()->add('2D')->toDate();

        // Act
        $taskTimePeriod = new TaskTimePeriod($startDate, $endDate);

        // Assert
        $this->assertEquals($startDate, $taskTimePeriod->getStart());
        $this->assertEquals($endDate, $taskTimePeriod->getEnd());
    }

    #[Test]
    public function itShouldAllowChangingValue()
    {
        // Arrange
        $startDate = Date::now()->add('1D')->toDate();
        $endDate = Date::now()->add('2D')->toDate();

        $newStartDate = Date::now()->add('2D')->toDate();
        $newEndDate = Date::now()->add('3D')->toDate();

        // Act
        $taskTimePeriod = new TaskTimePeriod($startDate, $endDate);
        $taskTimePeriod->setEnd($newEndDate);
        $taskTimePeriod->setStart($newStartDate);

        // Assert
        $this->assertEquals($newStartDate, $taskTimePeriod->getStart());
        $this->assertEquals($newEndDate, $taskTimePeriod->getEnd());
    }

    #[Test]
    public function itShouldValidateStartDateNotInPast()
    {
        // Arrange
        $startDate = Date::now()->sub('1D')->toDate();
        $endDate = Date::now()->add('2D')->toDate();

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('A task start date must not be in the past');

        // Act
        new TaskTimePeriod($startDate, $endDate);
    }

    #[Test]
    public function itShouldValidateEndDateNotInPast()
    {
        // Arrange
        $startDate = Date::now()->add('1D')->toDate();
        $endDate = Date::now()->add('2D')->toDate();

        $newPastEndDate = Date::now()->sub('2D')->toDate();

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('A task end date must not be in the past');

        // Act
        $timePeriod = new TaskTimePeriod($startDate, $endDate);
        $timePeriod->setEnd($newPastEndDate);
    }

    #[Test]
    public function itShouldValidateStartDatePrecedesEndDate()
    {
        // Arrange
        $startDate = Date::now()->add('1D')->toDate();
        $endDate = Date::now()->add('2D')->toDate();
        $newStartDate = Date::now()->add('3D')->toDate();

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('A task start date must not be after it\'s end date');

        // Act
        $taskPeriod = new TaskTimePeriod($startDate, $endDate);
        $taskPeriod->setStart($newStartDate);
    }

    #[Test]
    public function itShouldValidateEndDateProceedsStartDate()
    {
        // Arrange
        $startDate = Date::now()->add('2D')->toDate();
        $endDate = Date::now()->add('1D')->toDate();

        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('A task end date must not be prior to the start date');

        // Act
        new TaskTimePeriod($startDate, $endDate);
    }
}
