<?php

namespace Tests\Feature\Http\Controllers\v1;

use App\Models\Alias;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AliasesControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function shouldReturnAlias(): void
    {
        /** @var Alias $alias */
        $alias = Alias::factory()->create();

        $response = $this->get("/api/v1/aliases/{$alias->getAlias()}");

        $response->assertStatus(200);
    }
}
