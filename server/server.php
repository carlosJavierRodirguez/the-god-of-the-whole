<?php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require __DIR__ . '/vendor/autoload.php';
include('./libreria/conexion.php');

class SalaManager implements MessageComponentInterface
{
    protected $clients;
    protected $salas;
    public $conexion;

    public function __construct()
    {
        $this->clients = new SplObjectStorage;
        $this->salas = [];
        $this->conexion = new Conexion();
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

        if ($data['tipo'] === 'unirse_sala') {
            $this->unirseASala($from, $data);
        } elseif ($data['tipo'] === 'crear_sala') {
            $this->crearSala($from, $data);
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Conexión {$conn->resourceId} cerrada\n";

        foreach ($this->salas as $codigo => $sala) {
            if (isset($this->salas[$codigo]['usuarios'][$conn->resourceId])) {
                unset($this->salas[$codigo]['usuarios'][$conn->resourceId]);

                if (empty($this->salas[$codigo]['usuarios'])) {
                    unset($this->salas[$codigo]);
                } else {
                    $this->actualizarUsuariosSala($codigo);
                }
                break;
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }

    private function crearSala(ConnectionInterface $from, $data)
    {
        $nombreSala = $data['nombreSala'];
        $codigoSala = $data['codigoSala'];
        $usuarioId = $data['usuarioId'];

        $query = "INSERT INTO sala (nombre_sala, codigo_sala, creador_sala) VALUES (?, ?, ?)";
        $values = [$nombreSala, $codigoSala, $usuarioId];
        $respuesta = $this->conexion->insertarDatos($query, $values);

        if ($respuesta) {
            $this->salas[$codigoSala] = [
                'codigoSala' => $codigoSala,
                'nombreSala' => $nombreSala,
                'usuarios' => []
            ];

            $from->send(json_encode([
                'status' => 'success',
                'mensaje' => 'Sala creada con éxito',
                'codigoSala' => $codigoSala
            ]));
        } else {
            $from->send(json_encode([
                'status' => 'error',
                'mensaje' => 'No se pudo crear la sala.'
            ]));
        }
    }

    private function unirseASala($from, $data)
    {
        $codigoSala = $data['codigoSala'];
        $nombreJugador = $data['nombreJugador'];

        $query = "SELECT * FROM sala WHERE codigo_sala = :codigoSala";
        $values = [':codigoSala' => $codigoSala];
        $resultado = $this->conexion->consultaIniciarSesion($query, $values);

        if ($resultado) {
            if (!isset($this->salas[$codigoSala])) {
                $this->salas[$codigoSala] = [
                    'codigoSala' => $codigoSala,
                    'nombreSala' => $resultado['nombre_sala'],
                    'usuarios' => []
                ];
            }

            $this->salas[$codigoSala]['usuarios'][$from->resourceId] = $nombreJugador;
            $this->actualizarUsuariosSala($codigoSala);

            $response = [
                'status' => 'success',
                'mensaje' => 'Te has unido a la sala.',
                'nombreSala' => $this->salas[$codigoSala]['nombreSala']
            ];
        } else {
            $response = [
                'status' => 'error',
                'mensaje' => 'El código de sala no es válido.'
            ];
        }

        $from->send(json_encode($response));
    }

    private function actualizarUsuariosSala($codigoSala)
    {
        $usuarios = array_values($this->salas[$codigoSala]['usuarios']);

        foreach ($this->clients as $client) {
            if (isset($this->salas[$codigoSala]['usuarios'][$client->resourceId])) {
                $client->send(json_encode([
                    'type' => 'usuarios_en_sala',
                    'codigoSala' => $codigoSala,
                    'usuarios' => $usuarios
                ]));
            }
        }
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new SalaManager()
        )
    ),
    8080
);

$server->run();
