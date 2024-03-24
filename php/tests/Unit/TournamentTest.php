<?php

declare(strict_types=1);

namespace Test\Unit;

use Drone\Tournament;
use ReflectionProperty;
use Tests\TestCase;

class TournamentTest extends TestCase
{
    public function testRunSuccess1(): void
    {
        $tournament = $this->getMockBuilder(Tournament::class)
            ->setConstructorArgs([self::TEAMS_FILE])
            ->getMock();

        $tournament->expects($this->once())
            ->method("run");

        $tournament->run();
    }

    public function testRunSuccess2(): void
    {
        $tournament = new Tournament(self::TEAMS_FILE);

        $tournament->run();

        $reflectionTeams = new ReflectionProperty(Tournament::class, "teams");
        $reflectionTeams->setAccessible(true);

        $reflectionScoreboard = new ReflectionProperty(Tournament::class, "scoreboard");
        $reflectionScoreboard->setAccessible(true);

        $this->assertEquals(1, $reflectionTeams->getValue($tournament)->count());
        $this->assertEquals(7, $reflectionScoreboard->getValue($tournament)->count());
    }
}
