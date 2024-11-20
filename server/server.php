<?php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

include('./libreria/conexion.php');
$conexion = new Conexion();

require __DIR__ . '/vendor/autoload.php';

class SalaManager implements MessageComponentInterface
{
    protected $clients;
    protected $salas; // Para almacenar las salas y su información
    public $conexion;

    public function __construct($conexion)
    {
        $this->clients = new SplObjectStorage;
        $this->salas = [];
        $this->conexion = $conexion;
    }


    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "Nueva conexión: ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo "Mensaje recibido: " . $msg . "\n";
        $data = json_decode($msg, true);

        if ($data['tipo'] === 'crear_sala') {
            $nombreSala = $data['nombreSala'];
            $codigoSala = $data['codigoSala'];
            $userId = $data['userId'];

            $query = "INSERT INTO sala(nombre_sala, codigo_sala, creador_sala) VALUES (:nombreSala, :codigoSala, :userId)";
            $values = [':nombreSala' => $nombreSala, ':codigoSala' => $codigoSala, ':userId' => $userId];
            $respuesta = $this->conexion->insertarDatos($query, $values);

            if ($respuesta) {
                $from->send(json_encode([
                    'status' => 'success',
                    'mensaje' => 'Sala creada con éxito',
                    'nombreSala' => $nombreSala,
                    'codigoSala' => $codigoSala
                ]));
            } else {
                $from->send(json_encode([
                    'status' => 'error',
                    'mensaje' => 'No se pudo crear la sala. Por favor, inténtalo de nuevo.'
                ]));
            }
        }
    }



    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Conexión {$conn->resourceId} cerrada\n";

        // Opcional: eliminar al usuario de cualquier sala
        foreach ($this->salas as $codigo => $sala) {
            if (in_array($conn->resourceId, $sala['usuarios'])) {
                unset($this->salas[$codigo]['usuarios'][$conn->resourceId]);
                if (empty($this->salas[$codigo]['usuarios'])) {
                    unset($this->salas[$codigo]); // Eliminar la sala si está vacía
                }
                break;
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Ocurrió un error: {$e->getMessage()}\n";
        $conn->close();
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new SalaManager($conexion)
        )
    ),
    8080
);


$server->run();
