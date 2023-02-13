<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAliasRequest;
use App\Models\Alias;
use App\Repositories\AliasRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class AliasesWebController extends Controller
{
    public function home(): Factory|View|Application
    {
        return view('home');
    }

    public function addNewAlias(AddAliasRequest $addAliasRequest)
    {
        $addAliasRequest->validated();

        $url = $addAliasRequest['origin_url'];
        $aliasShouldExpire = $addAliasRequest['alias_should_expire'];
        $expiresOn = $addAliasRequest['expires_on'];

        $expiresOnFromString = null;
        if (!is_null($aliasShouldExpire) && !is_null($expiresOn)) {
            $expiresOnFromString = Carbon::parse($expiresOn);
        }
        $alias = AliasRepository::createAliasForUrl($url, $expiresOnFromString);
        return response()
            ->view(
                'aliasAdded',
                ['shortenedUrl' => AliasRepository::getShortenedUrl($alias)],
                201
            );
    }

    public function redirect(string $alias): View|RedirectResponse
    {
        /** @var Alias $alias */
        $alias = Alias::where('alias', $alias)->firstOrFail();

        $expiredOn = $alias->getExpiresOn();
        if (!is_null($expiredOn) && $alias->getExpiresOn() < Carbon::now()->setTime(0, 0)) {
            return view('expired');
        }

        return Redirect::away($alias->getOriginUrl(), 301);
    }
}
