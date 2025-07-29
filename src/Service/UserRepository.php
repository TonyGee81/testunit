<?php

namespace App\Service;

use App\Entity\User;

class UserRepository
{
    public function save(User $user): void
    {
        // Simulation : insertion en base
        throw new \RuntimeException('Base non accessible');
    }
}
