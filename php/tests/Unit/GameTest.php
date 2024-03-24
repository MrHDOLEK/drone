<?php

declare(strict_types=1);

namespace Test\Unit;

use Drone\Game\Game;
use Drone\Game\GameBuilder;
use Drone\Game\GameEngine;
use Tests\TestCase;

class GameTest extends TestCase
{
    private Game $game;

    public function setUp(): void
    {
        $teamCollection = GameBuilder::buildFromYaml(self::TEAMS_FILE);

        $gameEngine = new GameEngine();
        $games = $gameEngine->createGames($teamCollection);

        $this->game = $games->items()[0];
    }

    public function testWinnerSuccess(): void
    {
        $this->game->score()->addHomeScore();

        $this->assertEquals($this->game->homeTeam(), $this->game->winner());
    }

    public function testWinnerSuccess2(): void
    {
        $this->game->score()->addAwayScore();

        $this->assertEquals($this->game->awayTeam(), $this->game->winner());
    }

    public function testDrawWinnerSuccess(): void
    {
        $this->game->score()->addAwayScore();
        $this->game->score()->addHomeScore();

        $this->assertEquals($this->game->awayTeam(), $this->game->winner());
    }
}
