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

            // Creación de la tabla "PAGOS"
            self::$pdo->exec(
                "CREATE TABLE IF NOT EXISTS PAGOS (
                    PAG_ID INTEGER,
                    PAG_TOTAL REAL NOT NULL,
                    PAG_FECHA TEXT NOT NULL,
                    PAG_AUTORIZACION TEXT NOT NULL,
                    CONSTRAINT PAG_PK PRIMARY KEY(PAG_ID),
                    CONSTRAINT PAG_TOTAL_NV CHECK(PAG_TOTAL >= 0),
                    CONSTRAINT PAG_FECHA_NV CHECK(LENGTH(PAG_FECHA) > 0),
                    CONSTRAINT PAG_AUTORIZACION_NV CHECK(LENGTH(PAG_AUTORIZACION) > 0)
                )"
            );
        }

        return self::$pdo;
    }
}
