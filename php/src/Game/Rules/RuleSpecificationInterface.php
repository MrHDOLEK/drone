<?php

declare(strict_types=1);

namespace Drone\Game\Specification;

use Drone\Game\Game;

interface RuleSpecificationInterface
{
    public function isSatisfiedBy(Game $game): bool;

    public function name(): string;
}
