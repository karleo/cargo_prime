<?php
// *************************************************************************
// *                                                                       *
// * DEPRIXA PRO -  Integrated Web Shipping System                         *
// * Copyright (c) JAOMWEB. All Rights Reserved                            *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: support@jaom.info                                              *
// * Website: http://www.jaom.info                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.                              *
// * If you Purchased from Codecanyon, Please read the full License from   *
// * here- http://codecanyon.net/licenses/standard                         *
// *                                                                       *
// *************************************************************************



function doBackup()
{
   $db_name   = CDP_DB_NAME;
   $backups   = '';

   $db = new Conexion;
   $db->cdp_query("SET NAMES 'utf8'");
   $db->cdp_query('SHOW TABLES');
   $db->cdp_execute();

   $tables = $db->cdp_fetch_all();

   foreach ($tables as $table) {
      # code...
      $tables_to_backup[] = $table[0];
   }

   foreach ($tables_to_backup as $table) {

      $sql1   = $db->cdp_query("SELECT * FROM $table");
      $result = $db->cdp_fetch_all();
      $filas  = $db->cdp_rowCount();

      $num        = $db->cdp_query("SELECT COUNT(COLUMN_NAME) AS columna FROM information_schema.columns WHERE table_schema = '$db_name' AND table_name = '$table'");
      $num_fields = $db->cdp_registro();
      $num_fields = $num_fields->columna; //Número de columnas de la tabla correspomdiente

      $backups .= "SET AUTOCOMMIT = 0;" . PHP_EOL;
      $backups .= "SET FOREIGN_KEY_CHECKS= 0;" . PHP_EOL; //desactiva la revición de las llaves foraneas

      $backups .= PHP_EOL . "DROP TABLE IF EXISTS `$table`;";
      $r    = $db->cdp_query('SHOW CREATE TABLE ' . $table);
      $row2 = $db->cdp_fetch_all();

      foreach ($row2 as $key => $value) {
         $backups .= PHP_EOL . PHP_EOL . $value[1] . ";" . PHP_EOL . PHP_EOL;
      }

      if ($filas > 0) {
         $backups .= "INSERT INTO `$table` VALUES " . PHP_EOL;

         foreach ($result as $row) {
            $backups .= "(";
            for ($j = 0; $j < $num_fields; $j++) {
               $row[$j] = addslashes($row[$j]);
               $row[$j] = preg_replace("/\n/", "\\n", $row[$j]);

               if (isset($row[$j])) {
                  if (is_numeric($row[$j])) {
                     $backups .= "$row[$j]";
                  } else {
                     $backups .= "'$row[$j]'";
                  }
               } else {
                  $backups .= '""';
               }

               if ($j < ($num_fields - 1)) {
                  $backups .= ',';
               }
            }
            $backups .= ")," . PHP_EOL;
            $backups = rtrim($backups, ""); //Elimina el salto de la cadena
         }

         $backups = rtrim($backups, PHP_EOL);
         $backups = rtrim($backups, ","); //Elimina la ultima com (,) de la cadena de los values
         $backups .= ";";

         $backups .= PHP_EOL . PHP_EOL . "SET FOREIGN_KEY_CHECKS = 1;\nCOMMIT;" . PHP_EOL;
         $backups .= "SET AUTOCOMMIT = 1;";
         $backups .= "" . PHP_EOL . PHP_EOL . PHP_EOL;
      } else {
         $backups .= PHP_EOL . PHP_EOL . "SET FOREIGN_KEY_CHECKS = 1;\nCOMMIT;" . PHP_EOL;
         $backups .= "SET AUTOCOMMIT = 1;";
         $backups .= "" . PHP_EOL . PHP_EOL . PHP_EOL;
      }
   }

   $backups = trim($backups); //Elimina los ultimos espacios en blanco

   # Se guardará dependiendo del directorio, en una carpeta llamada respaldos
   $folder = "backups";
   if (!file_exists($folder)) {
      mkdir($folder);
   }

   # Calcular un ID único
   $id = uniqid();

   # También la fecha
   $date = date("d-M-Y_H-i-s");

   # Crear un archivo que tendrá un nombre como respaldo_2018-10-22_asd123.sql
   $file_name = sprintf('%s/backup_%s.sql', $folder, $date);

   #Escribir todo el contenido. Si todo va bien, file_put_contents NO devuelve FALSE
   file_put_contents($file_name, $backups) !== false;

   $file_update = "backup_" . $date . ".sql";
   $db->cdp_query('UPDATE cdb_settings SET  backup =:backup');

   $db->bind(':backup', $file_update);

   $db->cdp_execute();

   cdp_redirect_to("backup.php?do=backup&backupok=1");

   unlink($backups); //Eliminamos el archivo temporal SQL

}


function doRestore($file)
{
   $db = new Conexion;

   $filename = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "backups" . DIRECTORY_SEPARATOR . trim($file);
   $sql = '';
   $lines = file($filename);

   foreach ($lines as $line) {

      $line = trim($line); // Quitamos espacios/tabuladores por delante y por detrás

      $sql .= $line;
   }

   $db->cdp_query($sql);
   $restore =  $db->cdp_execute();

   if ($restore) {
      return 1;
   } else {
      return 2;
   }
}
