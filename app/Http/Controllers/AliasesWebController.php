<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAliasRequest;
use App\Models\Alias;
use App\Repositories\AliasRepository;
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
        $url = $addAliasRequest->validated()['origin_url'];
        $alias = AliasRepository::createAliasForUrl($url);
        return response()
            ->view(
                'aliasAdded',
                ['shortenedUrl' => AliasRepository::getShortenedUrl($alias)],
                201
            );
    }

    public function redirect(string $alias): RedirectResponse
    {
        /** @var Alias $alias */
        $alias = Alias::where('alias', $alias)->firstOrFail();

        return Redirect::away($alias->getOriginUrl(), 301);
    }
}
