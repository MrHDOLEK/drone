<?php

declare(strict_types=1);

namespace Drone\Game\Rules;

use Drone\Game\Game;

class ScoreLimitRule implements RuleSpecificationInterface
{
    public const NAME = "ScoreLimitRule";

    private int $scoreLimit = 10;

    public function isSatisfiedBy(Game $game): bool
    {
        $score = $game->score();
        $totalScore = $score->homeScore() + $score->awayScore();
        return $totalScore < $this->scoreLimit;
    }

    public function name(): string
    {
        return self::NAME;
    }
}
