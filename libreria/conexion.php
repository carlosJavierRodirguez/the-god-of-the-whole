<?php
    class conexion{
       private $host;
       private $dbname;
       private $user;
       private $pass;

        public function __construct(){
           $this->host= "localhost";
           $this->dbname= "juego";
           $this->user= "root";
           $this->pass= "";
        }

        public function conectar(){
            try{
                //establecer la conexión con MSQL utilizando PDD
                $conecto = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->pass);
                

                //OPCIONAL: configurar el modo de error para manejar excepciones
                $conecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //si llegas a este punto, la conexion ha sido exitosa
               // echo "conexión exitosa a la base de datos <br>";
            }catch(PDOException $e){
                //en caso de error, mostrar el mensaje de error
                die("error de conexión:" . $e->getMessage());
            }
            return $conecto;
        }

        public function consulta($sqlQuery){
            $conexiondb=$this->conectar();
            $consulta=$conexiondb->prepare($sqlQuery);

            $consulta->execute();

            while ($fila=$consulta->fetch(PDO::FETCH_ASSOC)){
                $resultado[]=$fila;
            }
            return $resultado;
        }

        public function consulta1($querysql){
            $conexion=$this->conectar();
            $consulta = $conexion->query($querysql);
            while ($fila = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $resultados[] = $fila;
            }
            return $resultados;
        }

        public function ejecutar($querysql,$values){
            $conexion=$this->conectar();
            $queryEjecutar = $conexion->prepare($querysql);
            $queryEjecutar->execute($values);
        }

    }
?>