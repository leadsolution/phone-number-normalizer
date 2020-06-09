<?php declare(strict_types=1);

namespace Leadsolution\PhoneNumber;

use Leadsolution\PhoneNumber;

interface NormalizerInterface
{
    public function normalize(string $input): PhoneNumber;
}