<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class AnotherExampleTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
        $this->assertFalse(1 == '10');
    }

    public function testContains()
    {
        $this->assertContains(4, [1, 2, 3, 4]);
    }

    public function testCount()
    {
        $this->assertCount(1, ['foo']);
    }

    public function testEmpty()
    {
        $this->assertEmpty([]);
        $this->assertNotEmpty([1]);
    }

    public function testEquals1()
    {
        $this->assertEquals(1, 1);
    }

    public function testEquals2()
    {
        $this->assertEquals('bar', 'bar');
    }

    public function testEquals3()
    {
        $this->assertEquals(['a', 'b', 'c'], ['a', 'b', 'c']);
    }

    public function testEquals4()
    {
        $expected = new \stdClass();
        $expected->foo = 'foo';
        $expected->bar = 'bar';

        $actual = new \stdClass();
        $actual->foo = 'foo';
        $actual->bar = 'bar';

        $this->assertEquals($expected, $actual);
    }

    public function testGreaterThan()
    {
        $this->assertGreaterThan(1,2);
    }

    public function testLessThan()
    {
        $this->assertLessThan(2,1);
    }
}
