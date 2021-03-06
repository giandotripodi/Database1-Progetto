<?php require_once "autenticazione.php";
      require_once "config.php";
      session_start();

if(isset($_SESSION['logged_in'])) {
        $ruolo = @$_SESSION['ruolo'];
        if($ruolo == 'magazziniere'){
        $user_id = $_SESSION['logged_in'];
        $sql = "SELECT * FROM magazziniere WHERE id_magazziniere = $user_id";
        $result = mysqli_query($conn, $sql) or die("Bad query: $sql");
        $user = mysqli_fetch_assoc($result);
    }
    else{
        header('Location: /logout.php');
    }
}
else{
    header('Location: /');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Pannello Magazzino </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <link rel="stylesheet" href="adminstyle.css">
    </head>
    <body>
    <div id="wrapper">

    <div id='menu_div'>
    <li id="sitename"><a href="magazzino.php"><b>Pannello Magazzino</b></a></li>
    <li><a href="?action=ricezione-ordini">Ricezione ordini</a></li>
    <li><a href="logout.php">Logout</a></li>
    </div>

<div id="content">
<?php
    if(isset($_GET['action'])):   
    switch($_GET['action']):
        case 'ricezione-ordini':
            {
                $ordini = ricezioneOrdini();
                echo "<form method='get' action='operazioni.php'/>";
                echo"<center>";
                echo"<table>";
                echo"<tr>";
                echo "<th></th>";
                echo"<th>ID ordine</th>";
                echo"<th>Articolo</th>";
                echo"<th>Taglia</th>";
                echo"<th>Stato</th>";
                echo"</tr>";
                while($row = $ordini->fetch_assoc()){
                    echo"<tr>";
                    echo "<td><input type='checkbox' name='checkbox[]' value='". $row['id_ordine'] ."'></td><td>". $row["id_ordine"] ."</td><td>". $row["articolo"]   ."</td><td>". $row["taglia"]   ."</td><td>Ordine consegnato</td>";
                    echo"</tr>";
                }
                echo "</table>";
                echo"<br><br>"; 
                echo"<input class='submit' type='submit' name='received' id='received' value='Conferma ricezione'>";
            }
            break;
    default:
    endswitch;
    else:
        ?>
        <h2>Bentrovato, <?= $user['nome']; ?> <br>Benvenuto nel pannello magazzino. <br />
            <h3><br>Ecco il tuo orario lavorativo: <br /></h3>
        <?php

            $user_id = $_SESSION['logged_in'];
            $orario_mag = orarioMag($user_id);
            
            echo"<br><br>";
            echo"<center>";
            echo "<table id='table-login'>";
            echo "<tr>";
            echo"<th>Orario</th>";
            echo"<th>Giorno</th>";
            while($row = $orario_mag->fetch_assoc()){
                echo "<tr><td>". $row["orario"] ."</td><td>". $row["giorno"] ."</td><tr>";
            }
            echo "</table>";
            echo"</center>";
    endif;
?>

</div>
</div>
</body>
</body>
</html>

<?php mysqli_close($conn); ?>