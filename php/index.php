<?php

declare(strict_types=1);

require "./vendor/autoload.php";

use Drone\Tournament;

$tournament = new Tournament("./resources/teams.yaml");
$tournament->run();
