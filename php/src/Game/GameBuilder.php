<?php

declare(strict_types=1);

namespace Drone\Game;

use Drone\Team\Team;
use Drone\Team\TeamCollection;
use Symfony\Component\Yaml\Yaml;

class GameBuilder
{
    protected function __construct() {}

    public static function buildFromYaml(string $filePath): TeamCollection
    {
        $yamlContents = Yaml::parseFile($filePath);
        return self::buildTeams($yamlContents["football_teams"]);
    }

    protected static function buildTeams(array $teamsData): TeamCollection
    {
        $teams = new TeamCollection();
        foreach ($teamsData as $teamData) {
            $teams->add(
                new Team(
                    $teamData["name"],
                    $teamData["city"],
                    $teamData["founded"],
                    $teamData["stadium"],
                ),
            );
        }
        return $teams;
    }
}
