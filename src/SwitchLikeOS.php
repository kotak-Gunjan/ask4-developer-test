<?php

// namespace Ask4\Network;

class SwitchLikeOS implements DeviceClient
{
    public function sendCommand(string $ip, string $command): string
    {
        
        return "InterfaceName,MACAddress,IPAddress\neth0,aa:bb:cc:dd:ee:ff,192.168.1.30\neth1,22:33:44:55:66:77,192.168.1.40";
    }
}
