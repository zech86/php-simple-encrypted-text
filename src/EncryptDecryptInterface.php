<?php

namespace SimpleEncryptedText;

interface EncryptDecryptInterface
{
    /**
     * @param $payload
     * @return string
     */
    function encode($payload);

    /**
     * @param $payload
     * @return string
     */
    function decode($payload);
}