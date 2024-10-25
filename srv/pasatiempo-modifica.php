<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_PASATIEMPO.php";


ejecutaServicio(function () {

    $id = recuperaIdEntero("id");
    $total = recuperaTexto("total");
    $fecha = recuperaTexto("fecha");
    $autorizacion = recuperaTexto("autorizacion");

    // Validaciones
    $total = validaNombre($total);
    $autorizacion = validaNombre($autorizacion);

    // Actualización en la tabla PAGOS
    update(
        pdo: Bd::pdo(),
        table: PAGOS,
        set: [
            PAG_TOTAL => $total,
            PAG_FECHA => $fecha,
            PAG_AUTORIZACION => $autorizacion
        ],
        where: [PAG_ID => $id]
    );

    // Devolvemos la respuesta en formato JSON
    devuelveJson([
        "id" => ["value" => $id],
        "total" => ["value" => $total],
        "fecha" => ["value" => $fecha],
        "autorizacion" => ["value" => $autorizacion],
    ]);
});