<?php

namespace Unit;

use App\Entity\User;
use App\Event\UserRegisteredEvent;
use App\Service\UserRegistrationService;
use App\Service\UserRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;

class UserRegistrationServiceTest extends TestCase
{
    public function testEvent(): void
    {
        $userRepositoryMock = $this->createMock(UserRepository::class);
        $eventDispatcherMock = $this->createMock(EventDispatcher::class);
        $user = new User('tony@email.com');
        $sut = new UserRegistrationService($userRepositoryMock, $eventDispatcherMock);

        $userRepositoryMock
            ->expects(self::once())
            ->method('save')
            ->with($user)
            ;

        $eventDispatcherMock
            ->expects(self::once())
            ->method('dispatch')
            ->with(
                self::callback(function ($event) use ($user) {
                    return $event instanceof UserRegisteredEvent
                        && $event->user === $user
                        && $event::NAME === 'user.registered';
                }),
                UserRegisteredEvent::NAME
            );
            ;

        $sut->register($user);
    }
}
