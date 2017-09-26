<?php
session_start();

if(isset($_REQUEST["ID"]))
        {
        $host        = "host=127.0.0.1";
         $port        = "port=5432";
         $dbname      = "dbname=qlkstloff3";
         $credentials = "user=postgres password='thanglongsp'";
         $db = pg_connect( "$host $port $dbname $credentials"  );
           if(!$db)
               {
                  echo "Error : Unable to open database\n";
               }//ket noi database
 
            if($db)
            {
                
                    if(isset($_REQUEST['ID']))
                    {
                        $query = "DELETE  FROM quanly WHERE username = '".$_REQUEST['ID']. "'" ;
                         
                        $result = pg_query($query);
                        if($result)
                        {
                            header('Location: quantri.php');
                        }
                    }                  
                }
            else
            {      
                die("Khong ket noi duoc database: ". pg_error());
            }
 
            pg_close($db);
        }      

?>
