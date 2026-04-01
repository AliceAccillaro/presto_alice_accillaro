<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeUserRevisor extends Command
{
    protected $signature = 'app:make-user-revisor {email}';
    protected $description = 'Set a user as revisor';

    public function handle()
    {
      $user = User::where('email', $this->argument('email'))->first();
      if (!$user) {
          $this->error('User not found.');
          return;
      }
        $user->is_revisor = true;
        $user->save();
        $this->info("l'utente con email {$user->email} è ora revisore");  
    }
}