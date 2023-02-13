<?php

namespace App\Repositories;

use App\Alias\RandomAliasGenerator;
use App\Models\Alias;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AliasRepository
{
    public static function createAliasForUrl(string $url, ?Carbon $expiresOn = null): Alias
    {
        try {
            if (is_null($expiresOn)) {
                $aliasBuilder = Alias::where('origin_url', $url);
            } else {
                $aliasBuilder = Alias::where([
                    ['origin_url', $url],
                    ['expires_on', $expiresOn]
                ]);
            }
            $alias = $aliasBuilder->firstOrFail();
        } catch (ModelNotFoundException $modelNotFoundException) {
            $alias = (new Alias())
                ->setOriginUrl($url)
                ->setAlias(RandomAliasGenerator::generate())
                ->setExpiresOn($expiresOn);
            $alias->save();
        }
        return $alias;
    }

    public static function getShortenedUrl(Alias $alias): string
    {
        return url("/{$alias->getAlias()}");
    }
}
