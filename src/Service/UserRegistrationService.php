<?php

namespace App\Service;

use App\Entity\User;
use App\Event\UserRegisteredEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;


class UserRegistrationService
{
    public function __construct(
        private UserRepository $repository,
        private EventDispatcherInterface $dispatcher
    )
    {
    }

    public function register(User $user): void
    {
        $this->repository->save($user);
        $this->dispatcher->dispatch(
            new UserRegisteredEvent($user),
            UserRegisteredEvent::NAME
        );
    }
}
