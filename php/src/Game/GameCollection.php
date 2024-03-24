<?php

declare(strict_types=1);

namespace Drone\Game;

use Countable;

class GameCollection implements Countable
{
    /** @var array<Game> */
    private array $items;

    public function __construct(Game ...$teams)
    {
        $this->items = $teams;
    }

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
