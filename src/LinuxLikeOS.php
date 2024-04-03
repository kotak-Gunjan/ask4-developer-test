<?php

// namespace Ask4\Network;

class LinuxLikeOS implements DeviceClient
{
    public function sendCommand(string $ip, string $command): string
    {
        
        return "InterfaceName,MACAddress,IPAddress\neth0,00:11:22:33:44:55,192.168.1.10\neth1,11:22:33:44:55:66,192.168.1.20";
    }
}
