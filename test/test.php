<?php

require './vendor/autoload.php';

$channel = 'BHSec';

$irc = new \Cvar1984\IRC\Client('irc.freenode.net', 6667);
echo $irc->login('Cvar1984_bot')
    ->joinChannel($channel)
    ->getMessage();

for($x = 0; $x < 10; $x++)
{
    $irc->sendMessage($channel, 'Anjay mabar' . $x);
}

