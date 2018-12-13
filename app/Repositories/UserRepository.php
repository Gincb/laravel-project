<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-12-13
 * Time: 19:28
 */

declare(strict_types = 1);

namespace App\Repositories;

use App\User;

/**
 * Class ProjectRepository
 * @package App\Repositories
 */
class UserRepository extends Repository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }
}