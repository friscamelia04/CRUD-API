<?php
    class connection_database{
        private $connect;
        
        public function database_connection(){
            try{
                $this->connect = new PDO("mysql:host=localhost; dbname=db_karyawan","root","");
                $this->connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                return $this->connect;
            }

            catch(PDOException $e){
                $e->getMessage();
            }
                
        }
    }


?>