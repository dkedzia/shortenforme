<?php

namespace App\Alias;

use App\Models\Alias;

class RandomAliasGenerator
{
    private const ALIAS_LENGTH = 10;

    public static function generate(): string
    {
        do {
            $string = substr(str_shuffle(MD5(microtime())), 0, self::ALIAS_LENGTH);
        } while (Alias::where('alias', $string)->count());
        return $string;
    }
}

