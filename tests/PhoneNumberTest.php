<?php declare(strict_types=1);

namespace Leadsolution\Test;

use Leadsolution\PhoneNumber;
use PHPUnit\Framework\TestCase;

class PhoneNumberTest extends TestCase
{

    public function testHasCode()
    {
        $pn = new PhoneNumber('', '');
        self::assertFalse($pn->hasCode());

        $pn = new PhoneNumber('', ' ');
        self::assertFalse($pn->hasCode());

        $pn = new PhoneNumber('', null);
        self::assertFalse($pn->hasCode());

        $pn = new PhoneNumber('', '11');
        self::assertTrue($pn->hasCode());
    }

    public function testIsMobile()
    {
        foreach (range(1, 8) as $i) {
            self::assertFalse((new PhoneNumber(strval($i)))->isMobile());
        }

        $pn = new PhoneNumber('9');
        self::assertTrue($pn->isMobile());
    }

    public function testCode()
    {
        self::assertNull((new PhoneNumber(''))->code());
        self::assertSame('11', (new PhoneNumber('', '11'))->code());
    }

    public function testFormat()
    {
        $pn = new PhoneNumber('987654321', '11');
        self::assertSame('(11) 98765-4321', $pn->format('($1) $2-$3'));
    }

    public function testValue()
    {
        self::assertSame('', (new PhoneNumber(''))->value());
    }

    public function testToString()
    {
        $pn = new PhoneNumber('987654321', '11');
        self::assertSame('11987654321', $pn->toString());
    }

    public function testAssertMobile()
    {
        self::expectException(PhoneNumber\Exception\NotMobile::class);
        (new PhoneNumber('23456789'))->assertMobile();
    }
}
