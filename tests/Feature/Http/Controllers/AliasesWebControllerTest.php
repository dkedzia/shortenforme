<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Alias;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AliasesWebControllerTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function shouldGetHome(): void
    {
        // when
        $response = $this->get('/');

        // then
        $response->assertStatus(200);
        $response->assertSee('URL to be shortened...');
        $response->assertSee('Shorten for me');
    }

    /**
     * @test
     * @dataProvider urlData
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function shouldCreateNewAlias($originUrl): void
    {
        // when
        $this->withoutMiddleware();
        $response = $this->post('/', ['origin_url' => $originUrl]);

        // then
        /** @var Alias $alias */
        $alias = Alias::where('origin_url', $originUrl)->firstOrFail();

        $response->assertStatus(201);
        $response->assertSee('Your shortened url:');
        $response->assertSee("http://localhost/{$alias->getAlias()}");
    }

    public function urlData(): array
    {
        return [
            ['http://example.com'],
            ['https://example.com'],
            ['https://www.google.com/maps/dir/Chicago,+IL,+USA/Salt+Lake+City,+UT,+USA/Los+Angeles,+CA,+USA/@37.6350081,-111.9342413,5z/data=!3m1!4b1!4m20!4m19!1m5!1m1!1s0x880e2c3cd0f4cbed:0xafe0a6ad09c0c000!2m2!1d-87.6297982!2d41.8781136!1m5!1m1!1s0x87523d9488d131ed:0x5b53b7a0484d31ca!2m2!1d-111.8910474!2d40.7607793!1m5!1m1!1s0x80c2c75ddc27da13:0xe22fdf6f254608f4!2m2!1d-118.2436849!2d34.0522342!3e0?hl=en'],
            ['https://example.com/iafkjnfbsrnjvbhkjdgnrlvshidjkgbnsjdknbksjfdgbnksjdfbskjhfgbshkfgbsdhkzbtvshkdbgkshfdbgjlzdfbkjsfgnbksjfbnisrkbnvikfdjgbnksjfgbjklsfgbnosfnbkunfuitnbghksdjbsdgkjsfbnljsndfbsklfgbafkjnfbsrnjvbhkjdgnrlvshidjkgbnsjdknbksjfdgbnksjdfbskjhfgbshkfgbsdhkzbtvshkdbgkshfdbgjlzdfbkjsfggnrlvshidjkgbnsjdknbksjfdgbnksjdfbskjhfgbshkfgbsdhkzbtvshkdbgksasfasdsfhfdbgjlzdfbkjsfgnbksjfbnisrkbnvikfdjgbnksjfgbjklsfgbnosfnbkunfuitnbghasfasfasfasfksdjbsdgkjsfbnljsndfbsklfgbafkjnfbsrnjvbhkjdgnrlvshidjkgbnsjdknbksjfdgbnksjdfbskjhfgbshkfgbsdhkzbtvshkdbgkshfdbgjlzdfbkjsfgnbksjfbnisrkbnvikfdjgbnksjfgbjklsfgbnosfnbkunfuitnbghksdjbsdgkjsfbnljsndfbsklfgbafkjnfbsrnjvbhkjdgnrlvshidjkgbnsjdknbksjfdgbnksjdfbskjhfgbshkfgbsdhkzbtvshkdbgkshfdbgjlzdfbkjsfgnbksjfbnisrkbnvikfdjgbnksjfgbjklsfgbnosfnbkunfuitnbghksdjbsdgkjsfbnljsndfbsklfgbafkjnfbsrnjvbhkjdgnrlvshidjkgbnsjdknbksjfdgbnksjdfbskjhfgbshkfgbsdhkzbtvshkdbgkshfdbgjlzdfbkjsfgnbksjfbnisrkbnvikfdjgbnksjfgbjklsfgbnosfnbkunfuitnbghksdjbsdgkjsfbnljsndfbsklfgb'],
        ];
    }

    /** @test */
    public function shouldNotCreateNewAliasForUrlThatExceeds1000Characters(): void
    {
        // given
        $originUrl = 'https://example.com/iafkjnfbsrnjvbhkjdgnrlsvshidjkgbnsjdknbksjfdgbnksjdfbskjhfgbshkfgbsdhkzbtvshkdbgkshfdbgjlzdfbkjsfgnbksjfbnisrkbnvikfdjgbnksjfgbjklsfgbnosfnbkunfuitnbghksdjbsdgkjsfbnljsndfbsklfgbafkjnfbsrnjvbhkjdgnrlvshidjkgbnsjdknbksjfdgbnksjdfbskjhfgbshkfgbsdhkzbtvshkdbgkshfdbgjlzdfbkjsfggnrlvshidjkgbnsjdknbksjfdgbnksjdfbskjhfgbshkfgbsdhkzbtvshkdbgksasfasdsfhfdbgjlzdfbkjsfgnbksjfbnisrkbnvikfdjgbnksjfgbjklsfgbnosfnbkunfuitnbghasfasfasfasfksdjbsdgkjsfbnljsndfbsklfgbafkjnfbsrnjvbhkjdgnrlvshidjkgbnsjdknbksjfdgbnksjdfbskjhfgbshkfgbsdhkzbtvshkdbgkshfdbgjlzdfbkjsfgnbksjfbnisrkbnvikfdjgbnksjfgbjklsfgbnosfnbkunfuitnbghksdjbsdgkjsfbnljsndfbsklfgbafkjnfbsrnjvbhkjdgnrlvshidjkgbnsjdknbksjfdgbnksjdfbskjhfgbshkfgbsdhkzbtvshkdbgkshfdbgjlzdfbkjsfgnbksjfbnisrkbnvikfdjgbnksjfgbjklsfgbnosfnbkunfuitnbghksdjbsdgkjsfbnljsndfbsklfgbafkjnfbsrnjvbhkjdgnrlvshidjkgbnsjdknbksjfdgbnksjdfbskjhfgbshkfgbsdhkzbtvshkdbgkshfdbgjlzdfbkjsfgnbksjfbnisrkbnvikfdjgbnksjfgbjklsfgbnosfnbkunfuitnbghksdjbsdgkjsfbnljsndfbsklfgb';

        // when
        $this->withoutMiddleware();
        $response = $this->post('/', ['origin_url' => $originUrl]);

        // then
        $this->expectException(ModelNotFoundException::class);
        Alias::where('origin_url', $originUrl)->firstOrFail();

        $response->assertStatus(302);
    }

    /** @test */
    public function shouldRedirect(): void
    {
        // given
        /** @var Alias $alias */
        $alias = Alias::factory()->create();

        // when
        $response = $this->get("/{$alias->getAlias()}");

        // then
        $response->assertStatus(301);
        $response->assertRedirect($alias->getOriginUrl());
    }

    /** @test */
    public function shouldNotRedirectForNotExistingAlias(): void
    {
        // when
        $response = $this->get("/nbgdf87giubydf");

        // then
        $response->assertStatus(404);
    }
}
