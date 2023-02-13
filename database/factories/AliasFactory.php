<?php

namespace Database\Factories;

use App\Alias\RandomAliasGenerator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alias>
 */
class AliasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'origin_url' => fake()->url(),
            'alias' => substr(str_shuffle('iuogernjzdgdsuor'), 0, 10),
            'expires_on' => null,
        ];
    }
}
