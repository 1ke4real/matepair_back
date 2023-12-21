<?php

namespace App\Tests;

use App\Entity\Demo;
use PHPUnit\Framework\TestCase;

class UtilTest extends TestCase
{
    public function testDemo()
    {
        $demo = new Demo();

        $demo->setTest('demo');

        $this->assertTrue($demo->getTest() === 'demo');
    }
}
