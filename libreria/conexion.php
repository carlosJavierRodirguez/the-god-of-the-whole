<?php
class Conexion
{
    private $dsn;
    private $server;
    private $usuario;
    private $baseDatos;
    private $password;
    private $conexion; // Variable para almacenar la conexión

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
            echo "Error de conexión: " . $e->getMessage();
            return null; // Retorna null si no se conectó
        }
    }

    // Método para ejecutar consultas sin retorno de valores
    public function ejecutar($sqlQuery, $values = [])
    {
        if ($this->conexion) {
            $consulta = $this->conexion->prepare($sqlQuery);
            $consulta->execute($values);
            return $consulta->rowCount(); // Devuelve el número de filas afectadas
        }
        return false; // Retorna false si no hay conexión
    }

    // Otros métodos existentes...
    public function consulta($sqlQuery)
    {
        $consulta = $this->conexion->prepare($sqlQuery);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultaIniciarSesion($sqlQuery, $values)
    {
        $consulta = $this->conexion->prepare($sqlQuery);
        $consulta->execute($values);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultaValor($sqlQuery, $values)
    {
        $consulta = $this->conexion->prepare($sqlQuery);
        $consulta->execute($values);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consulta1($querysql)
    {
        $consulta = $this->conexion->query($querysql);
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertarDatos($querysql, $values)
    {
        $queryEjecutar = $this->conexion->prepare($querysql);
        $queryEjecutar->execute($values);
    }
}
