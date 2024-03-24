<?php

declare(strict_types=1);

namespace Drone\Game;

use DateTime;
use DateTimeImmutable;
use Drone\Score;
use Drone\Team\Team;

class Game
{
    private Score $score;
    private DateTimeImmutable $startTime;

    public function __construct(
        private Team $homeTeam,
        private Team $awayTeam,
    ) {
        $this->startTime = new DateTimeImmutable();
        $this->score = new Score();
    }

    public function score(): Score
    {
        return $this->score;
    }

    public function startTime(): DateTimeImmutable
    {
        return $this->startTime;
    }

    public function homeTeam(): Team
    {
        return $this->homeTeam;
    }

    public function awayTeam(): Team
    {
        return $this->awayTeam;
    }
}
