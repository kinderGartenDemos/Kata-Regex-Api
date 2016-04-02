<?php

use App\RegexGenerator as RegexGenerator;

class RegexGeneratorTest extends PHPUnit_Framework_TestCase {

	protected $generator;

	public function setUp()
	{
		$this->generator = new RegexGenerator;
	}

	/** @test */
	public function itIsObject() 
	{
		$this->assertTrue(is_object($this->generator));
	}

	/** @test */
	public function itCanContainString()
	{
		$regex = $this->generator->find('who');
		$this->assertTrue($regex->test('whoami'));
		$this->assertEquals("/who/", $regex->get());
	}

	/** @test */
	public function itWillFindAnything()
	{
		$regex = $this->generator->anything();
		$this->assertTrue($regex->test('anythingShould_BeTrue'));
	}

	/** @test */
	public function itWillFindMaybeSomething()
	{
		$regex = $this->generator->maybe('https');
		$this->assertTrue($regex->test('https://'));
		$this->assertTrue($regex->test('http'));
		$this->assertEquals("/(?:https)?/", $regex->get());
	}

	/** @test */
	public function itCanBeUsedInChain()
	{
		$regex = $this->generator->anything()->find('@')->anything()->find('.')->anything();
		$this->assertTrue($regex->test('abc@def.de'));
		$this->assertFalse($regex->test('abc@defde'));
	}

	/** @test */
	public function itWillContainsAnythingButCertainString()
	{
		$regex = $this->generator->find('www/')->anythingBut('/');
		$this->assertTrue($regex->test('www/helloworld'));
		$this->assertFalse($regex->test('www//opps'));
	}

	// @todo: beginning of the line;
	// @todo: end of the line;
	// @todo: it can be capital or lowercase;
	// @todo: valid Email Addreass
	// @todo: valid IP Address
	// ...
}