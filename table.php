<?php 
        require 'bd_data.php';

  
        $mysqli_ = new mysqli($s_name, $u_name, $pass, $db_name);
        if ($mysqli_->connect_error) {
            die("¡Fallo la conexión! " . $conn->connect_error);
        } 

        $sql = "SELECT * FROM usuario"; 
        $result = $mysqli_->query($sql);
        $successful = false;
        
        if ($result->num_rows != 0) {

            $successful = true; 

        }else{
            $successful = false;
            $result = 'No se encontraron usuarios. '. $mysqli_->error;
        }

        $mysqli_->close();

?>
<html>
<body style="background: #ccd2f3;">
    <div style="background: rgba(0, 0, 0, 0); width: 650px; margin: auto; box-sizing: border-box; 
                padding: 1em; border: 1px solid white;">
        <div style="color: white; display: block;">
            <?php 
                if($successful === true)
                {
                    echo '<table style="margin: auto; ">';
                    echo '<tr> <th>Nombre</th> <th>Correo</th> <th>Tipo de Usuario</th></tr>';
                    while($rows = $result->fetch_assoc()){
                        echo '<tr>';
                        echo '<td>'.$rows['name'].'</td>';
                        echo '<td>'.$rows['email'].'</td>';
                        echo '<td>'.$rows['type_user'].'</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                }else
                echo $result;
            ?>
        </div>
    </div>    
</body>
</html>