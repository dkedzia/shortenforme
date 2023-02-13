<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string origin_url
 * @property string alias
 * @property ?Carbon expires_on
 */
class Alias extends Model
{
    use HasFactory;

    protected $table = 'aliases';

    protected $casts = [
        'expires_on' => 'date'
    ];

    protected $fillable = [
        'origin_url',
        'alias',
        'expires_on',
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

    public function setExpiresOn(?Carbon $expiredOn): self
    {
        $this->expires_on = $expiredOn;
        return $this;
    }

    public function getExpiresOn(): ?Carbon
    {
        return $this->expires_on;
    }
}
