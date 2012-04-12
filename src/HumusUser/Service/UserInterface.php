<?php

namespace HumusUser\Service;

use Zend\Form\Form;

interface UserInterface
{

    /**
     * Get registration form
     *
     * @return \Zend\Form\Form
     */
    public function getRegistrationForm();
}