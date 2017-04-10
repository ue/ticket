<?php
/**
 * This file is part of Lcobucci\JWT, a simple library to handle JWT and JWS
 *
 * @license http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 */

namespace Lcobucci\JWT\Signer;

/**
 * Base class for hmac signers
 *
 * @author Luís Otávio Cobucci Oblonczyk <lcobucci@gmail.com>
 * @since 0.1.0
 */
abstract class Hmac extends BaseSigner
{
    /**
     * {@inheritdoc}
     */
    public function createHash($payload, $key)
    {
        return hash_hmac($this->getAlgorithm(), $payload, $key, true);
    }

    /**
     * {@inheritdoc}
     */
    public function verify($expected, $payload, $key)
    {
        if (!is_string($expected)) {
            return false;
        }

        $callback = function_exists('hash_equals') ? 'hash_equals' : [$this, 'hashEquals'];

        return call_user_func($callback, $expected, $this->createHash($payload, $key));
    }

    /**
     * PHP < 5.6 timing attack safe hash comparison
     *
     * @param string $expected
     * @param string $generated
     *
     * @return boolean
     */
    public function hashEquals($expected, $generated)
    {
        $expectedLength = strlen($expected);

        if ($expectedLength !== strlen($generated)) {
            return false;
        }

        $res = 0;

        for ($i = 0; $i < $expectedLength; ++$i) {
            $res |= ord($expected[$i]) ^ ord($generated[$i]);
        }

        return $res === 0;
    }

    /**
     * Returns the algorithm name
     *
     * @return string
     */
    abstract public function getAlgorithm();
}
