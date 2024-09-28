<?php
class Conexion
{
    private $dsn;
    private $server;
    private $usuario;
    private $baseDatos;
    private $password;

    public function __construct()
    {
        $this->server = "localhost";
        $this->usuario = "postgres";
        $this->baseDatos = "teoriaConjuntos";
        $this->password = "";  
    }

    public function conectar()
    {
        $this->dsn = 'pgsql:host=' . $this->server . ';port=5432;dbname=' . $this->baseDatos;
        try {
            $conecto = new PDO($this->dsn, $this->usuario, $this->password);
            $conecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexión exitosa";
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();  // Mensaje de error más descriptivo
        }
        return isset($conecto) ? $conecto : null;  // Retorna null si no se conectó
    }



    public function consulta($sqlQuery)
    {
        $conexiondb = $this->conectar();
        $consulta = $conexiondb->prepare($sqlQuery);

        $consulta->execute();

        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $resultado[] = $fila;
        }
        return $resultado;
    }
    // funcion para el inicio de sesión
    public function consultaIniciarSesion($sqlQuery, $values)
    {
        $conexion = $this->conectar();
        $consulta = $conexion->prepare($sqlQuery);
        $consulta->execute($values);
        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $resultados[] = $fila;
        }
        return $resultados;
    }

    public function consulta1($querysql)
    {
        $conexion = $this->conectar();
        $consulta = $conexion->query($querysql);
        while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $resultados[] = $fila;
        }
        return $resultados;
    }
    // Función para insertar datos
    public function ejecutar($querysql, $values)
    {
        $conexion = $this->conectar();
        $queryEjecutar = $conexion->prepare($querysql);
        $queryEjecutar->execute($values);
    }
}
