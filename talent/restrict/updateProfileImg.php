<?php
    include "../../app/conection.php";
    include "validate_login.php";
    
    $usuario = $_SESSION['usuario'];

    if(isset($_POST['save-user-img'])){
        $oldprofile = $_SESSION['imagem_perfil'];
        $profileimg = "profileimg.png";

        if($oldprofile != $profileimg){
            $oldprofiletarget = '../assets/users/profile/' . $oldprofile;
            unlink($oldprofiletarget);
        }

        $maxsize = 4097152;
        $acceptable = array(
            'image/jpeg',
            'image/jpg',
            'image/gif',
            'image/png'
        );

        if(($_FILES['profileImage']['size'] >= $maxsize) || ($_FILES["profileImage"]["size"] == 0)) {
            $_SESSION['profileimgupdate_error'] = true;
            header('Location: ../profile');
        } else { 
        if((!in_array($_FILES['profileImage']['type'], $acceptable)) && (!empty($_FILES["profileImage"]["type"]))) {
            $_SESSION['profileimgupdate_error'] = true;
            header('Location: ../profile');
        } else { 
        $profileImageName = time() .'_' . $usuario . '_' . $_FILES['profileImage']['name'];
        $target = '../assets/users/profile/' . $profileImageName;
            if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $target)){
                $sql = "UPDATE usuario SET imagem_perfil = '$profileImageName' WHERE usuario = '$usuario'";
                if(mysqli_query($conexao, $sql)){
                    $_SESSION['profileimgupdate_success'] = true;
                    $_SESSION['imagem_perfil'] = $profileImageName;
                    header("Location: ../profile");
                } else {
                    $_SESSION['profileimgupdate_error'] = true;
                    header('Location: ../profile');
                }
            } else {
                $_SESSION['profileimgupdate_error'] = true;
                header('Location: ../profile');
            }
        }
    }
    }