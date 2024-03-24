<?php

declare(strict_types=1);

namespace Drone\Game;

use Drone\Exception\InsufficientNumberTeamsException;
use Drone\Team\Team;
use Drone\Team\TeamCollection;
use Exception;

class GameEngine
{
    private const MINIMAL_AMOUNT_TEAM = 2;

    /**
     * @throws Exception
     */
    public function createGames(TeamCollection $teamCollection): GameCollection
    {
        if ($teamCollection->count() < self::MINIMAL_AMOUNT_TEAM) {
            throw new InsufficientNumberTeamsException();
        }

        $games = new GameCollection();

        $iterator = $teamCollection->count() / self::MINIMAL_AMOUNT_TEAM;

        for ($i = 0; $i < $iterator; $i++) {
            $games->add($this->createGame($teamCollection));
        }

        return $games;
    }

    public function simulateGame(Game $game): Game
    {
        $homeTeamWeight = $this->calculateScoreBasedOnWeight($game->homeTeam());
        $awayTeamWeight = $this->calculateScoreBasedOnWeight($game->awayTeam());

        if ($homeTeamWeight > $awayTeamWeight) {
            $game->score()->addHomeScore();
        }
        $game->score()->addAwayScore();

        return $game;
    }

    /**
     * @throws InsufficientNumberTeamsException
     */
    private function createGame(TeamCollection $teamCollection): Game
    {
        if ($teamCollection->count() < self::MINIMAL_AMOUNT_TEAM) {
            throw new InsufficientNumberTeamsException();
        }

        $homeTeam = $teamCollection->getRandomTeam();
        $teamCollection->remove($homeTeam);
        $awayTeam = $teamCollection->getRandomTeam();
        $teamCollection->remove($awayTeam);

        return new Game(
            $homeTeam,
            $awayTeam,
        );
    }

    private function calculateScoreBasedOnWeight(Team $team): int
    {
        return rand(0, $team->weight());
    }
}
