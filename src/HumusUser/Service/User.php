<?php

namespace HumusUser\Service;

use HumusUser\Form\Register,
    Zend\Form\Form;

class User implements UserInterface
{

    /**
     * @var Form
     */
    protected $registrationForm;

    /**
     * Get registration form
     *
     * @return Register
     */
    public function getRegistrationForm()
    {
        return $this->registrationForm;
    }

    /**
     * Set registration form
     *
     * @param Form $registrationForm
     * @return User
     */
    public function setRegistrationForm(Form $registrationForm)
    {
        $this->registrationForm = $registrationForm;
        return $this;
    }
}