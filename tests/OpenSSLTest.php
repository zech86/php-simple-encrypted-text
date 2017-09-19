<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use SimpleEncryptedText\OpenSSL;

class OpenSSLTest extends TestCase
{
    public function testShouldEncrypt()
    {
        $payload = 'my payload';

        $openssl = new OpenSSL('my-key');
        $encoded = $openssl->encode($payload);

        $this->assertNotEquals($encoded, $payload);
        $this->assertEquals($payload, $openssl->decode($encoded));
    }
}