<?php

namespace Unit;

use App\Service\CurrencyConverter;
use App\Service\ExchangeRateService;
use PHPUnit\Framework\TestCase;

class CurrencyConverterTest extends TestCase
{
    private ExchangeRateService $exchangeRateService;

    public function setUp(): void
    {
        $this->exchangeRateService = $this->createMock(ExchangeRateService::class);
    }

    public function testConvertReturnsCorrectAmountWhenRateIsProvided(): void
    {
        $this->exchangeRateService
            ->expects($this->once())
            ->method('getRate')
            ->with('USD', 'EUR')
            ->willReturn(0.9)
            ;

        $sut = new CurrencyConverter($this->exchangeRateService);
        $actual = $sut->convert(100, 'USD', 'EUR');

        self::assertSame(90.0, $actual);
    }

    public function testConvertThrowsExceptionIfRateUnavailable(): void
    {
        $this->exchangeRateService
            ->method('getRate')
            ->willThrowException(new \RuntimeException('Rate not available'));

        $sut = new CurrencyConverter($this->exchangeRateService);

        $this->expectException(\RuntimeException::class);
        $sut->convert(100, 'USD', 'EUR');
    }
}
