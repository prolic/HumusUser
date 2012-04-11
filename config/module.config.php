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
                'humususer_auth_service'             => 'Zend\Authentication\AuthenticationService',
                'humususer_uemail_validator'         => 'HumusUser\Validator\NoRecordExists',
                'humususer_uusername_validator'      => 'HumusUser\Validator\NoRecordExists',
                'humususer_captcha_element'          => 'Zend\Form\Element\Captcha',

                // Default Zend\Db
                'humususer_zend_db_adapter' => 'Zend\Db\Adapter\Adapter',
                'humususer_user_mapper'     => 'HumusUser\Model\UserMapper',
                'humususer_user_tg'         => 'Zend\Db\TableGateway\TableGateway',
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
                    'loginForm'    => 'HumusUser\Form\Login',
                    'registerForm' => 'HumusUser\Form\Register',
                    'userService'  => 'HumusUser\Service\User',
                ),
            ),
            'Zend\View\Resolver\TemplatePathStack' => array(
                'parameters' => array(
                    'paths'  => array(
                        'humususer' => __DIR__ . '/../view',
                    ),
                ),
            ),
            'Zend\Mvc\Controller\PluginLoader' => array(
                'parameters' => array(
                    'map' => array(
                        'humusUserAuthentication' => 'HumusUser\Controller\Plugin\HumusUserAuthentication',
                    ),
                ),
            ),
            'HumusUser\Controller\Plugin\HumusUserAuthentication' => array(
                'parameters' => array(
                    'authAdapter' => 'HumusUser\Authentication\Adapter\AdapterChain',
                    'authService' => 'humususer_auth_service',
                ),
            ),
            'HumusUser\Authentication\Adapter\AdapterChain' => array(
                'parameters' => array(
                    'defaultAdapter' => 'HumusUser\Authentication\Adapter\Db',
                ),
            ),
            'HumusUser\Authentication\Adapter\Db' => array(
                'parameters' => array(
                    'mapper' => 'humususer_user_mapper',
                ),
            ),
            'humususer_auth_service' => array(
                'parameters' => array(
                    'storage' => 'HumusUser\Authentication\Storage\Db',
                ),
            ),
            'HumusUser\Authentication\Storage\Db' => array(
                'parameters' => array(
                    'mapper' => 'humususer_user_mapper',
                ),
            ),
            'HumusUser\Service\User' => array(
                'parameters' => array(
                    'authService'    => 'humususer_auth_service',
                    'userMapper'     => 'humususer_user_mapper',
                ),
            ),
            'HumusUser\Form\Register' => array(
                'parameters' => array(
                    'emailValidator'    => 'humususer_uemail_validator',
                    'usernameValidator' => 'humususer_uusername_validator',
                    'captcha_element'   => 'humususer_captcha_element'
                ),
            ),
            'humususer_uemail_validator' => array(
                'parameters' => array(
                    'mapper'  => 'humususer_user_mapper',
                    'options' => array(
                        'key' => 'email',
                    ),
                ),
            ),
            'humususer_uusername_validator' => array(
                'parameters' => array(
                    'mapper'  => 'humususer_user_mapper',
                    'options' => array(
                        'key' => 'username',
                    ),
                ),
            ),

            /**
             * Mapper / DB
             */
            'HumusUser\Model\UserMapper' => array(
                'parameters' => array(
                    'tableGateway'  => 'humususer_user_tg',
                ),
            ),
            'humususer_user_tg' => array(
                'parameters' => array(
                    'tableName' => 'user',
                    'adapter'   => 'humususer_zend_db_adapter',
                ),
            ),

            /**
             * View helper(s)
             */
            'Zend\View\HelperLoader' => array(
                'parameters' => array(
                    'map' => array(
                        'humusUserIdentity' => 'HumusUser\View\Helper\HumusUserIdentity',
                        'humusUserLoginWidget' => 'HumusUser\View\Helper\HumusUserLoginWidget',
                    ),
                ),
            ),
            'HumusUser\View\Helper\HumusUserIdentity' => array(
                'parameters' => array(
                    'authService' => 'humususer_auth_service',
                ),
            ),
            'HumusUser\View\Helper\HumusUserLoginWidget' => array(
                'parameters' => array(
                    'loginForm'      => 'HumusUser\Form\Login',
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
                                'login' => array(
                                    'type' => 'Literal',
                                    'options' => array(
                                        'route' => '/login',
                                        'defaults' => array(
                                            'controller' => 'humususer',
                                            'action'     => 'login',
                                        ),
                                    ),
                                ),
                                'authenticate' => array(
                                    'type' => 'Literal',
                                    'options' => array(
                                        'route' => '/authenticate',
                                        'defaults' => array(
                                            'controller' => 'humususer',
                                            'action'     => 'authenticate',
                                        ),
                                    ),
                                ),
                                'logout' => array(
                                    'type' => 'Literal',
                                    'options' => array(
                                        'route' => '/logout',
                                        'defaults' => array(
                                            'controller' => 'humususer',
                                            'action'     => 'logout',
                                        ),
                                    ),
                                ),
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
