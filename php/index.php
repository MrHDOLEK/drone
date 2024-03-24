<?php

declare(strict_types=1);

require "./vendor/autoload.php";

use Drone\Game\GameBuilder;
use Drone\Game\GameEngine;
use Drone\Game\Rules\GameRules;
use Drone\Game\Rules\ScoreLimitRule;
use Drone\Game\Rules\TimeLimitRule;
use Drone\Scoreboard;
use Drone\Team\TeamCollection;
use League\CLImate\CLImate;

$cli = new CLImate();
$teams = GameBuilder::buildFromYaml("./resources/teams.yaml");
$gameEngine = new GameEngine();
$scoreboard = new Scoreboard();
$gameRules = new GameRules(
    new ScoreLimitRule(),
    new TimeLimitRule(),
);

while ($teams->count() > 1) {
    $games = $gameEngine->createGames($teams);

    $nextRoundTeams = [];
    foreach ($games->items() as $game) {
        while (true) {
            $cli->info("Starting game: {$game->homeTeam()->name()} vs {$game->awayTeam()->name()}");

            $gameEngine->simulateGame($game);

            $cli->info("Updating score: Home - {$game->score()->homeScore()}, Away - {$game->score()->awayScore()}");

            if (!$gameRules->isSatisfiedBy($game)) {
                $cli->info("Finishing game: {$game->homeTeam()->name()} vs {$game->awayTeam()->name()}");
                $nextRoundTeams[] = $game->winner();
                $scoreboard->add($game);
                break;
            }
        }
    }

    $teams = new TeamCollection(...$nextRoundTeams);
}

$cli->info("Tournament Summary:");
foreach ($scoreboard->items() as $summaryGame) {
    $cli->info("{$summaryGame->homeTeam()->name()} vs {$summaryGame->awayTeam()->name()} - Score: {$summaryGame->score()->homeScore()}-{$summaryGame->score()->awayScore()}");
}

$champion = $teams->first();
$cli->info("Champion: {$champion->name()}");
