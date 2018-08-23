<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Team
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $title
 * @property string $team
 * @property string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereTeam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Member[] $members
 */
class Team extends Model
{
    /** @var array  */
    protected $fillable = [
        'title',
        'slug'
    ];

    /**
     * @return BelongsToMany
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class);
    }

}
