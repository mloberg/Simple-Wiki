<?php

use Silex\Application;

class Flash
{

    private $app;
    private $messages = array();

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->messages = $this->app['session']->get('flashStack');
        $this->app['session']->set('flashStack', null);
    }

    public function messages()
    {
        return $this->messages;
    }

    public function arrayOrMessage($messages, $default, $type = 'error')
    {
        if (count($messages) === 0) {
            $messages[] = $default;
        }
        foreach ($messages as $message) {
            call_user_func(array($this, $type), $message);
        }
    }

    public function __call($method, $parameters = array())
    {
        $messageStack = $this->app['session']->get('flashStack');
        $messageStack[] = array(
            'type'    => $method === 'error' ? 'danger' : $method,
            'message' => $parameters[0],
        );
        $this->app['session']->set('flashStack', $messageStack);
    }

}
