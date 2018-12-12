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
 * @property int|null $objective_id
 * @property-read \App\Objective|null $objectives
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereObjectiveId($value)
 */
class Project extends Model
{
    protected $fillable = [
        'title',
        'cover',
        'description',
        'slug',
        'team_id',
        'objective_id'
    ];


    public function teams(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public function objectives(): BelongsTo
    {
        return $this->belongsTo(Objective::class, 'objective_id', 'id');
    }
}
