<?php
    class API{
        private $connect;

        function __construct(){
            require_once'connection.php';
            $db = new connection_database;

            $this->connect= $db->database_connection();
        }

        function fetch_all(){
                $query = "SELECT * FROM tb_data ORDER BY id";
                $statement = $this->connect->prepare($query);
                if ($statement->execute()){
                    while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                        $data[] = $row;
                    }
                    return $data;
                }
        }

        function insert(){
            if(isset($_POST["nama"])){
                $form_data = array(
                    ':nik' => $_POST["nik"],
                    ':nama' => $_POST["nama"],
                    ':no_telp' => $_POST["no_telp"],
                    ':alamat' => $_POST["alamat"]
                );
                $query = "INSERT INTO tb_data(nik,nama,no_telp,alamat) VALUES (:nik,:nama,:no_telp,:alamat)";
                $statement = $this->connect->prepare($query);
                if($statement->execute($form_data)){
                    $data[] = array(
                        'success' => '1'
                    );
                }
                else{
                    $data[] = array(
                        'success' => '0'
                    );
                }
            }

            else{
                $data[] = array(
                    'success' => '0'
                );
            }
            return $data;
        }

        function fetch_single($id){
            $query = "SELECT * FROM tb_data WHERE id = '".$id."'";
            $statement = $this->connect->prepare($query);
            if($statement->execute()){
                foreach($statement->fetchAll() as $row){
                    $data['nik'] = $row['nik'];
                    $data['nama'] = $row['nama'];
                    $data['no_telp'] = $row['no_telp'];
                    $data['alamat'] = $row['alamat'];
                }
                return $data;
            }
        }

        function update(){
            if(isset($_POST["nik"])){
                $form_data = array(
                    ':nama'     => $_POST["nama"],
                    ':no_telp'  => $_POST["no_telp"],
                    ':alamat'    => $_POST["alamat"],
                    ':nik'      => $_POST["nik"]
                );
                $query = "UPDATE tb_data SET nama = :nama, no_telp = :no_telp, alamat = :alamat WHERE nik = :nik";
                $statement = $this->connect->prepare($query);
                if($statement->execute($form_data)){
                    $data[] = array(
                        'success' => '1'
                    );
                }
                else {
                    $data[] = array(
                        'success' => '0'
                    );
                }
                return $data;
            }
        } 

        function delete($id){
            $query="DELETE FROM tb_data WHERE id = '".$id."'";
            $statement = $this->connect->prepare($query);
            if($statement->execute()){
                $data[] = array(
                    'success' => '1'
                );
            }
            else {
                $data[] = array(
                    'success' => '0'
                );
            }
            return $data;
        } 

       /* function login(){
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $query="SELECT * FROM tb_login ";
            $statement = $this->connect->prepare($query);
            $statement->execute();
            if($data = $statement->fetch(PDO::FETCH_ASSOC)){
                $data[] = array(
                    header("Location: login.php")
                );
            }
            else{
                $data[] = array(
                    header("Location: login.php?info=Gagal")
                );
            }
            return $data;
        } */
    }

?>