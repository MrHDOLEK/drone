<?php

declare(strict_types=1);

namespace Test\Unit;

use Drone\Exception\InsufficientNumberTeamsException;
use Drone\Game\GameBuilder;
use Drone\Game\GameEngine;
use Drone\Team\TeamCollection;
use Exception;
use Tests\TestCase;

class GameEngineTest extends TestCase
{
    private TeamCollection $teamCollection;

    protected function setUp(): void
    {
        parent::setUp();
        $this->teamCollection = GameBuilder::buildFromYaml(self::TEAMS_FILE);
    }

    /**
     * @throws Exception
     */
    public function testCreateGamesFromYamlSuccess(): void
    {
        $gameEngine = new GameEngine();
        $games = $gameEngine->createGames($this->teamCollection);
        $this->assertEquals(4, $games->count());
    }

    /**
     * @throws Exception
     */
    public function testCreateGamesFromYamlThrowsInsufficientNumberTeamsException(): void
    {
        $gameEngine = new GameEngine();

        $this->expectException(InsufficientNumberTeamsException::class);
        $gameEngine->createGames(new TeamCollection());
    }
}
