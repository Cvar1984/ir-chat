<?php

namespace Cvar1984\IRC;

class Client {
    public function __construct($host, $port, $timeout = 30)
    {
        $this->irc = fsockopen($host, $port, $errno, $errstr, $timeout);
        if(!$this->irc) throw new RuntimeException($errstr);
        stream_set_blocking($this->irc, 0);
        return $this;
    }
    public function sendMessage(string $channel, string $message)
    {
        fprintf($this->irc, "PRIVMSG #%s :%s\n", $channel, $message);
        return $this;
    }
    public function getMessage()
    {
        while($rawData = fgets($this->irc))
        {
            $dummy .= $rawData;
        }
        return $dummy;
    }
    public function login(string $nick)
    {
        $user = 'USER Linux 127.0.0.1 localhost';
        fprintf($this->irc, "USER %s\n", $user);
        sleep(5);
        fprintf($this->irc, "NICK %s\n", $nick);
        sleep(5);
        return $this;
    }
    public function joinChannel(string $channel)
    {
        fprintf($this->irc, "JOIN #%s\n", $channel);
        sleep(5);
        return $this;
    }
    public function __destruct()
    {
        fclose($this->irc);
    }

}
