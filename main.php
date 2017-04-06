<?php 
    
    $name = null;
    $email = null;
    $photo = null;
    $type_user = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        reviewInputData();
    }

    
    function reviewInputData(){
        global $name;
        global $email;
        global $photo;
        global $type_user;
        $name = validateInputData($_POST["name"]);
        $email = validateInputData($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $correo_valido = false; 
        }else
            $correo_valido = true;
        $photo = validateInputData($_POST["photo_user"]);
        $type_user = validateInputData($_POST["tipo_usuario"]);
        
        if($correo_valido === true){
            create_user($name, $email, $photo, $type_user);
        }
        
    }
    
    function create_user($name, $email, $photo, $type_user){
        
        require 'bd_data.php';
  
        $mysqli_ = new mysqli($s_name, $u_name, $pass, $db_name);
        if ($mysqli_->connect_error) {
            die("¡Fallo la conexión! " . $mysqli_->connect_error);
        } 

        $sql = "INSERT INTO usuario (name, email, picture, type_user) VALUES ('".$name."', '".$email."', '".$photo."', '".$type_user."')"; $result = $mysqli_->query($sql);       
        if ($result === true) {
            echo '<script type="text/javascript">
           window.location = "http://localhost/myFiles/table.php"
            </script>';
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli_->error;
        }

        $mysqli_->close();
        
        
    }

    // validaciones
    function validateInputData($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<html>
<body style="background: #ccd2f3;">
    <div style="background: rgba(0, 0, 0, 0); width: 650px; margin: auto; box-sizing: border-box; 
                padding: 1em; border: 1px solid white;">
        <div style="background: rgba(0, 0, 0, 0.5); color: white; display: block;">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div stle="width: 100%; display: block;">
                    <div style="display: block; padding: 0.5em 0; width: 90%; margin: auto;">
                        <input type="text" name="name" placeholder="Nombre" title="Escribe tu nombre"
                               style="width: 100%; font-size: 20px;" required>
                    </div>
                    <div style="display: block; padding: 0.5em 0; width: 90%; margin: auto;">
                        <input type="text" name="email" placeholder="Correo" title="Escribe tu correo"
                         style="width: 100%; font-size: 20px;" required>
                    </div>
                    <div style="display: block; padding: 0.5em 0; width: 90%; margin: auto;">
                        <input type="file" name="photo_user" id="photo" style="font-size: 20px;">
                    </div>
                     <div style="display: block; padding: 0.5em 0; width: 90%; margin: auto;">
                        <select style="font-size: 20px;" name="tipo_usuario" required>
                          <option value="">None</option>
                          <option value="super_admin">Super admin</option>
                          <option value="admin">Admin</option>
                          <option value="user">User</option>
                          <option value="disabled_user">Disabled User</option>
                        </select>
                    </div>
                     <div style="display: block; padding: 0.5em 0; width: 75%; margin: auto;">
                        <input type="submit" value="Submit" style="width: 100%; font-size: 20px;">
                    </div>
                </div>
            </form>
        </div>
    </div>    
</body>
</html>

