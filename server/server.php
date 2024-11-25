<?php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

include('./libreria/conexion.php');

require __DIR__ . '/vendor/autoload.php';

class SalaManager implements MessageComponentInterface
{
    protected $clients;
    protected $salas; // Para almacenar las salas y su información
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

        // Asegúrate de que el tipo sea "unirse_sala"
        if ($data['tipo'] === 'unirse_sala') {
            // Lógica para unirse a la sala
            $this->unirseASala($from, $data);
            $from->send("Bienvenido a la sala " . $data['sala']);
        } elseif ($data['tipo'] === 'crear_sala') {
            // Lógica para crear una sala
            $this->crearSala($from, $data);
        }
    }



    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Conexión {$conn->resourceId} cerrada\n";

        // Eliminar al usuario de cualquier sala en la que esté
        foreach ($this->salas as $codigo => $sala) {
            if (isset($this->salas[$codigo]['usuarios'][$conn->resourceId])) {
                unset($this->salas[$codigo]['usuarios'][$conn->resourceId]);

                // Si no hay usuarios en la sala, podemos eliminarla
                if (empty($this->salas[$codigo]['usuarios'])) {
                    unset($this->salas[$codigo]);
                } else {
                    // Actualizar la lista de usuarios en la sala
                    $this->actualizarUsuariosSala($codigo);
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

    // Función para crear una nueva sala
    private function crearSala(ConnectionInterface $from, $data)
    {
        $nombreSala = $data['nombreSala'];
        $codigoSala = $data['codigoSala'];
        $usuarioId = $data['userId'];

        // Insertar la sala en la base de datos
        $query = "INSERT INTO sala (nombre_sala, codigo_sala, creador_sala) VALUES (:nombreSala, :codigoSala, :usuarioId)";
        $values = [':nombreSala' => $nombreSala, ':codigoSala' => $codigoSala, ':userId' => $usuarioId];
        $respuesta = $this->conexion->insertarDatos($query, $values);

        if ($respuesta) {
            $this->salas[$codigoSala] = [
                'codigoSala' => $codigoSala,
                'nombreSala' => $nombreSala,
                'usuarios' => []
            ];

            // Enviar un mensaje a todos los clientes conectados
            $from->send(json_encode([
                'status' => 'success',
                'mensaje' => 'Sala creada con éxito',
                'codigoSala' => $codigoSala,
                'nombreSala' => $nombreSala
            ]));
        } else {
            $from->send(json_encode([
                'status' => 'error',
                'mensaje' => 'No se pudo crear la sala. Inténtalo nuevamente.'
            ]));
        }
    }

    // Función para unirse a una sala existente
    private function unirseASala($from, $data)
    {
        $codigoSala = $data['codigoSala'];
        $nombreJugador = $data['nombreJugador'];

        // Crear la conexión a la base de datos
        $conexionBD = new Conexion();

        // Verificar si la sala existe en la base de datos
        $query = "SELECT * FROM sala WHERE codigo_sala = :codigoSala";
        $values = [':codigoSala' => $codigoSala];
        $resultado = $conexionBD->consultaIniciarSesion($query, $values);

        if ($resultado) {
            // Añadir el jugador a la sala
            if (!isset($this->salas[$codigoSala])) {
                $this->salas[$codigoSala] = [
                    'codigoSala' => $codigoSala,
                    'nombreSala' => $resultado['nombre_sala'], // Asumiendo que la respuesta de la consulta tiene este campo
                    'usuarios' => []
                ];
            }

            // Agregar el jugador a la lista de usuarios de la sala
            $this->salas[$codigoSala]['usuarios'][$from->resourceId] = $nombreJugador;

            // Responder con éxito
            $response = [
                'status' => 'success',
                'mensaje' => 'Te has unido a la sala con éxito.',
                'nombreSala' => $this->salas[$codigoSala]['nombreSala']
            ];
        } else {
            // Sala no encontrada, responde con error
            $response = [
                'status' => 'error',
                'mensaje' => 'El código de la sala no es válido.',
            ];
        }

        // Enviar la respuesta al cliente
        $from->send(json_encode($response)); // Enviando respuesta al cliente
    }







    // Función para actualizar la lista de usuarios en una sala
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
