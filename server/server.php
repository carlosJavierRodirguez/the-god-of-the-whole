<?php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/../libreria/conexion.php';


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
        echo "Nueva conexión establecida: ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo "Mensaje recibido: $msg\n";
        $data = json_decode($msg, true);

        if (!isset($data['tipo'])) {
            $from->send(json_encode([
                'status' => 'error',
                'mensaje' => 'El mensaje no contiene el tipo de operación.'
            ]));
            echo "Error: Mensaje sin tipo definido.\n";
            return;
        }

        switch ($data['tipo']) {
            case 'crear_sala':
                $this->crearSala($from, $data);
                break;

            case 'unirse_sala':
                $this->unirseASala($from, $data);
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
                    'mensaje' => 'Operación no reconocida.'
                ]));
                echo "Error: Operación no reconocida: {$data['tipo']}\n";
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Conexión cerrada: ({$conn->resourceId})\n";

        foreach ($this->salas as $codigoSala => $sala) {
            if (isset($this->salas[$codigoSala]['usuarios'][$conn->resourceId])) {
                unset($this->salas[$codigoSala]['usuarios'][$conn->resourceId]);

                if (empty($this->salas[$codigoSala]['usuarios'])) {
                    unset($this->salas[$codigoSala]);
                    echo "Sala '{$codigoSala}' eliminada (sin usuarios).\n";
                } else {
                    $this->enviarUsuariosSala($codigoSala);
                }
                break;
            }
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Error en la conexión: {$e->getMessage()}\n";
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
            echo "Error: Datos insuficientes para crear la sala.\n";
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
            echo "Sala '{$nombreSala}' creada con el código '{$codigoSala}'.\n";
        } else {
            $from->send(json_encode([
                'status' => 'error',
                'mensaje' => 'No se pudo crear la sala.'
            ]));
            echo "Error: No se pudo crear la sala '{$nombreSala}'.\n";
        }
    }

    private function unirseASala(ConnectionInterface $from, $data)
    {
        $codigoSala = $data['codigoSala'] ?? '';
        $nombreJugador = $data['nombreJugador'] ?? '';

        if (empty($codigoSala) || empty($nombreJugador)) {
            $from->send(json_encode([
                'status' => 'error',
                'mensaje' => 'Código de sala o nombre de jugador inválido.'
            ]));
            echo "Error: Código de sala o nombre de jugador inválido.\n";
            return;
        }

        // Inserta al usuario en la base de datos
        $query = "INSERT INTO invitado (nombre_invitado, id_sala, imagen_id) 
        SELECT ?, sala.sala_id, ? 
        FROM sala 
        WHERE sala.codigo_sala = ?;";
        $valores = [$nombreJugador, rand(1, 15), $codigoSala];

        try {
            $this->conexion->insertarDatos($query, $valores);
        } catch (Exception $e) {
            echo "Error al registrar el usuario en la base de datos: {$e->getMessage()}\n";
            $from->send(json_encode([
                'status' => 'error',
                'mensaje' => 'No se pudo registrar el usuario en la sala.'
            ]));
            return;
        }

        // Actualiza la lista de usuarios conectados
        $this->enviarUsuariosSala($codigoSala);
        echo "Usuario '{$nombreJugador}' se unió a la sala '{$codigoSala}'.\n";

        $from->send(json_encode([
            'status' => 'success',
            'mensaje' => "Te has unido a la sala '{$codigoSala}'."
        ]));
    }


    private function enviarUsuariosSala($codigoSala)
    {
        $query = "
        SELECT i.nombre_invitado, ip.url_imagen, ip.nombre_imagen
        FROM invitado i
        JOIN sala s ON i.id_sala = s.sala_id
        JOIN \"imagenPerfil\" ip ON i.imagen_id = ip.id_url
        WHERE s.codigo_sala = ?";
        $valores = [$codigoSala];

        try {
            $usuarios = $this->conexion->consultaIniciarSesion($query, $valores);
        } catch (Exception $e) {
            echo "Error al obtener usuarios de la base de datos: {$e->getMessage()}\n";
            return;
        }

        $usuariosList = array_map(function ($usuario) {
            return [
                'nombre_invitado' => $usuario['nombre_invitado'],
                'url_imagen' => $usuario['url_imagen'],
                'nombre_imagen' => $usuario['nombre_imagen']
            ];
        }, $usuarios);

        foreach ($this->clients as $client) {
            $client->send(json_encode([
                'tipo' => 'usuarios_en_sala',
                'codigoSala' => $codigoSala,
                'usuarios' => $usuariosList,
            ]));
        }

        echo "Lista actualizada enviada para la sala '{$codigoSala}': " . json_encode($usuariosList) . "\n";
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
            echo "Error: Mensaje vacío.\n";
            return;
        }

        foreach ($this->clients as $client) {
            // Solo envía a los demás clientes, no al remitente
            if ($client !== $from) {
                $client->send(json_encode([
                    'tipo' => 'mensaje',
                    'codigoSala' => $codigoSala,
                    'mensaje' => $mensaje,
                    'autor' => "Cliente ({$from->resourceId})"
                ]));
            }
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
            echo "Error: Mensaje vacío en broadcast.\n";
            return;
        }

        foreach ($this->clients as $client) {
            $client->send(json_encode([
                'tipo' => 'broadcast',
                'mensaje' => $mensaje,
                'autor' => 'Broadcast'
            ]));
        }

        echo "Broadcast enviado: $mensaje\n";
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
echo "Servidor WebSocket corriendo en ws://localhost:8080\n";
$server->run();
