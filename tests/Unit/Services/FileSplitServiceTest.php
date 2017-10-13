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

		$this->assertEquals(["12", "3412"], $service->splitDocument("12\n34123"));
		$this->assertEquals(["12", "3412", "34"], $service->splitDocument("12\n\n341234"));
		$this->assertEquals(["12", "3412", "345"], $service->splitDocument("\n 12\n\n3412345"));

		$this->assertEquals(["123", "41", "2341", "234"], $service->splitDocument("123\n41\n2341234"));

        $this->assertEquals(["12", "3412"], $service->splitDocument("12 34123"));
        $this->assertEquals(["12", "3412", "34"], $service->splitDocument("12  341234"));
        $this->assertEquals(["12", "3412", "345"], $service->splitDocument("  12  3412345"));

        $this->assertEquals(["123", "41", "2341", "234"], $service->splitDocument("123 41 2341234"));

        $this->assertEquals(["12", "3412"], $service->splitDocument("12\n 34123"));
        $this->assertEquals(["12", "3412", "34"], $service->splitDocument("12 \n\n 341234"));
        $this->assertEquals(["12", "3412", "345"], $service->splitDocument("  12  \n3412345"));

        $this->assertEquals(["123", "41", "2341", "234"], $service->splitDocument("123\n 41 \n2341234"));

	}
}