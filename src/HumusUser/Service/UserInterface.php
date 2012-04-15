<?php

namespace HumusUser\Service;

use Zend\Form\Form;

interface UserInterface
{

    /**
     * Get registration form
     *
     * @return Form
     */
    public function getRegistrationForm();

    /**
     * Set registration form
     *
     * @param Form $registrationForm
     */
    public function setRegistrationForm(Form $registrationForm);

    /**
     * Registers a new user
     *
     * @param array $data
     * @return bool
     */
    public function register(array $data);
}