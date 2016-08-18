<?php

    require __DIR__. "/../vendor/autoload.php";
    use Ratchet\Server\IoServer;
    use Ratchet\Http\HttpServer;
    use Ratchet\WebSocket\WsServer;
    use chatR\chat;

    $server= IoServer::factory(new HttpServer(new WsServer(new Chat)),8000);
    $server->run();
