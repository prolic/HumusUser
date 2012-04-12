<?php

namespace HumusUser\Form;

use Zend\Form\Form,
    Zend\Validator\Validator,
    Zend\EventManager\EventCollection,
    Zend\EventManager\EventManager;

class Base extends Form
{

    /**
     * @var Validator
     */
    protected $emailValidator;

    /**
     * @var Validator
     */
    protected $usernameValidator;

    /**
     * init form late
     *
     * @triggers initLate
     *
     * @return void
     */
    public function initLate()
    {
        $this->setMethod('post');

        $this->addElement('text', 'username', array(
            'filters'    => array('StringTrim', 'StripTags'),
            'validators' => array(
                array('StringLength', true, array(3, 255)),
                //$this->usernameValidator,
            ),
            'required'   => true,
            'label'      => 'Username',
            'order'      => 100,
        ));

        $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim', 'StripTags'),
            'validators' => array(
                'EmailAddress',
                //$this->emailValidator,
            ),
            'required'   => true,
            'label'      => 'Email',
            'order'      => 200,
        ));

        $this->addElement('text', 'display_name', array(
            'filters'    => array('StringTrim', 'StripTags'),
            'validators' => array(
                array('StringLength', true, array(3, 128))
            ),
            'required'   => true,
            'label'      => 'Display Name',
            'order'      => 300,
        ));

        $this->addElement('password', 'password', array(
            'filters'    => array(),
            'validators' => array(
                array('StringLength', true, array(6, 128))
            ),
            'required'   => true,
            'label'      => 'Password',
            'order'      => 400,
        ));

        $this->addElement('password', 'passwordVerify', array(
            'filters'    => array(),
            'validators' => array(
                array('Identical', false, array('token' => 'password'))
            ),
            'required'   => true,
            'label'      => 'Password Verify',
            'order'      => 405,
        ));

        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'order'    => 1000,
        ));

        $this->addElement('hidden', 'id', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'order'      => -100,
        ));

        $this->addElement('hash', 'csrf', array(
            'ignore'     => true,
            'decorators' => array('ViewHelper'),
            'order'      => -100,
        ));

        $this->events()->trigger(__FUNCTION__, $this);
    }

    /**
     * Set email validator
     *
     * @param Validator $emailValidator
     * @return Base
     */
    public function setEmailValidator(Validator $emailValidator)
    {
        $this->emailValidator = $emailValidator;
        return $this;
    }

    /**
     * Set username validator
     *
     * @param Validator $usernameValidator
     * @return Base
     */
    public function setUsernameValidator(Validator $usernameValidator)
    {
        $this->usernameValidator = $usernameValidator;
        $this->initLate(); // yuck
        return $this;
    }

    // trait begin
    /**
     * @var EventCollection
     */
    protected $events;

    /**
     * Set the event manager instance used by this context
     *
     * @param  EventCollection $events
     * @return mixed
     */
    public function setEventManager(EventCollection $events)
    {
        $this->events = $events;
        return $this;
    }

    /**
     * Retrieve the event manager
     *
     * Lazy-loads an EventManager instance if none registered.
     *
     * @return EventCollection
     */
    public function events()
    {
        if (!$this->events instanceof EventCollection) {
            $identifiers = array(__CLASS__, get_class($this));
            if (isset($this->eventIdentifier)) {
                if ((is_string($this->eventIdentifier))
                    || (is_array($this->eventIdentifier))
                    || ($this->eventIdentifier instanceof Traversable)
                ) {
                    $identifiers = array_unique(array_merge($identifiers, (array) $this->eventIdentifier));
                } elseif (is_object($this->eventIdentifier)) {
                    $identifiers[] = $this->eventIdentifier;
                }
                // silently ignore invalid eventIdentifier types
            }
            $this->setEventManager(new EventManager($identifiers));
        }
        return $this->events;
    }
    // trait end
}