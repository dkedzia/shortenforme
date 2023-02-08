<?php

namespace app\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddAliasRequest;
use App\Http\Resources\AliasResource;
use App\Models\Alias;
use App\Repositories\AliasRepository;

class AliasesController extends Controller
{
    public function show(string $alias): AliasResource
    {
        /** @var Alias $alias */
        $alias = Alias::where('alias', $alias)->firstOrFail();

        return new AliasResource($alias);
    }

    public function store(AddAliasRequest $addAliasRequest): AliasResource
    {
        $url = $addAliasRequest->validated()['origin_url'];
        $alias = AliasRepository::createAliasForUrl($url);

        return new AliasResource($alias);
    }
}
