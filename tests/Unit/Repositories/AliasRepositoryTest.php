<?php

namespace Tests\Unit\Repositories;

use App\Alias\RandomAliasGenerator;
use App\Models\Alias;
use App\Repositories\AliasRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mockery;
use Tests\TestCase;

class AliasRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function shouldCreateAliasForUrl(): void
    {
        // given
        $textAlias = 'qwertyuiop';
        $url = 'https://example.com';

        $randomAliasGeneratorMock = Mockery::mock('alias:' . RandomAliasGenerator::class);
        $randomAliasGeneratorMock->shouldReceive('generate')->andReturn($textAlias);

        // when
        $alias = AliasRepository::createAliasForUrl($url);

        // then
        $this->assertEquals($textAlias, $alias->getAlias());
        $this->assertEquals($url, $alias->getOriginUrl());
    }

    /** @test */
    public function shouldReturnShortenedUrl(): void
    {
        // given
        $alias = Alias::factory()->create(['alias' => 'qwertyuiop']);
        config(['app.url' => 'http://localhost']);

        // when
        $shortenedUrl = AliasRepository::getShortenedUrl($alias);

        // then
        $this->assertEquals('http://localhost/qwertyuiop', $shortenedUrl);
    }
}
