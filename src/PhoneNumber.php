<?php declare(strict_types=1);

namespace Leadsolution;

use Leadsolution\PhoneNumber\Exception\NotMobile;

final class PhoneNumber
{
    private string $value;
    private ?string $code;

    public function __construct(string $number, ?string $code = null)
    {
        $this->value = $number;
        $this->code = $code;
    }

    public function isMobile(): bool
    {
        return $this->value[0] === '9';
    }

    public function assertMobile(): void
    {
        if (!$this->isMobile()) {
            throw new NotMobile();
        }
    }

    public function code(): ?string
    {
        return $this->code;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function hasCode(): bool
    {
        return $this->code !== null;
    }

    public function format(string $mask): string
    {
        return preg_replace('/^(\d{2})(\d+)(\d{4})$/', $mask, $this);
    }

    public function __toString()
    {
        return ($this->code ?? '') . $this->value;
    }

    public function toString()
    {
        return $this->__toString();
    }
}