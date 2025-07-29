<?php

namespace App\Service;

use App\Entity\User;

class UserRegistration
{
    public function __construct(
        private UserRepository $repository,
        private MailerService $mailerService
    )
    {
    }

    public function register(User $user): void
    {
        $this->repository->save($user);
        $this->mailerService->send($user->email, "Welcome");
    }
}
