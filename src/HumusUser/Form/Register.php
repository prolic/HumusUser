<?php

namespace HumusUser\Form;

use Zend\Form\Element\Captcha as Captcha,
    HumusUser\Module;

class Register extends Base
{

    /**
     * @var Captcha|null
     */
    protected $captchaElement;

    /**
     * Set captcha element
     *
     * @param Captcha $captchaElement
     * @return Register
     */
    public function setCaptchaElement(Captcha $captchaElement)
    {
        $this->captchaElement= $captchaElement;
        $this->initLate(); // @todo find a better way!!!
        return $this;
    }

    /**
     * init late
     *
     * @return void
     */
    public function initLate()
    {
        parent::initLate();
        $this->removeElement('id');
        if (!Module::getOptions()->getEnableUsername()) {
            $this->removeElement('username');
        }
        if (!Module::getOptions()->getEnableDisplayName()) {
            $this->removeElement('display_name');
        }
        if (Module::getOptions()->getRegistrationFormCaptcha() && $this->captchaElement) {
            $this->addElement($this->captchaElement, 'captcha');
        }
        $this->getElement('submit')->setLabel('Register');
    }
}