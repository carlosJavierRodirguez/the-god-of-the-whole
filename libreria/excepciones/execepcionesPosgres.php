<?php

/**
 * Archivo de mensajes de error de PostgreSQL en español
 * @package PostgreSQL
 * @author Tu Nombre
 */

// Mensajes de error específicos de PostgreSQL
$PGSQL_ERRORS['23505'] = 'Error: Violación de clave única.';
$PGSQL_ERRORS['23503'] = 'Error: Violación de clave foránea.';
$PGSQL_ERRORS['22012'] = 'Error: División por cero.';
$PGSQL_ERRORS['22008'] = 'Error: Desbordamiento de campo datetime.';
$PGSQL_ERRORS['23502'] = 'Error: Violación de campo NOT NULL.';
$PGSQL_ERRORS['42601'] = 'Error: Error de sintaxis en la consulta SQL.';
$PGSQL_ERRORS['42501'] = 'Error: Privilegios insuficientes.';
$PGSQL_ERRORS['22003'] = 'Error: Valor numérico fuera de rango.';
$PGSQL_ERRORS['23001'] = 'Error: Violación de restricción.';
$PGSQL_ERRORS['40001'] = 'Error: Fallo de serialización.';
$PGSQL_ERRORS['57P01'] = 'Error: Apagado administrativo de la base de datos.';
$PGSQL_ERRORS['57014'] = 'Error: Consulta cancelada.';
$PGSQL_ERRORS['53200'] = 'Error: Fuera de memoria.';
$PGSQL_ERRORS['default'] = 'Error desconocido en la base de datos.';

// Clase para manejar excepciones personalizadas en la base de datos
class ExcepcionBaseDatos extends Exception
{
    private $codigoError;

    // Constructor
    public function __construct($codigoError, $mensaje)
    {
        $this->codigoError = $codigoError;
        // Llamamos al constructor de la clase base Exception
        parent::__construct($mensaje, $codigoError);
    }

    // Obtener el código de error
    public function obtenerCodigoError()
    {
        return $this->codigoError;
    }

    // Obtener el mensaje de error
    public function obtenerMensajeError()
    {
        return $this->getMessage();
    }
}
