<?php

namespace App\Tests\Unit;

use App\Utils\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    private Calculator $calculator;
    public function setUp(): void
    {
        $this->calculator = new Calculator();
    }

    public function testAdd(): void
    {
        // Arrange
        $values = [
            'a' => 2,
            'b' => 2,
            'result' => 4
        ];

        // Act
        $sut = $this->calculator->add($values['a'], $values['b']);

        // Assert
        self::assertSame($values['result'], $sut);

    }

    public function testSubstract(): void
    {
        // Arrange
        $values = [
            'a' => 2,
            'b' => 2,
            'result' => 0
        ];

        // Act
        $sut = $this->calculator->subtract($values['a'], $values['b']);

        // Assert
        self::assertSame($values['result'], $sut);

    }

    public function testMultiply(): void
    {
        // Arrange
        $values = [
            'a' => 2,
            'b' => 2,
            'result' => 4
        ];

        // Act
        $sut = $this->calculator->multiply($values['a'], $values['b']);

        // Assert
        self::assertSame($values['result'], $sut);
    }

    public function testDivide(): void
    {
        // Arrange
        $values = [
            'a' => 2,
            'b' => 2,
            'result' => 1.0
        ];

        // Act
        $sut = $this->calculator->divide($values['a'], $values['b']);

        // Assert
        self::assertSame($values['result'], $sut);
    }

    public function testDivideException(): void
    {
        // Arrange
        $values = [
            'a' => 2,
            'b' => 0
        ];

        self::expectException(\InvalidArgumentException::class);
        self::expectExceptionMessage('Division by zero');

        // Act
        $this->calculator->divide($values['a'], $values['b']);
    }
}
