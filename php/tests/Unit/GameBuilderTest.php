<?php

declare(strict_types=1);

namespace Test\Unit;

use Drone\Game\GameBuilder;
use Symfony\Component\Yaml\Exception\ParseException;
use Tests\TestCase;

class GameBuilderTest extends TestCase
{
    public function testBuildFromYamlSuccess(): void
    {
        $teamCollection = GameBuilder::buildFromYaml(self::TEAMS_FILE);
        $this->assertCount(8, $teamCollection->items());
    }

    public function testBuildFromYamlThrowsParseException1(): void
    {
        $this->expectException(ParseException::class);
        GameBuilder::buildFromYaml("/nonexistent/path.yaml");
    }

    public function testBuildFromYamlThrowsParseException2(): void
    {
        $this->expectException(ParseException::class);
        GameBuilder::buildFromYaml("");
    }
}
