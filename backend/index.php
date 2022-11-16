<?php
    require_once("connection.php");
    require_once("cors.php");

    if(isset($_GET['api']) && function_exists($_GET['api'])){
        header('Content-Type: application/json');
        cors();

        $_GET['api']();
    }
    else{ http_response_code(401); }

    function Register(){
        global $Connection;
        $data = json_decode(file_get_contents('php://input') , true);
        
       
        $Username = $_POST['username'];
        $Password = $_POST['password'];
        $rePassword = $_POST['repassword'];
        $Role = 'admin';

        $HashingPassword = password_hash($Password, PASSWORD_BCRYPT);

        if(password_verify($rePassword , $HashingPassword)){
            $query = "INSERT INTO tb_users (username, password, role) VALUES ('$Username', '$HashingPassword', '$Role')";
            $result = mysqli_query($Connection , $query);

            if($result){
                echo json_encode(array(
                    'status' => 1,
                    'status_message' => 'Register Success'
                ));
            }
            else{
                echo json_encode(array(
                    'status' => 0,
                    'status_message' => 'Register Failed'
                ));
            }
        }
    }

    function Login(){
        global $Connection;
        $data = json_decode(file_get_contents('php://input') , true);
        
        $Username = $data['username'];
        $Password = $data['password'];

        $query = "SELECT * FROM tb_users WHERE username = '$Username'";
        $result = mysqli_query($Connection , $query);
        $row = mysqli_fetch_assoc($result);

        if(password_verify($Password , $row['password'])){
            $Token = base64_encode($Username . $row['role']);
            $query = "UPDATE tb_users SET token = '$Token' WHERE id = '$row[id]'";
            $result = mysqli_query($Connection , $query);

            echo json_encode(array(
                'status' => 1,
                'status_message' => 'Login Success',
                'token' => $Token
            ));
        }
        else{
            echo json_encode(array(
                'status' => 0,
                'status_message' => 'Login Failed'
            ));
        }
    }

    function isLogin(){
        global $Connection;
        $data = json_decode(file_get_contents('php://input') , true);
        
        $Token = $data['token'];

        $query = "SELECT * FROM tb_users WHERE token = '$Token'";
        $result = mysqli_query($Connection , $query);
        $row = mysqli_fetch_assoc($result);

        if($row){
            echo json_encode(array(
                'status' => 1,
                'status_message' => 'Login',
                'username' => $row['username'],
                'role' => $row['role']
            ));
        }
        else{
            echo json_encode(array(
                'status' => 0,
                'status_message' => 'Not Login'
            ));
        }
    }

    function Logout(){
        global $Connection;
        $data = json_decode(file_get_contents('php://input') , true);

        $Token = $_POST['token'];

        $query = "SELECT * FROM tb_users WHERE token = '$Token'";
        $result = mysqli_query($Connection , $query);
        $row = mysqli_fetch_assoc($result);
        
        if($row){
            $id = $row['id'];
            $queryLogout = "UPDATE tb_users SET token = '' WHERE id = $id";
            $resLogout = mysqli_query($Connection , $queryLogout);
            
            if($resLogout){
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'logout sukses'
                ));
            }
            else{
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'logout gagal'
                ));
            }
        }
        else{
            echo json_encode(array(
                'status' => 0,
                'message' => 'logout gagal'
            ));
        }

    }

    function addData(){
        global $Connection;
        $data = json_decode(file_get_contents('php://input'), true);

        $judul_penelitian = $data['judul_penelitian'];
        $nama = $data['nama'];
        $hari = $data['hari'];
        $tanggal = $data['tanggal'];
        $jam = $data['jam'];
        $ruang = $data['ruang'];
        
        $query = "INSERT INTO tb_data VALUES (NULL , '$judul_penelitian', '$nama', '$hari', '$tanggal', '$jam', '$ruang')";
        $result = mysqli_query($Connection, $query);

        if($result){
            http_response_code(200);
            echo json_encode(array(
                'status' => 1,
                'status_message' => 'Data Berhasil Ditambahkan'
            ));
        }
        else{
            echo json_encode(array(
                'status' => 0,
                'status_message' => 'Data Gagal Ditambahkan'
            ));
        }
    }

    function searchData(){
        global $Connection;

        $data = json_decode(file_get_contents('php://input'), true);

        $Nama = $data['nama'];
        $Judul = $data['judul_penelitian'];

        if($Nama == '' && $Judul == ''){
            echo json_encode(array(
                'status' => 0, 
                'message' => 'data tidak ditemukan'
            ));
        }

        else{
            if($Nama != '' && $Judul != ''){
                $query = "SELECT * FROM tb_data WHERE nama LIKE '%$Nama%' AND judul_penelitian LIKE '%$Judul%'";
            }
            else if($Nama != '' && $Judul == ''){
                $query = "SELECT * FROM tb_data WHERE nama LIKE '%$Nama%'";
            }
            else if($Nama == '' && $Judul != ''){
                $query = "SELECT * FROM tb_data WHERE judul_penelitian LIKE '%$Judul%'";
            }
            
    
            $Result = mysqli_query($Connection , $query);
    
            if(mysqli_num_rows($Result) > 0){
                while($row = mysqli_fetch_assoc($Result)){
                    $Response[] = $row;
                }
                echo json_encode($Response);
            }
            else{
                echo json_encode(array(
                    'status' => 0, 
                    'message' => 'data tidak ditemukan'
                ));
            }
        }
    }

    function getData(){
        global $Connection;

        $query = "SELECT * FROM tb_data";
        $Result = mysqli_query($Connection , $query);

        if(mysqli_num_rows($Result) > 0){
            while($row = mysqli_fetch_assoc($Result)){
                $Response[] = $row;
            }
            echo json_encode($Response);
        }
        else{
            echo json_encode(array(
                'status' => 0, 
                'message' => 'data tidak ditemukan'
            ));
        }
    }

    function UpdateData(){
        global $Connection;
        $data = json_decode(file_get_contents('php://input'), true);

        $id = $data['id'];
        $judul_penelitian = $data['judul_penelitian'];
        $nama = $data['nama'];
        $hari = $data['hari'];
        $tanggal = $data['tanggal'];
        $jam = $data['jam'];
        $ruang = $data['ruang'];

        $query = "UPDATE tb_data SET judul_penelitian = '$judul_penelitian', nama = '$nama', hari = '$hari', tanggal = '$tanggal', jam = '$jam', ruang = '$ruang' WHERE id = $id";
        $result = mysqli_query($Connection, $query);

        if($result){
            http_response_code(200);
            echo json_encode(array(
                'status' => 1,
                'status_message' => 'Data Berhasil Diubah'
            ));
        }
        else{
            echo json_encode(array(
                'status' => 0,
                'status_message' => 'Data Gagal Diubah'
            ));
        }
    }

    function showData(){
        global $Connection;
        $data = json_decode(file_get_contents('php://input'), true);

        $id = $data['id'];

        $query = "SELECT * FROM tb_data WHERE id = $id";
        $result = mysqli_query($Connection, $query);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $Response[] = $row;
            }
            echo json_encode($Response);
        }
        else{
            echo json_encode(array(
                'status' => 0,
                'status_message' => 'Data Tidak Ditemukan'
            ));
        }
    }

    function deleteData(){
        global $Connection;
        $data = json_decode(file_get_contents('php://input'), true);

        $id = $data['id'];

        $query = "DELETE FROM tb_data WHERE id = $id";
        $result = mysqli_query($Connection, $query);

        if($result){
            http_response_code(200);
            echo json_encode(array(
                'status' => 1,
                'status_message' => 'Data Berhasil Dihapus'
            ));
        }
        else{
            echo json_encode(array(
                'status' => 0,
                'status_message' => 'Data Gagal Dihapus'
            ));
        }
    }

?>