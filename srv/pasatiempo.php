<?php

require_once __DIR__ . "/../lib/php/NOT_FOUND.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/selectFirst.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_PASATIEMPO.php";


ejecutaServicio(function () {

    $id = recuperaIdEntero("id");

    // Consulta a la tabla "PAGOS"
    $modelo = selectFirst(pdo: Bd::pdo(), from: PAGOS, where: [PAG_ID => $id]);

    if ($modelo === false) {
        $idHtml = htmlentities($id);
        throw new ProblemDetails(
            status: NOT_FOUND,
            title: "Pago no encontrado.",
            type: "/error/pagonoencontrado.html",
            detail: "No se encontró ningún pago con el id $idHtml."
        );
    }

    devuelveJson([
        "id" => ["value" => $id],
        "total" => ["value" => $modelo[PAG_TOTAL]],
        "fecha" => ["value" => $modelo[PAG_FECHA]],  // Incluyendo el campo de fecha
        "autorizacion" => ["value" => $modelo[PAG_AUTORIZACION]],  // Incluyendo el campo de autorización
    ]);
});
