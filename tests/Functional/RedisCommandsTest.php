<?php

namespace Pantheon\Terminus\Tests\Functional;

use Pantheon\Terminus\Tests\Traits\LoginHelperTrait;
use Pantheon\Terminus\Tests\Traits\TerminusTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * Class RedisCommandsTest
 *
 * @package Pantheon\Terminus\Tests\Functional
 */
class RedisCommandsTest extends TestCase
{
    use TerminusTestTrait;
    use LoginHelperTrait;

    /**
     * @test
     * @covers \Pantheon\Terminus\Commands\Redis\EnableCommand
     *
     * @group redis
     * @group short
     */
    public function testRedisEnable()
    {
        $this->terminus("redis:enable {$this->getSiteName()}");
    }

    /**
     * @test
     * @covers \Pantheon\Terminus\Commands\Redis\DisableCommand
     *
     * @group redis
     * @group short
     */
    public function testRedisDisable()
    {
        $this->terminus("redis:disable {$this->getSiteName()}");
    }
}
