<?php

namespace Telegram;

use Symfony\Component\Yaml\Yaml;

class Bot
{
    private $_config;
    private $_api_url;

    function __construct()
    {
        $this->_config = Yaml::parse(file_get_contents(__DIR__.'/../../config/config.yml'));
        $this->_api_url = $this->_config['api_url'] . $this->_config['bot_token'];
    }

    public function getApiURL()
    {
        return $this->_api_url;
    }
}