<?php
include('excepciones/execepcionesPosgres.php');
class Conexion
{
    private $dsn;
    private $server;
    private $usuario;
    private $baseDatos;
    private $password;
    private $conexion;

    public function __construct()
    {
        $this->server = "localhost";
        $this->usuario = "postgres";
        $this->baseDatos = "teoriaConjuntos";
        $this->password = "1083877108";
        $this->conexion = $this->conectar(); // Establecer la conexión al crear el objeto
    }

    public function conectar()
    {
        $this->dsn = 'pgsql:host=' . $this->server . ';port=5432;dbname=' . $this->baseDatos;
        try {
            $conecto = new PDO($this->dsn, $this->usuario, $this->password);
            $conecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conecto; // Retorna la conexión
        } catch (PDOException $e) {
            // Manejar error de conexión
            $this->manejarError($e);
            return null; // Retorna null si no se conectó
        }
    }

    // Método para ejecutar consultas sin retorno de valores
    public function ejecutar($sqlQuery, $values = [])
    {
        if ($this->conexion) {
            try {
                $consulta = $this->conexion->prepare($sqlQuery);
                $consulta->execute($values);
                return $consulta->rowCount(); // Devuelve el número de filas afectadas
            } catch (PDOException $e) {
                // Manejo de errores con código de error de PostgreSQL
                $this->manejarError($e);
                return false; // Retorna false si ocurrió un error
            }
        }
        return false; // Retorna false si no hay conexión
    }

    public function consultaIniciarSesion($sqlQuery, $values)
    {
        try {
            $consulta = $this->conexion->prepare($sqlQuery);
            $consulta->execute($values);
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejo de errores con código de error de PostgreSQL
            $this->manejarError($e);
            return false;
        }
    }

    public function insertarDatos($querysql, $values)
    {
        try {
            $queryEjecutar = $this->conexion->prepare($querysql);
            $queryEjecutar->execute($values);
        } catch (PDOException $e) {
            // Manejo de errores con código de error de PostgreSQL
            $this->manejarError($e);
        }
    }

    public function insertarObtenerId($querysql, $values)
{
    try {
        // Prepara y ejecuta la consulta de inserción
        $queryEjecutar = $this->conexion->prepare($querysql);
        $queryEjecutar->execute($values);

        // Retorna el último ID insertado
        return $this->conexion->lastInsertId();
    } catch (PDOException $e) {
        // Manejo de errores con código de error de PostgreSQL
        $this->manejarError($e);
        return false; // Retorna false si ocurrió un error
    }
}


    private function manejarError($e)
    {
        // Código de error
        $errorCode = $e->getCode();

        // Obtener el mensaje de error de PostgreSQL
        global $PGSQL_ERRORS;
        $errorMessage = isset($PGSQL_ERRORS[$errorCode]) ? $PGSQL_ERRORS[$errorCode] : $PGSQL_ERRORS['default'];

        // Mostrar un mensaje genérico al usuario (sin guardar el error en un archivo)
        echo "Lo sentimos, ha ocurrido un error. Nuestro equipo está trabajando para resolverlo.";
    }
}
