<?php

namespace App\Repositories;

use App\Alias\RandomAliasGenerator;
use App\Models\Alias;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AliasRepository
{
    public static function createAliasForUrl(string $url): Alias
    {
        try {
            $alias = Alias::where('origin_url', $url)->firstOrFail();
        } catch (ModelNotFoundException $modelNotFoundException) {
            $alias = (new Alias())
                ->setOriginUrl($url)
                ->setAlias(RandomAliasGenerator::generate());
            $alias->save();
        }
        return $alias;
    }

    public static function getShortenedUrl(Alias $alias): string
    {
        return url("/{$alias->getAlias()}");
    }
}
