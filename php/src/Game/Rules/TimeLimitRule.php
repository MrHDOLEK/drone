<?php

declare(strict_types=1);

namespace Drone\Game\Rules;

use DateTimeImmutable;
use Drone\Game\Game;

class TimeLimitRule implements RuleSpecificationInterface
{
    public const NAME = "TimeLimitRule";

    private int $timeLimitInSeconds = 10;

    public function isSatisfiedBy(Game $game): bool
    {
        $startTime = $game->startTime();
        $currentTime = new DateTimeImmutable();
        $elapsedTime = $currentTime->getTimestamp() - $startTime->getTimestamp();

        return $elapsedTime <= $this->timeLimitInSeconds;
    }

    public function name(): string
    {
        return self::NAME;
    }
}
