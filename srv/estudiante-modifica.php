<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaCuatrimestre.php";
require_once __DIR__ . "/../lib/php/validaCarrera.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_ESTUDIANTE.php";

ejecutaServicio(function () {

 $id = recuperaIdEntero("id");
 $nombre = recuperaTexto("nombre");

 $nombre = validaNombre($nombre);

 $cuatrimestre = recuperaTexto("cuatrimestre");

 $cuatrimestre = validaCuatrimestre($cuatrimestre);

 $carrera = recuperaTexto("carrera");

 $carrera = validaCarrera($carrera);

 update(
  pdo: Bd::pdo(),
  table: ESTUDIANTE,
  set: [EST_NOMBRE => $nombre , EST_CUATRIMESTRE => $cuatrimestre, EST_CARRERA => $carrera],
  where: [EST_ID => $id]
 );

 devuelveJson([
  "id" => ["value" => $id],
  "nombre" => ["value" => $nombre],
  "cuatrimestre" => ["value" => $cuatrimestre],
  "carrera" => ["value" => $carrera],
 ]);
});
