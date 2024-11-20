<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaCuatrimestre.php";
require_once __DIR__ . "/../lib/php/validaCarrera.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_ESTUDIANTE.php";

ejecutaServicio(function () {

 $nombre = recuperaTexto("nombre");

 $nombre = validaNombre($nombre);

 $cuatrimestre = recuperaTexto("cuatrimestre");

 $cuatrimestre = validaCuatrimestre($cuatrimestre);

 $carrera = recuperaTexto("carrera");

 $carrera = validaCarrera($carrera);

 $pdo = Bd::pdo();
 insert(pdo: $pdo, into: ESTUDIANTE, values: [EST_NOMBRE => $nombre, EST_CUATRIMESTRE => $cuatrimestre, EST_CARRERA => $carrera]);
 $id = $pdo->lastInsertId();

 $encodeId = urlencode($id);
 devuelveCreated("/srv/estudiante.php?id=$encodeId", [
  "id" => ["value" => $id],
  "nombre" => ["value" => $nombre],
  "cuatrimestre" => ["value" => $cuatrimestre],
  "carrera" => ["value" => $carrera],
 ]);
});
