<?php

declare(strict_types=1);

require "./vendor/autoload.php";

use Drone\Game\GameBuilder;
use League\CLImate\CLImate;

$cli = new CLImate();
$teams = GameBuilder::buildFromYaml("./resources/teams.yaml");

$cli->info($teams->getRandomTeam()->name());
