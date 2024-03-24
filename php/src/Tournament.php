<?php

declare(strict_types=1);

namespace Drone;

use Drone\Game\Game;
use Drone\Game\GameBuilder;
use Drone\Game\GameEngine;
use Drone\Game\Rules\GameRules;
use Drone\Game\Rules\ScoreLimitRule;
use Drone\Game\Rules\TimeLimitRule;
use Drone\Team\TeamCollection;
use League\CLImate\CLImate;

class Tournament
{
    private CLImate $cli;
    private GameEngine $gameEngine;
    private Scoreboard $scoreboard;
    private GameRules $gameRules;
    private TeamCollection $teams;

    public function __construct(string $teamFilePath)
    {
        $this->cli = new CLImate();
        $this->gameEngine = new GameEngine();
        $this->scoreboard = new Scoreboard();
        $this->gameRules = new GameRules(
            new ScoreLimitRule(),
            new TimeLimitRule(),
        );
        $this->teams = GameBuilder::buildFromYaml($teamFilePath);
    }

    public function run(): void
    {
        while ($this->teams->count() > 1) {
            $this->playRound();
        }
        $this->displayTournamentSummary();
    }

    /**
     * @throws Exception
     */
    private function playRound(): void
    {
        $games = $this->gameEngine->createGames($this->teams);
        $nextRoundTeams = [];

        foreach ($games->items() as $game) {
            $this->playGame($game);
            $nextRoundTeams[] = $game->winner();
        }

        $this->teams = new TeamCollection(...$nextRoundTeams);
    }

    private function playGame(Game $game): void
    {
        while (true) {
            $this->cli->yellow()->info("Starting game: {$game->homeTeam()->name()} vs {$game->awayTeam()->name()}");
            $this->gameEngine->simulateGame($game);
            $this->cli->green()->info("Updating score: Home - {$game->score()->homeScore()}, Away - {$game->score()->awayScore()}");

            if (!$this->gameRules->isSatisfiedBy($game)) {
                $this->cli->red()->info("Finishing game: {$game->homeTeam()->name()} vs {$game->awayTeam()->name()}");
                $this->scoreboard->add($game);
                break;
            }
        }
    }

    private function displayTournamentSummary(): void
    {
        $this->cli->lightBlue()->info("Tournament Summary:");
        foreach ($this->scoreboard->items() as $summaryGame) {
            $this->cli->cyan()->info("{$summaryGame->homeTeam()->name()} vs {$summaryGame->awayTeam()->name()} - Score: {$summaryGame->score()->homeScore()}-{$summaryGame->score()->awayScore()}");
        }

        $champion = $this->teams->first();
        $this->cli->magenta()->info("Champion: {$champion->name()}");
    }
}
