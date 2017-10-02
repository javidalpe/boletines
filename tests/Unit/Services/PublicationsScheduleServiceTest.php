<?php


namespace Tests\Unit\Services;


use App\Services\PublicationsScheduleService;
use App\Services\ScrapingService;
use Carbon\Carbon;
use Tests\TestCase;;

class PublicationsScheduleServiceTest extends TestCase
{
    public function testNational()
    {
        $service = new PublicationsScheduleService();
        Carbon::setTestNow(Carbon::create(2017, 10, 1)); //SUNDAY
        $this->assertFalse($service->isTodayAPublicationDay(ScrapingService::PRIORITY_NATIONAL));

        Carbon::setTestNow(Carbon::create(2017, 10, 2)); //MONDAY
        $this->assertTrue($service->isTodayAPublicationDay(ScrapingService::PRIORITY_NATIONAL));

        Carbon::setTestNow(Carbon::create(2017, 10, 7)); //SATURDAY
        $this->assertTrue($service->isTodayAPublicationDay(ScrapingService::PRIORITY_NATIONAL));
    }

    public function testAdministrativeLevel1()
    {
        $service = new PublicationsScheduleService();
        Carbon::setTestNow(Carbon::create(2017, 10, 1)); //SUNDAY
        $this->assertFalse($service->isTodayAPublicationDay(ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1));

        Carbon::setTestNow(Carbon::create(2017, 10, 2)); //MONDAY
        $this->assertTrue($service->isTodayAPublicationDay(ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1));

        Carbon::setTestNow(Carbon::create(2017, 10, 7)); //SATURDAY
        $this->assertFalse($service->isTodayAPublicationDay(ScrapingService::PRIORITY_ADMINISTRATIVE_AREA_1));
    }
}