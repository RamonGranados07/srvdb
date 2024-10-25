<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_PASATIEMPO.php";  // Cambiado a la nueva tabla
ejecutaServicio(function () {

  // Selección de la tabla "PAGOS"
  $lista = select(pdo: Bd::pdo(), from: PAGOS, orderBy: PAG_FECHA);

  $render = "";
  foreach ($lista as $modelo) {
      $encodeId = urlencode($modelo[PAG_ID]);
      $id = htmlentities($encodeId);
      $total = htmlentities($modelo[PAG_TOTAL]);
      $fecha = htmlentities($modelo[PAG_FECHA]);
      $autorizacion = htmlentities($modelo[PAG_AUTORIZACION]);  // Incluyendo autorización
      $render .=
          "<li>
              <p>
                  Pago ID: <a href='modifica.html?id=$id'>$id</a> - Total: $total - Fecha: $fecha - Autorización: $autorizacion
              </p>
          </li>";
  }

  devuelveJson(["lista" => ["innerHTML" => $render]]);
});
