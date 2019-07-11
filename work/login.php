<!DOCTYPE HTML>
<body>
<head>
<title>FORM LOGIN</title>
</head>
<?php
    session_start();
    if(isset($_GET['info'])){
        if($_GET['info'] == 'Gagal'){
            echo"mohon maaf username atau password salah";
        }
    }
?>
    <form action="api.php"> 
        <table align="center">
            <br />
            <h3><center>LOGIN</center></h3>
            <br />
            <tr>
                <td> <label>Username</label></td>
                <td><input type="text" placeholder="enter username" name="user" id="user"></td>
            </tr>
            <tr>
                <td><label>Password</label></td>
                <td><input type="password" placeholder="enter password" name="pass" id="pass"></td>
            </tr>
            <tr>
                <td><input type="submit" name="btn_login" id="btn_login" value="LOGIN"></td>
            </tr>
        </table>
</body>

<script>

    $(document).ready(function(){
        $('#btn_login').click(function(){
            var user = $('#user').val();
            var pass = $('#pass').val();
            var error = true;

            $.ajax({
                type:"POST",
                url:"api.php",
                dataType:"json",
                success:function(data){
                    $.each(data, function(key, value){
                        if(user == value.username && pass == value.password){
                            error = false;
                        }
                    });

                    if(error == false){
                        document.location="index.php?"
                    }
                }
            });

        });

    });
</script>