    <?php
      //Gọi file connection.php ở bài trước
         $host        = "host=127.0.0.1";
         $port        = "port=5432";
         $dbname      = "dbname=qlkstloff3";
         $credentials = "user=postgres password=''";
         $db = pg_connect( "$host $port $dbname $credentials"  );
           if(!$db){
              echo "Error : Unable to open database\n";
           }

    ?>