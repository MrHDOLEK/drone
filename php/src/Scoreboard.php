<?php

declare(strict_types=1);

namespace Drone;

use Drone\Game\Game;
use Drone\Game\GameCollection;
use Drone\Team\Team;

class Scoreboard
{
    private GameCollection $games;

    public function startGame(Team $homeTeam, Team $awayTeam): void
    {
        $this->games = new GameCollection();
        $this->games->add(new Game($homeTeam, $awayTeam));
    }

    public function finishGame(Game $game): void
    {
    }

    public function updateScore(Game $game, int $homeScore, int $awayScore): void
    {
        $game->score->setHomeScore($homeScore);
        $game->score->setAwayScore($awayScore);
    }

    public function getSummary(): GameCollection
    {
    }
}
