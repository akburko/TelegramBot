<?php

namespace Telegram;

use Symfony\Component\Yaml\Yaml;
use GuzzleHttp\Client;

class Bot
{
    private $_config;
    private $_api_url;
    private $_request;
    private $_client;

    function __construct()
    {
        $this->_config = Yaml::parse(file_get_contents(__DIR__.'/../../config/config.yml'));
        $this->_api_url = $this->_config['api_url'] . $this->_config['bot_token'] . '/';
        $this->_request = json_decode(file_get_contents('php://input'));
        $this->_client = new Client();
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
            $text = $this->_config['commands'][$command]['text'];
        else
            $text = $this->_config['commands']['404']['text'];
        return $this->_client->get($this->_api_url . 'sendMessage', array('json' => array('chat_id' => $this->_request->message->chat->id, "text" => $text)));
    }

}