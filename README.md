## Requirements
`php openssl` (default)
http://php.net/manual/en/book.openssl.php

`php hash` (default)
http://php.net/manual/en/book.hash.php

## Usage

```php
<?php

/* @see http://php.net/manual/pt_BR/function.openssl-get-cipher-methods.php */
$cipher = 'AES-256-CFB8'; // default
$key = "my_secret";
$payload = 'my string';

$openssl = new OpenSSL($key, $cipher);
$encoded = $openssl->encode('my string');
$decoded = $openssl->decode($encoded);

var_dump($encoded); // encoded
var_dump($payload); // my string
var_dump($decoded); // my string
```

## Composer Installation

`composer require zech86/php-simple-encrypted-text`