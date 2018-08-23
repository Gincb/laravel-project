<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Project
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $title
 * @property string $description
 * @property string $slug
 * @property int|null $team_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property-read \App\Team|null $teams
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'slug',
        'team_id',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function teams(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }
}
