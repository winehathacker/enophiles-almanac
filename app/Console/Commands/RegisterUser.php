<?php

namespace App\Console\Commands;

use App\User;
use Hash;
use Illuminate\Console\Command;

class RegisterUser extends Command
{
    protected $signature = 'user:register
                            {--email= : Email address}
                            {--name= : Name}
                            {--nickname= : Nickname}';

    protected $description = 'Register a new user';

    public function handle(): void
    {
        User::create([
            'email' => $this->option('email') ?: null,
            'name' => $this->option('name') ?: null,
            'nickname' => $this->option('nickname') ?? $this->option('name'),
            'password' => Hash::make(bin2hex(random_bytes(30))),
         ]);
    }
}
