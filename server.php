<?php
require __DIR__ . '/vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;

$server = IoServer::factory(
    new HttpServer(new WsServer(new Chat())),
    80
);

echo "🚀 خادم الدردشة يعمل على المنفذ 8080...\n";
$server->run();
