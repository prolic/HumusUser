<?php

namespace HumusUser\Model;

interface UserInterface
{
    /**
     * Get id
     *
     * @return int
     */
    public function getId();

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername();
    /**
     * Set username
     *
     * @param string $username
     * @return UserInterface
     */
    public function setUsername($username);

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set email
     *
     * @param string $email
     * @return UserInterface
     */
    public function setEmail($email);

    /**
     * Get display name
     *
     * @return string
     */
    public function getDisplayName();

    /**
     * Set display name
     *
     * @param string $displayName
     * @return UserInterface
     */
    public function setDisplayName($displayName);

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword();

    /**
     * Set password
     *
     * @param string $password
     * @return UserInterface
     */
    public function setPassword($password);

    /**
     * Get last login
     *
     * @return \DateTime
     */
    public function getLastLogin();

    /**
     * Set last login
     *
     * @param \DateTime|string $lastLogin
     * @return UserInterface
     */
    public function setLastLogin($lastLogin);

    /**
     * Get last ip
     *
     * @param bool $long
     * @return string
     */
    public function getLastIp($long = false);

    /**
     * Set last ip
     *
     * @param string $lastIp
     * @return UserInterface
     */
    public function setLastIp($lastIp);

    /**
     * Get register time
     *
     * @return \DateTime
     */
    public function getRegisterTime();

    /**
     * Set register time
     *
     * @param \DateTime|string $registerTime
     * @return UserInterface
     */
    public function setRegisterTime($registerTime);

    /**
     * Get register ip
     *
     * @param bool $long
     * @return string
     */
    public function getRegisterIp($long = false);

    /**
     * Set register ip
     *
     * @param string $registerIp
     * @return UserInterface
     */
    public function setRegisterIp($registerIp);

    /**
     * Check if user is active
     *
     * @return bool active
     */
    public function isActive();

    /**
     * Activate user
     *
     * @return UserInterface
     */
    public function activate();

    /**
     * Deactive user
     *
     * @return UserInterface
     */
    public function deactivate();

    /**
     * Check if user is enabled
     *
     * @return bool enabled
     */
    public function isEnabled();

    /**
     * Enable the user
     *
     * @return UserInterface
     */
    public function enable();

    /**
     * Disable the user
     *
     * @return UserInterface
     */
    public function disable();

    /**
     * Convert the model to an array 
     * 
     * @return array
     */
    public function toArray();

    /**
     * Convert an array into a model instance 
     * 
     * @param array $array 
     * @return UserInterface
     */
    public static function fromArray($array);
}

