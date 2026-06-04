<?php
namespace MyApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "✅ مستخدم جديد دخل (ID: {$conn->resourceId})\n";
        echo "👥 عدد المتصلين الآن: " . count($this->clients) . "\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo "📨 رسالة جديدة: {$msg}\n";

        foreach ($this->clients as $client) {
            $client->send($msg);
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "❌ خرج مستخدم (ID: {$conn->resourceId})\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "⚠️ خطأ: {$e->getMessage()}\n";
        $conn->close();
    }
}
