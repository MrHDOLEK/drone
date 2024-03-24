<?php

declare(strict_types=1);

namespace Drone;

class Score
{
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

    public function setHomeScore(int $score): self
    {
        return new self($score, $this->awayScore);
    }

    public function setAwayScore(int $score): self
    {
        return new self($this->homeScore, $score);
    }

    public function toArray(): array
    {
        return [
            "home" => $this->homeScore,
            "away" => $this->awayScore,
        ];
    }
}
