<?php

namespace Telegram;

use Symfony\Component\Yaml\Yaml;

class Bot
{
    private $_config;
    private $_api_url;
    private $_request;

    function __construct()
    {
        $this->_config = Yaml::parse(file_get_contents(__DIR__.'/../../config/config.yml'));
        $this->_api_url = $this->_config['api_url'] . $this->_config['bot_token'];
        $this->_request = json_decode(file_get_contents('php://input'));
    }

    public function getApiURL()
    {
        return $this->_api_url;
    }

    public function getRequest()
    {
        return $this->_request;
    }

    public function execCommand()
    {
        $commands = explode(' ',$this->_request->message->text);
        $command = substr($commands[0],1);
        if (isset($this->_config['commands'][$command]))
            return $this->_config['commands'][$command]['text'];
        else
            return 'The command is not exists.';
    }
}