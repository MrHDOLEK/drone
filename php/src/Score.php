<?php

declare(strict_types=1);

namespace Drone;

class Score
{
    private const SINGLE_GOAL = 1;

    public function __construct(
        private int $homeScore = 0,
        private int $awayScore = 0,
    ) {}

    public function homeScore(): int
    {
        return $this->homeScore;
    }

    public function awayScore(): int
    {
        return $this->awayScore;
    }

    public function addHomeScore(): void
    {
        $this->homeScore = $this->homeScore + self::SINGLE_GOAL;
    }

    public function addAwayScore(): void
    {
        $this->awayScore = $this->awayScore + self::SINGLE_GOAL;
    }
}
