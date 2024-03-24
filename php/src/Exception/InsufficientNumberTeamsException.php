<?php

declare(strict_types=1);

namespace Drone\Game\Exception;

use Exception;

final class InsufficientNumberTeamsException extends Exception
{
    protected $message = "Insufficient number of teams to run a match.";
}
