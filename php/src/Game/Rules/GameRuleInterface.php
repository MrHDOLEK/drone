<?php

declare(strict_types=1);

namespace Drone\Game\Specification;

use Drone\Game\Game;

class GameRuleInterface implements RuleSpecificationInterface
{
    public const NAME = "AndRule";

    /** @var array<RuleSpecificationInterface> */
    private array $specifications;

    private array $violations;

    public function __construct(RuleSpecificationInterface ...$specifications)
    {
        $this->specifications = $specifications;
        $this->violations = [];
    }

    public function isSatisfiedBy(Game $game): bool
    {
        foreach ($this->specifications as $specification) {
            if (!$specification->isSatisfiedBy($game)) {
                $this->violations[] = $specification->name();
            }
        }

        return empty($this->violations);
    }

    public function violations(): string
    {
        return !empty($this->violations) ? implode(", ", $this->violations) : "";
    }

    public function name(): string
    {
        return self::NAME;
    }
}
