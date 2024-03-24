<?php

declare(strict_types=1);

namespace Drone\Team;

class Team
{
    public function __construct(
        private string $name,
        private string $city,
        private int $founded,
        private string $stadium,
        private int $weight,
    ) {}

    public function name(): string
    {
        return $this->name;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function founded(): int
    {
        return $this->founded;
    }

    public function stadium(): string
    {
        return $this->stadium;
    }

    public function weight(): int
    {
        return $this->weight;
    }
}
