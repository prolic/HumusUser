<?php

namespace HumusUser\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\Stdlib\ResponseDescription as Response,
    Zend\View\Model\ViewModel,
    HumusUser\Service\UserInterface as UserService,
    HumusUser\Service\Exception\InvalidArgumentException,
    HumusUser\Module;

class UserController extends ActionController
{
    /**
     * @var UserService
     */
    protected $userService;

    /**
     * Register new user
     */
    public function registerAction()
    {
        /*
        if ($this->zfcUserAuthentication()->getAuthService()->hasIdentity()) {
            return $this->redirect()->toRoute('zfcuser');
        }
        */

        $request = $this->getRequest();
        $userService = $this->getUserService();
        $form = $this->getUserService()->getRegistrationForm();

        if ($request->isPost() && Module::getOptions()->getEnableRegistration()) {
            if ($userService->register($request->post()->toArray())) {
                if (Module::getOptions()->getLoginAfterRegistration()) {
                    $post = $request->post();
                    $post['identity'] = $post['email'];
                    $post['credential'] = $post['password'];
                    return $this->forward()->dispatch('humususer', array('action' => 'authenticate'));
                }
                return $this->redirect()->toRoute('humususer/login');
            }
        }
        return array(
            'registerForm' => $form
        );
    }

    /**
     * Set user service
     *
     * @param UserService $userService
     * @return UserController
     */
    public function setUserService(UserService $userService)
    {
        $this->userService = $userService;
        return $this;
    }

    /**
     * Get user service
     *
     * @return UserService
     */
    public function getUserService()
    {
        return $this->userService;
    }




}