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

        if (!isset($data['tipo'])) {
            $from->send(json_encode([
                'status' => 'error',
                'mensaje' => 'El mensaje no contiene el tipo de operación.'
            ]));
            return;
        }

        switch ($data['tipo']) {
            case 'unirse_sala':
                $this->unirseASala($from, $data);
                break;

            case 'crear_sala':
                $this->crearSala($from, $data);
                break;

            case 'mensaje':
                $this->retransmitirMensaje($from, $data);
                break;

            case 'broadcast':
                $this->enviarABroadcast($from, $data);
                break;

            default:
                $from->send(json_encode([
                    'status' => 'error',
                    'mensaje' => 'Tipo de operación no reconocido.'
                ]));
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
        $nombreSala = $data['nombreSala'] ?? '';
        $codigoSala = $data['codigoSala'] ?? '';
        $usuarioId = $data['usuarioId'] ?? '';

        if (empty($nombreSala) || empty($codigoSala) || empty($usuarioId)) {
            $from->send(json_encode([
                'status' => 'error',
                'mensaje' => 'Datos insuficientes para crear la sala.'
            ]));
            return;
        }

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
        $codigoSala = $data['codigoSala'] ?? '';
        $nombreJugador = $data['nombreJugador'] ?? '';

        if (empty($codigoSala) || empty($nombreJugador)) {
            $from->send(json_encode([
                'status' => 'error',
                'mensaje' => 'Código de sala o nombre de jugador inválido.'
            ]));
            return;
        }

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

    private function retransmitirMensaje(ConnectionInterface $from, $data)
    {
        $mensaje = $data['mensaje'] ?? '';
        $codigoSala = $data['codigoSala'] ?? '';

        if (empty($mensaje)) {
            $from->send(json_encode([
                'status' => 'error',
                'mensaje' => 'El mensaje no puede estar vacío.'
            ]));
            return;
        }

        foreach ($this->clients as $client) {
            $client->send(json_encode([
                'tipo' => 'mensaje',
                'mensaje' => $mensaje,
                'autor' => $client === $from ? "Tú" : "Cliente ({$from->resourceId})",
                'esTuMensaje' => $client === $from // true si el mensaje es del cliente receptor
            ]));
        }
    }




    private function enviarABroadcast(ConnectionInterface $from, $data)
    {
        $mensaje = $data['mensaje'] ?? '';

        if (empty($mensaje)) {
            $from->send(json_encode([
                'status' => 'error',
                'mensaje' => 'El mensaje no puede estar vacío.'
            ]));
            return;
        }

        foreach ($this->clients as $client) {
            $client->send(json_encode([
                'tipo' => 'broadcast',
                'mensaje' => $mensaje,
                'autor' => 'Broadcast'
            ]));
        }
    }

    private function actualizarUsuariosSala($codigoSala)
    {
        $usuarios = array_values($this->salas[$codigoSala]['usuarios']);

        foreach ($this->clients as $client) {
            if (isset($this->salas[$codigoSala]['usuarios'][$client->resourceId])) {
                $client->send(json_encode([
                    'tipo' => 'usuarios_en_sala',
                    'codigoSala' => $codigoSala,
                    'usuarios' => $usuarios
                ]));
            }
        }
    }
}

// Inicia el servidor WebSocket
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new SalaManager()
        )
    ),
    8080
);

$server->run();
