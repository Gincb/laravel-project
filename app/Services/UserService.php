<?php
/**
 * Created by PhpStorm.
 * User: Amber
 * Date: 2018-08-03
 * Time: 20:59
 */

declare(strict_types = 1);

namespace App\Services;

use App\Repositories\UserRepository;
use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserService
 * @package App\Service
 */
class UserService
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return LengthAwarePaginator
     * @throws \Exception
     */
    public function getPaginate(): LengthAwarePaginator
    {
        return $this->userRepository->paginate();
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return User | Model
     * @throws \Exception
     */
    public function create(string $name, string $email, string $password): User
    {
        return $this->userRepository->create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);
    }
}