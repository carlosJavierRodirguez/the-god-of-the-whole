<?php
// ejemplo
    include('conexion.php');

    $conexion = new conexion();

    $values = array(
        ':selTipoIdentificacion'=> $_POST['selTipoIdentificacion'],
        ':txtNumeroIdentificacion'=> $_POST['txtNumeroIdentificacion'],
        ':txtNombres'=> $_POST['txtNombres'],
        ':txtPrimerApellido'=> $_POST['txtPrimerApellido'],
        ':txtSegundoApellido'=> $_POST['txtSegundoApellido'],
        ':txtFechaNacimiento'=> $_POST['txtFechaNacimiento'],
        ':txtTelefono'=> $_POST['txtTelefono'],
        ':txtDireccionResidencia'=> $_POST['txtDireccionResidencia'],
        ':txtEmail'=> $_POST['txtEmail'],
        ':selMunicipioResidencia'=> $_POST['selMunicipioResidencia'],
        ':selMunicipioNacimiento'=> $_POST['selMunicipioNacimiento']
        
    );

    $sqlInsertPersona="INSERT INTO `promosocial`.`persona`
    (
    `TipoIdentificacionId`,
    `personaNumeroIdentificacion`,
    `personaNombres`,
    `personaPrimerApellido`,
    `personaSegundoApellido`,
    `personaFechaNacimiento`,
    `personaTelefono`,
    `personaDireccionResidencia`,
    `personaEmail`,
    `personaMunicipioResidencia`,
    `personaMunicipioNacimiento`)
    VALUES
    (:selTipoIdentificacion,
    :txtNumeroIdentificacion,
    :txtNombres,
    :txtPrimerApellido,
    :txtSegundoApellido,
    :txtFechaNacimiento,
    :txtTelefono,
    :txtDireccionResidencia,
    :txtEmail,
    :selMunicipioResidencia,
    :selMunicipioNacimiento );";

    //echo $sqlInsertPersona;

    $conexion->ejecutar($sqlInsertPersona,$values);
    header('Location:http://localhost/registrarPersona');
?>