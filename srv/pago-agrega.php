<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_PAGO.php";

ejecutaServicio(function () {

    // Recuperamos los valores enviados
    $total = recuperaTexto("total");
    $fecha = recuperaTexto("fecha");
    $autorizacion = recuperaTexto("autorizacion");

    // Validaciones (puedes agregar más si es necesario)
    $total = validaNombre($total);
    $autorizacion = validaNombre($autorizacion);

    // Inserción en la tabla PAGOS
    $pdo = Bd::pdo();
    insert(pdo: $pdo, into: PAGOS, values: [
        PAG_TOTAL => $total, 
        PAG_FECHA => $fecha, 
        PAG_AUTORIZACION => $autorizacion
    ]);
    
    // Obtenemos el ID generado
    $id = $pdo->lastInsertId();
    $encodeId = urlencode($id);

    // Devolvemos la respuesta
    devuelveCreated("/srv/pagos.php?id=$encodeId", [
        "id" => ["value" => $id],
        "total" => ["value" => $total],
        "fecha" => ["value" => $fecha],
        "autorizacion" => ["value" => $autorizacion],
    ]);
});
