<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Objective
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $title
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Plan[] $plans
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Objective whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Objective whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Objective whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Objective whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Objective whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Objective extends Model
{
    protected $fillable = [
        'title',
        'slug',
    ];

    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class);
    }
}
