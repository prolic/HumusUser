<?php

namespace HumusUser\Options;

use Zend\Stdlib\Options as ZendOptions;

class Options extends ZendOptions
{
    /**
     * @var string
     */
    protected $userModelClass;

    /**
     * @var bool
     */
    protected $enableRegistration;

    /**
     * @var bool
     */
    protected $enableUsername;

    /**
     * @var bool
     */
    protected $enableDisplayName;

    /**
     * @var bool
     */
    protected $requireActivation;

    /**
     * @var bool
     */
    protected $loginAfterRegistration;

    /**
     * @var bool
     */
    protected $registrationFormCaptcha;

    /**
     * @var string
     */
    protected $passwordHashAlgorithm;

    /**
     * @var integer
     */
    protected $blowfishCost;

    /**
     * @var integer
     */
    protected $sha256Rounds;

    /**
     * @var integer
     */
    protected $sha512Rounds;

    /**
     * @param $blowfishCost
     */
    public function setBlowfishCost($blowfishCost)
    {
        $this->blowfishCost = (int) $blowfishCost;
    }

    /**
     * @return int
     */
    public function getBlowfishCost()
    {
        return $this->blowfishCost;
    }

    /**
     * @param $enableDisplayName
     */
    public function setEnableDisplayName($enableDisplayName)
    {
        $this->enableDisplayName = (bool) $enableDisplayName;
    }

    /**
     * @return bool
     */
    public function getEnableDisplayName()
    {
        return $this->enableDisplayName;
    }

    /**
     * @param $enableRegistration
     */
    public function setEnableRegistration($enableRegistration)
    {
        $this->enableRegistration = (bool) $enableRegistration;
    }

    /**
     * @return bool
     */
    public function getEnableRegistration()
    {
        return $this->enableRegistration;
    }

    /**
     * @param $enableUsername
     */
    public function setEnableUsername($enableUsername)
    {
        $this->enableUsername = (bool) $enableUsername;
    }

    /**
     * @return bool
     */
    public function getEnableUsername()
    {
        return $this->enableUsername;
    }

    /**
     * @param $loginAfterRegistration
     */
    public function setLoginAfterRegistration($loginAfterRegistration)
    {
        $this->loginAfterRegistration = (bool) $loginAfterRegistration;
    }

    /**
     * @return bool
     */
    public function getLoginAfterRegistration()
    {
        return $this->loginAfterRegistration;
    }

    /**
     * @param $passwordHashAlgorithm
     */
    public function setPasswordHashAlgorithm($passwordHashAlgorithm)
    {
        $this->passwordHashAlgorithm = (string) $passwordHashAlgorithm;
    }

    /**
     * @return string
     */
    public function getPasswordHashAlgorithm()
    {
        return $this->passwordHashAlgorithm;
    }

    /**
     * @param $registrationFormCaptcha
     */
    public function setRegistrationFormCaptcha($registrationFormCaptcha)
    {
        $this->registrationFormCaptcha = (bool) $registrationFormCaptcha;
    }

    /**
     * @return bool
     */
    public function getRegistrationFormCaptcha()
    {
        return $this->registrationFormCaptcha;
    }

    /**
     * @param $requireActivation
     */
    public function setRequireActivation($requireActivation)
    {
        $this->requireActivation = (bool) $requireActivation;
    }

    /**
     * @return bool
     */
    public function getRequireActivation()
    {
        return $this->requireActivation;
    }

    /**
     * @param $sha256Rounds
     */
    public function setSha256Rounds($sha256Rounds)
    {
        $this->sha256Rounds = (int) $sha256Rounds;
    }

    /**
     * @return int
     */
    public function getSha256Rounds()
    {
        return $this->sha256Rounds;
    }

    /**
     * @param $sha512Rounds
     */
    public function setSha512Rounds($sha512Rounds)
    {
        $this->sha512Rounds = (int) $sha512Rounds;
    }

    /**
     * @return int
     */
    public function getSha512Rounds()
    {
        return $this->sha512Rounds;
    }

    /**
     * @param $userModelClass
     */
    public function setUserModelClass($userModelClass)
    {
        $this->userModelClass = (string) $userModelClass;
    }

    /**
     * @return string
     */
    public function getUserModelClass()
    {
        return $this->userModelClass;
    }
}