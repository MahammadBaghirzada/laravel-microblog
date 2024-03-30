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
}
