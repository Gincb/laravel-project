<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-08-03
 * Time: 20:59
 */

declare(strict_types = 1);

namespace App\Service;


use App\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    /**
     * @return LengthAwarePaginator
     */
    public function getPaginate(): LengthAwarePaginator
    {
        return User::paginate();
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User
     */
    public function create(string $name, string $email, string $password): User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
    }
}