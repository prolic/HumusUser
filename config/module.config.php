<?php
return array(
    'humususer' => array(
        'user_model_class'          => 'HumusUser\Model\User',
        'enable_registration'       => true,
        'enable_username'           => false,
        'enable_display_name'       => false,
        'require_activation'        => false,
        'login_after_registration'  => true,
        'registration_form_captcha' => true,
        'password_hash_algorithm'   => 'blowfish', // blowfish, sha512, sha256
        'blowfish_cost'             => 10,         // integer between 4 and 31
        'sha256_rounds'             => 5000,       // integer between 1000 and 999,999,999
        'sha512_rounds'             => 5000,       // integer between 1000 and 999,999,999
    ),
    'di' => array(
        'instance' => array(
            'alias' => array(
                'humususer'                          => 'HumusUser\Controller\UserController',
                'humususer_user_service'             => 'HumusUser\Service\User',
                'humususer_captcha_element'          => 'Zend\Form\Element\Captcha',
                'humususer_form_register'            => 'HumusUser\Form\Register',
            ),
            'humususer_captcha_element' => array(
                'parameters' => array(
                    'spec' => 'captcha',
                    'options'=>array(
                        'label'      => 'Please enter the 5 letters displayed below:',
                        'required'   => true,
                        'captcha'    => array(
                            'captcha' => 'Figlet',
                            'wordlen' => 5,
                            'timeout '=> 300,
                        ),
                        'order'      => 500,
                    ),
                ),
            ),
            'humususer' => array(
                'parameters' => array(
                    'userService'  => 'humususer_user_service',
                ),
            ),
            'Zend\View\Resolver\TemplatePathStack' => array(
                'parameters' => array(
                    'paths'  => array(
                        'humususer' => __DIR__ . '/../view',
                    ),
                ),
            ),
            'humususer_user_service' => array(
                'parameters' => array(
                    'registrationForm' => 'humususer_form_register',
                ),
            ),
            'humususer_form_register' => array(
                'parameters' => array(
                    //'emailValidator'    => 'humususer_uemail_validator',
                    //'usernameValidator' => 'humususer_uusername_validator',
                    'captchaElement'   => 'humususer_captcha_element'
                ),
            ),

            /**
             * Routes
             */

            'Zend\Mvc\Router\RouteStack' => array(
                'parameters' => array(
                    'routes' => array(
                        'humususer' => array(
                            'type' => 'Literal',
                            'priority' => 1000,
                            'options' => array(
                                'route' => '/user',
                                'defaults' => array(
                                    'controller' => 'humususer',
                                    'action'     => 'index',
                                ),
                            ),
                            'may_terminate' => true,
                            'child_routes' => array(
                                'register' => array(
                                    'type' => 'Literal',
                                    'options' => array(
                                        'route' => '/register',
                                        'defaults' => array(
                                            'controller' => 'humususer',
                                            'action'     => 'register',
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
);
