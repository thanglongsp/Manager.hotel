    <?php
      //Gọi file connection.php ở bài trước
         $host        = "host=127.0.0.1";
         $port        = "port=5432";
         $dbname      = "dbname=qlks";
         $credentials = "user=postgres password='thanglongsp'";
         $db = pg_connect( "$host $port $dbname $credentials"  );
           if(!$db){
              echo "Error : Unable to open database\n";
           }

    ?>