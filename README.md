# *Phone Number Normalizer*

📞 It tries to normalize a phone number from whatever __*__  input it receives.<br>
__*__*(can't do magic, if you got a new case, feel free to open an issue or a PR)*.

## Install

```bash
composer require leadsolution/phone-number-normalizer
```

## Usage examples
```php
use Leadsolution\PhoneNumber\Normalizer;
$normalizer = new Normalizer();
```

Removes non-digits
```php
$normalizer->normalize('2345-6789')->toString();
// 23456789

$normalizer->normalize('(11) 2345-6789')->toString();
// 1123456789 
```

Adds default national codes
```php
$normalizer->normalize('2345-6789', '11')->toString();
// 1123456789 
```

Removes international codes
```php
$normalizer->normalize('+55 (11) 2345-6789')->toString();
// 1123456789 
```

Adds the 9 digit on mobile numbers
```php
$normalizer->normalize('7345-6789', '11')->toString();
// 11973456789 
```

Checks if the returned object is a mobile
```php
$normalizer->normalize('987654321')->isMobile();
// true

$normalizer->normalize('23456789')->isMobile();
// false
```

---

MIT