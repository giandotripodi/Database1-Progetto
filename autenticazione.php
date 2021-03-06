<?php 
require_once "database.php";

if(isset($_POST['login'])){
    if(empty($_POST['email']) AND empty($_POST['pass'])){
        $error = "Inserisci email e password";
    }
    elseif(empty($_POST['email'])){
        $error = "Email mancante. Inserire la email";
    }
    elseif(empty($_POST['pass'])){
        $error = "Password mancante. Inserire la password";
    }
    else {
        $email = $_POST['email'];
        $pass = hash("sha256", $_POST['pass']);

        $sql = "SELECT email, pass, id_direttore AS id, 'admin' AS Ruolo FROM direttore WHERE email = '$email' AND pass = '$pass'
        UNION SELECT email, pass, id_fornitore AS id, 'fornitore' AS Ruolo FROM fornitore WHERE email = '$email' AND pass = '$pass'
        UNION SELECT email, pass, id_magazziniere AS id, 'magazziniere' AS Ruolo FROM magazziniere WHERE email = '$email' AND pass = '$pass'
        UNION SELECT email, pass, id_addetto AS id, 'addetto' AS Ruolo FROM addetto_vendita WHERE email ='$email' AND pass = '$pass'";
        $result = mysqli_query($conn, $sql) or die("Bad query: $sql");  
        $row = mysqli_fetch_assoc($result);
        session_start();
        if($row['Ruolo'] == 'admin'){
            $_SESSION['ruolo'] = 'admin';
            $_SESSION['logged_in'] = $row['id'];
            header("location: direttore.php");
            }
        if($row['Ruolo'] == 'magazziniere')
            {
            $_SESSION['ruolo'] = 'magazziniere';
            $_SESSION['logged_in'] = $row['id'];
            header("location: magazzino.php");
            }
        if($row['Ruolo'] == 'fornitore'){
            $_SESSION['ruolo'] = 'fornitore';
            $_SESSION['logged_in'] = $row['id'];
            header("location: fornitore.php");
            }
        if($row['Ruolo'] == 'addetto'){
            $_SESSION['ruolo'] = 'addetto';
            $_SESSION['logged_in'] = $row['id'];
            header("location: addetto.php");
            }
            
        $error = "Username o password non trovati";
    }
}
?>