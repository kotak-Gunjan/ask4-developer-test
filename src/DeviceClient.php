<?php

// namespace Ask4\Network;

interface DeviceClient
{
    /**
     * Synchronously executes the given command and returns the output
     *
     * A connection to the specified IP will be opened (ignore authentication), and the
     * command will be sent.  The response will be returned verbatim as a string.
     *
     * @param string $ip IP of device to connect to
     * @param string $command Command to execute
     * @return string Response from the device
     */
    public function sendCommand(string $ip, string $command): string;
}
