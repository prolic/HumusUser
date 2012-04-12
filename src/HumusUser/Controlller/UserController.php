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
        $form = $this->getUserService()->getRegistrationForm();

        $fm = $this->flashMessenger()->setNamespace(__METHOD__)->getMessages();
        if (isset($fm[0])) {
            $this->registerForm->isValid($fm[0]);
        }

        if ($request->isPost() && Module::getOptions()->getEnableRegistration()) {
            try {
                $this->getUserService()->register($request->post()->toArray());
                if (Module::getOptions()->getLoginAfterRegistration()) {
                    $post = $request->post();
                    $post['identity'] = $post['email'];
                    $post['credential'] = $post['password'];
                    return $this->forward()->dispatch('humususer', array('action' => 'authenticate'));
                }
                return $this->redirect()->toRoute('humususer/login');
            } catch (InvalidArgumentException $e) {
                foreach ($form->getMessages() as $message) {
                    $this->flashMessenger()->setNamespace(__METHOD__)->addMessage($message);
                }
                return $this->redirect()->toRoute('humususer/register');
            }
        }
        return array(
            'registerForm' => $form,
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