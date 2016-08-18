<?php
namespace chatR;
use \Ratchet\MessageComponentInterface;
use \Ratchet\ConnectionInterface;
class chat implements \Ratchet\MessageComponentInterface
    {
        protected $clients;

    public function __construct()
    {
        $this->clients= new \SplObjectStorage;

    }


    public function onOpen(ConnectionInterface $connection) {
        //store the new connection
        $this->clients->attach($connection);

        echo "someone connected\n";
    }



    public function onMessage(ConnectionInterface $connection, $msg)
    {
        // TODO: Implement onMessage() method.
        foreach($this->clients as $client)
        {
            if($client !== $connection )
                $client->send($msg);
        }
    }

    public function onClose(ConnectionInterface $connection)
    {
        $this->clients->detech($connection);
    }

    public function onError(ConnectionInterface $connection, \Exception $e)
    {
        // TODO: Implement onError() method.

        echo "The following error occured".$e->getMessage();
        $connection->close();
    }

}

?>