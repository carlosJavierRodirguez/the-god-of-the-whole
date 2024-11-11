<?php

/**
 * Archivo de mensajes de error de PostgreSQL en español
 * @package PostgreSQL
 * @author The god of the whole
 */

// Mensajes de error específicos de PostgreSQL
$PGSQL_ERRORS = [
    '23505' => 'Error: Violación de clave única.',
    '23503' => 'Error: Violación de clave foránea.',
    '22012' => 'Error: División por cero.',
    '22008' => 'Error: Desbordamiento de campo datetime.',
    '23502' => 'Error: Violación de campo NOT NULL.',
    '42601' => 'Error: Error de sintaxis en la consulta SQL.',
    '42501' => 'Error: Privilegios insuficientes.',
    '22003' => 'Error: Valor numérico fuera de rango.',
    '23001' => 'Error: Violación de restricción.',
    '40001' => 'Error: Fallo de serialización.',
    '57P01' => 'Error: Apagado administrativo de la base de datos.',
    '57014' => 'Error: Consulta cancelada.',
    '53200' => 'Error: Fuera de memoria.',
    'default' => 'Error desconocido en la base de datos.'
];

