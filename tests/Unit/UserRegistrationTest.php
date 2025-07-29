<?php

namespace Unit;

use App\Entity\User;
use App\Service\MailerService;
use App\Service\UserRegistration;
use App\Service\UserRepository;
use PHPUnit\Framework\TestCase;

class UserRegistrationTest extends TestCase
{
    private UserRepository $userRepository;
    private MailerService $mailerService;

    public function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->mailerService = $this->createMock(MailerService::class);
    }

    public function testIfUserIsRegisteredAndMailSend(): void
    {
        // Arrange
        $user = new User('tony@email.com');
        $sequence = $this->createSequence();

        $this->userRepository
            ->expects(self::once())
            ->method('save')
            ->with($user)
            ;

        $this->mailerService
            ->expects(self::once())
            ->method('send')
            ->with($user->email, 'Welcome')
            ;

        // Act
        $sut = new UserRegistration($this->userRepository, $this->mailerService);
        $sut->register($user);
    }

    public function testIfThrowException(): void
    {
        // Arrange
        $user = new User('tony@email.com');

        $this->userRepository
            ->expects(self::once())
            ->method('save')
            ->willThrowException(new \RuntimeException('Base non accessible'))
        ;

        $this->mailerService
            ->expects(self::never())
            ->method('send')
        ;

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Base non accessible');

        // Act
        $sut = new UserRegistration($this->userRepository, $this->mailerService);
        $sut->register($user);
    }
}
