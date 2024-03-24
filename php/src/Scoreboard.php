<?php

declare(strict_types=1);

namespace Drone;

use Countable;
use Drone\Game\Game;

class Scoreboard implements Countable
{
    /** @var array<Game> */
    private array $items = [];

    /**
     * @return array<Game>
     */
    public function items(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function add(Game $game): void
    {
        $this->items[] = $game;
    }
}
