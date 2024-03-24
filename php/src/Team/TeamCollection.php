<?php

declare(strict_types=1);

namespace Drone\Team;

use Countable;

class TeamCollection implements Countable
{
    /** @var array<Team> */
    private array $items;

    public function __construct(Team ...$teams)
    {
        $this->items = $teams;
    }

    /**
     * @return array<Team>
     */
    public function items(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getRandomTeam(): Team
    {
        return $this->items[array_rand($this->items)];
    }

    public function add(Team $team): void
    {
        $this->items[] = $team;
    }
}
