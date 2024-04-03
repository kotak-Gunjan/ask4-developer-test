<?php


require_once 'DeviceClient.php'; 
require_once 'LinuxLikeOS.php'; 
require_once 'SwitchLikeOS.php'; 

function printInterfaceConfig(string $hostname, $conn): void
{

    if (!$conn) {
        echo "Database connection is not valid.";
        return;
    }

    $sql = "SELECT hostname, management_protocol FROM Devices WHERE hostname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $hostname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "Device not found in the database.";
        return;
    }

    $row = $result->fetch_assoc();
    $management_protocol = $row['management_protocol'];

    if ($management_protocol == 'SSH') {
        $client = new LinuxLikeOS();
    } elseif ($management_protocol == 'telnet') {
        $client = new SwitchLikeOS();
    } else {
        echo "Unsupported management protocol.";
        return;
    }


    $response = $client->sendCommand($hostname, 'list_interface_config');

    // Parsing the response and printing interface configuration in CSV format
    $lines = explode("\n", $response);
    echo "InterfaceName,MACAddress,IPAddress\n";
    foreach ($lines as $line) {
        $fields = explode(',', $line);
        echo $fields[0] . ',' . $fields[1] . ',' . $fields[2] . "\n";
    }
}


if (php_sapi_name() !== 'cli') {
    die("This script can only be executed from the command line.");
}


if ($argc != 2) {
    die("Usage: php interface_config_printer.php <device_hostname>\n");
}

// device hostname from command line arguments
$hostname = $argv[1];

// database connection setup
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ask4";

$conn = new mysqli($servername, $username, $password, $dbname);

printInterfaceConfig($hostname, $conn);

// Closing the database connection
$conn->close();
