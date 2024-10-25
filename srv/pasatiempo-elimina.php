<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/delete.php";
require_once __DIR__ . "/../lib/php/devuelveNoContent.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_PASATIEMPO.php";

ejecutaServicio(function () {
    $id = recuperaIdEntero("id");

    // Eliminar el pago según el ID
    delete(pdo: Bd::pdo(), from: PAGOS, where: [PAG_ID => $id]);

    // Devolvemos respuesta sin contenido
    devuelveNoContent();
});