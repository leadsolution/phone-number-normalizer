<?php declare(strict_types=1);

namespace Leadsolution\PhoneNumber;

use Leadsolution\PhoneNumber;
use Leadsolution\PhoneNumber\Exception\IsEmpty;
use Leadsolution\PhoneNumber\Exception\MinLength;
use Leadsolution\PhoneNumber\Exception\NoDigit;

final class Normalizer implements NormalizerInterface
{
    private int $minLength;

    public function __construct(int $minLength = 8)
    {
        $this->minLength = $minLength;
    }

    public function normalize(string $input, ?string $defaultCode = null): PhoneNumber
    {
        $code = $defaultCode;
        $value = trim($input);

        if (empty($value)) {
            throw new IsEmpty();
        }

        $value = preg_replace('/\D/', '', $value);

        if (empty($value)) {
            throw new NoDigit();
        }

        if (strlen($value) < $this->minLength) {
            throw new MinLength();
        }

        if (strlen($value) > 11) {
            $value = substr($value, -11);
        }

        if (strlen($value) > 9) {
            $code = substr($value, 0, 2);
            $value = substr($value, 2);
        }

        if (strlen($value) === 8 && in_array($value[0], [7, 8, 9])) {
            $value = '9' . $value;
        }

        return new PhoneNumber($value, $code);
    }
}