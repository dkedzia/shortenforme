<?php

namespace App\Alias;

use Tests\Unit\Alias\RandomAliasGeneratorTest;

function str_shuffle(string $string): string
{
    return RandomAliasGeneratorTest::getNextSubString();
}

namespace Tests\Unit\Alias;

use App\Alias\RandomAliasGenerator;
use App\Models\Alias;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RandomAliasGeneratorTest extends TestCase
{
    use DatabaseTransactions;

    public static int $stringGetCounter = 0;
    public static array $subStringToReturn = ['qwertyuiopasdfghjkl', 'wertyuiopasdfghjklq'];

    protected function setUp(): void
    {
        parent::setUp();

        self::$stringGetCounter = 0;
    }

    public static function getNextSubString(): string
    {
        return self::$subStringToReturn[self::$stringGetCounter++];
    }

    /** @test */
    public function shouldGenerateAliasWithExactLength(): void
    {
        // when
        $alias = RandomAliasGenerator::generate();

        // then
        $this->assertEquals(10, strlen($alias));
    }

    /** @test */
    public function shouldNotReturnAliasThatAlreadyExists(): void
    {
        // given
        Alias::factory()->create(['alias' => 'qwertyuiop']);

        // when
        $alias = RandomAliasGenerator::generate();

        // then
        $this->assertEquals('wertyuiopa', $alias);
    }
}
