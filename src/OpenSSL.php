<?php

namespace SimpleEncryptedText;

final class OpenSSL implements EncryptDecryptInterface
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $cipher;

    public function __construct($key, $cipher = 'AES-256-CFB8')
    {
        $this->key = $key;
        $this->cipher = $cipher;
    }

    /**
     * @return string
     */
    public function encode($payload)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->cipher));
        $encrypted = openssl_encrypt($payload, $this->cipher, $this->key, OPENSSL_RAW_DATA, $iv);
        $hash = hash_hmac('sha256', $encrypted, $this->key, true);

        return strtr(base64_encode(sprintf('%s%s%s', $iv, $hash, $encrypted)), '+/=', '._-');
    }

    /**
     * @return string
     */
    public function decode($payload)
    {
        $hashLength = 32;

        $payload = base64_decode(strtr($payload, '._-', '+/='));
        $ivLength = openssl_cipher_iv_length($this->cipher);
        $iv = substr($payload, 0, $ivLength);
        $hash = substr($payload, $ivLength, $hashLength);
        $decrypted = substr($payload, $ivLength + $hashLength);

        if (false === hash_equals($hash, hash_hmac('sha256', $decrypted, $this->key, true))) {
            return null;
        }

        return openssl_decrypt($decrypted, $this->cipher, $this->key, OPENSSL_RAW_DATA, $iv);
    }
}
