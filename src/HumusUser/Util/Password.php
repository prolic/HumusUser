<?php

namespace HumusUser\Util;

use HumusBase\Util\String,
    HumusUser\Module as HumusUser,
    HumusUser\Util\Exception\InvalidArgumentException;

abstract class Password
{
    /**
     * Hash
     *
     * @param $password
     * @param string|bool $salt
     * @return string
     */
    public static function hash($password, $salt = false)
    {
        if (!$salt) {
            $salt = static::getPreferredSalt();
        }
        return crypt($password, $salt);
    }

    /**
     * Get salt
     *
     * @param string $algorithm
     * @param int $cost
     * @return string
     * @throws InvalidArgumentException
     */
    public static function getSalt($algorithm = 'blowfish', $cost = 10)
    {
        $cost = (int) $cost;

        switch ($algorithm) {
            case 'blowfish':
                return static::generateBlowfishSalt($cost);
                break;
            case 'sha512':
                return static::generateSha512Salt($cost);
                break;
            case 'sha256':
                return static::generateSha256Salt($cost);
                break;
            default:
                throw new InvalidArgumentException(sprintf(
                    'Unsupported hashing algorithm: %s',
                    $algorithm
                ));
                break;
        }
    }

    /**
     * Get preferred salt
     *
     * @return string
     * @throws InvalidArgumentException
     */
    public static function getPreferredSalt()
    {
        $algorithm = strtolower(HumusUser::getOptions()->getPasswordHashAlgorithm());
        switch ($algorithm) {
            case 'blowfish':
                $cost = HumusUser::getOptions()->getBlowfishCost();
                break;
            case 'sha512':
                $cost = HumusUser::getOptions()->getSha512Rounds();
                break;
            case 'sha256':
                $cost = HumusUser::getOptions()->getSha256Rounds();
                break;
            default:
                throw new InvalidArgumentException(sprintf(
                    'Unsupported hashing algorithm: %s',
                    $algorithm
                ));
                break;
        }
        return static::getSalt($algorithm, (int) $cost);
    }

    /**
     * Generate blowflish salt
     *
     * @param int $cost
     * @return string
     */
    protected static function generateBlowfishSalt($cost = 10)
    {
        $cost = str_pad(($cost < 4 || $cost > 31) ? 10 : $cost, 2, '0', STR_PAD_LEFT);
        return '$2a$' . $cost . '$' . static::getCryptSaltString() . '$';
    }

    /**
     * Generate SHA-256 salt
     *
     * @param int $cost
     * @return string
     */
    protected static function generateSha256Salt($cost = 5000)
    {
        $cost = ($cost < 1000 || $cost > 999999999) ? 5000 : $cost;
        return '$5$rounds=' . $cost . '$' . static::getCryptSaltString() . '$';
    }

    /**
     * Generate SHA-512 salt
     *
     * @param int $cost
     * @return string
     */
    protected static function generateSha512Salt($cost = 5000)
    {
        $cost = ($cost < 1000 || $cost > 999999999) ? 5000 : $cost;
        return '$6$rounds=' . $cost . '$' . static::getCryptSaltString() . '$';
    }

    /**
     * Get crypt salt string
     *
     * @param int $length
     * @return mixed
     */
    protected static function getCryptSaltString($length = 22)
    {
        return str_replace('+', '.', substr(base64_encode(String::getRandomBytes($length)), 0, $length));
    }
}

