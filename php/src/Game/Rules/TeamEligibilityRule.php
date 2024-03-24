<?php

declare(strict_types=1);

namespace Drone\Game\Specification;

use Drone\Game\Game;

class TeamEligibilityRule implements RuleSpecificationInterface
{
    public const NAME = "TeamEligibilityRule";

    public function isSatisfiedBy(Game $game): bool
    {
        return $game->homeTeam()->loss() && $game->awayTeam()->loss();
    }

    public function name(): string
    {
        return self::NAME;
    }
}
