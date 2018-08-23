<?php

declare(strict_types = 1);

namespace App\Console\Commands;
use App\Service\UserService;
use Illuminate\Console\Command;
/**
 * Class CreateUser
 * @package App\Console\Commands
 */
class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin user';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /** @var UserService $service */
        $service = app(UserService::class);
        $service->create(
            $this->getUserName(),
            $this->getUserEmail(),
            $this->getUserPassword()
        );
        $this->info('User created successfully!');
    }
    /**
     * @return string
     */
    private function getUserName(): string
    {
        $name = $this->ask('Enter user name');
        if (empty($name)) {
            $this->error('Name of user is required');
            return $this->getUserName();
        }
        return $name;
    }
    /**
     * @return string
     */
    private function getUserEmail(): string
    {
        $email = $this->ask('Enter user email');
        if (empty($email)) {
            $this->error('Email is required');
            return $this->getUserEmail();
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Not email structure');
            return $this->getUserEmail();
        }
        return $email;
    }
    /**
     * @return string
     */
    private function getUserPassword(): string
    {
        $password = $this->secret('Enter password');
        $confirmPassword = $this->secret('Please repeat password');
        if (empty($password) || empty($confirmPassword) || $password !== $confirmPassword) {
            $this->error('Password is empty or not match');
            return $this->getUserPassword();
        }
        return $password;
    }
}