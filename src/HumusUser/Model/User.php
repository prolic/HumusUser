<?php

namespace HumusUser\Model;

use DateTime,
    HumusBase\Model\AbstractModel;

class User extends AbstractModel implements UserInterface
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $displayName;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var DateTime
     */
    protected $lastLogin;

    /**
     * @var int
     */
    protected $lastIp;

    /**
     * @var DateTime
     */
    protected $registerTime;

    /**
     * @var int
     */
    protected $registerIp;

    /**
     * @var bool
     */
    protected $active;

    /**
     * @var bool
     */
    protected $enabled;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get display name
     *
     * @return string
     */
    public function getDisplayName()
    {
        if (null !== $this->displayName) {
            return $this->displayName;
        } elseif (null !== $this->username) {
            return $this->username;
        } elseif (null !== $this->email) {
            return $this->email;
        }
        return null;
    }

    /**
     * Set display name
     *
     * @param string $displayName
     * @return User
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get last login
     *
     * @return DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * Set last login
     *
     * @param DateTime|string $lastLogin
     * @return User
     */
    public function setLastLogin($lastLogin)
    {
        if ($lastLogin instanceof DateTime) {
            $this->lastLogin = $lastLogin;
        } else {
            $this->lastLogin = new DateTime($lastLogin);
        }
        return $this;
    }

    /**
     * Get last ip
     *
     * @param bool $long
     * @return string
     */
    public function getLastIp($long = false)
    {
        if (true === $long) {
            return $this->lastIp;
        }
        return long2ip($this->lastIp);
    }

    /**
     * Set last ip
     *
     * @param $lastIp
     * @return User
     */
    public function setLastIp($lastIp)
    {
        $this->lastIp = ip2long($lastIp);
        return $this;
    }

    /**
     * Get register time
     *
     * @return DateTime
     */
    public function getRegisterTime()
    {
        return $this->registerTime;
    }

    /**
     * Set register time
     *
     * @param \DateTime|string $registerTime
     * @return User
     */
    public function setRegisterTime($registerTime)
    {
        if ($registerTime instanceof DateTime) {
            $this->registerTime = $registerTime;
        } else {
            $this->registerTime = new DateTime($registerTime);
        }
        return $this;
    }

    /**
     * Get register ip
     *
     * @param bool $long
     * @return string
     */
    public function getRegisterIp($long = false)
    {
        if (true === $long) {
            return $this->registerIp;
        }
        return long2ip($this->registerIp);
    }

    /**
     * Set register ip
     *
     * @param string $registerIp
     * @return User
     */
    public function setRegisterIp($registerIp)
    {
        $this->registerIp = ip2long($registerIp);
        return $this;
    }

    /**
     * Check if user is active
     *
     * @return bool active
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Activate user
     *
     * @return User
     */
    public function activate()
    {
        $this->active = true;
        return $this;
    }

    /**
     * Deactive user
     *
     * @return User
     */
    public function deactivate()
    {
        $this->active = false;
        return $this;
    }

    /**
     * Check if user is enabled
     *
     * @return bool enabled
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * Enable the user
     *
     * @return User
     */
    public function enable()
    {
        $this->enabled = true;
        return $this;
    }

    /**
     * Disable the user
     *
     * @return User
     */
    public function disable()
    {
        $this->enabled = false;
        return $this;
    }

    public function toArray(array $fields = array(), $flatSingleKeys = false, $array = false)
    {
        if (empty($fields)) {
            $fields = array(
                'id',
                'username',
                'email',
                'display_name',
                'password',
                'last_login',
                'last_ip',
                'register_time',
                'register_ip',
                'active',
                'enabled'
            );
        }
        return parent::toArray($fields, $flatSingleKeys);
    }
}
