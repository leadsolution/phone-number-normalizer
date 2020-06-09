<?php declare(strict_types=1);

namespace Leadsolution\Test\PhoneNumber;

use Leadsolution\PhoneNumber\Normalizer;
use PHPUnit\Framework\TestCase;

class NormalizerTest extends TestCase
{
    public function testNormalize()
    {
        $normalizer = new Normalizer();
        self::assertSame('23456789', $normalizer->normalize('23456789')->toString());
        self::assertSame('23456789', $normalizer->normalize('2345-6789')->toString());
        self::assertSame('23456789', $normalizer->normalize('2345.6789')->toString());
        self::assertSame('1123456789', $normalizer->normalize('2345.6789', '11')->toString());
        self::assertSame('11973456789', $normalizer->normalize('7345 6789', '11')->toString());
        self::assertSame('11983456789', $normalizer->normalize('(11) 8345 6789', '11')->toString());
        self::assertSame('11993456789', $normalizer->normalize('(11)99345-6789', '11')->toString());
        self::assertSame('11993456789', $normalizer->normalize('+55 (11)99345-6789', '11')->toString());
        self::assertTrue($normalizer->normalize('8765-4321')->isMobile());
        self::assertTrue($normalizer->normalize('11 8765-4321')->isMobile());
        self::assertTrue($normalizer->normalize('11 98765-4321')->isMobile());
    }
}
