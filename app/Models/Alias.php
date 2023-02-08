<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string origin_url
 * @property string alias
 */
class Alias extends Model
{
    use HasFactory;

    protected $table = 'aliases';

    protected $fillable = [
        'origin_url',
        'alias'
    ];

    public function setOriginUrl(string $originUrl): self
    {
        $this->origin_url = $originUrl;
        return $this;
    }

    public function getOriginUrl(): string
    {
        return $this->origin_url;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;
        return $this;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }
}
