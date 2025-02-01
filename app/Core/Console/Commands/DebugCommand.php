<?php

namespace App\Core\Console\Commands;

use App\Domains\User\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class DebugCommand extends Command
{
    protected $signature = 'debug';

    protected $description = 'Command description';

    public function handle(): void
    {
        User::create([
            'email'    => 'iy@crmoz.com',
            'name'     => 'Iy',
            'password' => Hash::make('qwert123'),
        ]);
    }
}
