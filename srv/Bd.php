<?php

class Bd
{
 private static ?PDO $pdo = null;

 static function pdo(): PDO
 {
  if (self::$pdo === null) {

   self::$pdo = new PDO(
    // cadena de conexión
    "sqlite:srvbd.db",
    // usuario
    null,
    // contraseña
    null,
    // Opciones: pdos no persistentes y lanza excepciones.
    [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );

   self::$pdo->exec(
    "CREATE TABLE IF NOT EXISTS ESTUDIANTE (
      EST_ID INTEGER,
      EST_NOMBRE TEXT NOT NULL,
      EST_CUATRIMESTRE TEXT NOT NULL,
      EST_CARRERA TEXT NOT NULL,
      CONSTRAINT EST_PK
       PRIMARY KEY(EST_ID),
      CONSTRAINT EST_NOM_UNQ
       UNIQUE(EST_NOMBRE),
      CONSTRAINT EST_NOM_NV
       CHECK(LENGTH(EST_NOMBRE) > 0)
       CHECK(LENGTH(EST_CUATRIMESTRE) > 0)
       CHECK(LENGTH(EST_CARRERA) > 0)
     )"
   );
  }

  return self::$pdo;
 }
}
