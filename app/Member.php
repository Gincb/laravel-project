<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Member
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $first_name
 * @property string $last_name
 * @property string $position
 * @property string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member wherePosition($value)
 * @method static findOrFail(int $memberId)
 * @method static paginate(int $PER_PAGE, array $array, string $string, int $page)
 * @property string|null $photo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Member wherePhoto($value)
 */
class Member extends Model
{
    protected $fillable = [
        'photo',
        'first_name',
        'last_name',
        'position',
    ];
}
