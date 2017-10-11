<?php


namespace Tests\Unit\Services;


use App\Services\FileSplitService;
use Tests\TestCase;

class FileSplitServiceTest extends TestCase
{
	public function testBasic()
	{
		$service = new FileSplitService(4, 2);

		$this->assertEquals(["1234"], $service->splitDocument("1234"));
		$this->assertEquals(["1234"], $service->splitDocument(" 1234 "));
		$this->assertEquals(["1234", "1234"], $service->splitDocument("12341234"));
		$this->assertEquals(["1234", "1234"], $service->splitDocument("123412341"));
		$this->assertEquals(["1234", "1234", "12"], $service->splitDocument("1234123412"));

		$this->assertEquals(["12 3", "4123"], $service->splitDocument("12\n341234"));
		$this->assertEquals(["12 3", "4123"], $service->splitDocument("12\n\n341234"));
		$this->assertEquals(["12 3", "4123", "45"], $service->splitDocument("\n 12\n\n3412345"));

		$this->assertEquals(["123", "41 2", "3412", "34"], $service->splitDocument("123\n41\n2341234"));

	}
}