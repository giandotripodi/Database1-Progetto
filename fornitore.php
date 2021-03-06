<?php require_once "autenticazione.php";
      require_once "config.php";
      session_start();

if((isset($_SESSION['logged_in']))){
        $ruolo = @$_SESSION['ruolo'];
        if($ruolo == 'fornitore'){
        $user_id = $_SESSION['logged_in'];
        $sql = "SELECT * FROM fornitore WHERE id_fornitore = $user_id";
        $result = mysqli_query($conn, $sql) or die(header('Location: /logout.php'));
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
        <title> Pannello fornitore </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <link rel="stylesheet" href="adminstyle.css">
    </head>
    <body>
    <div id="wrapper">

    <div id='menu_div'>
    <li id="sitename"><a href="fornitore.php"><b>Pannello Fornitore</b></a></li>
    <li><a href="?action=incarico-ordini">Prendi incarico ordini</a></li>
    <li><a href="?action=completa-ordini">Completa incarico ordini</a></li>
    <li><a href="logout.php">Logout</a></li>
    </div>


<div id="content">
<?php
    if(isset($_GET['action'])):   
    switch($_GET['action']):
        case 'incarico-ordini':
            {
                $ordini = incaricoOrdini();
                echo "<form method='get' action='operazioni.php'/>";
                echo "<input type='hidden' name='id_fornitore' value='$user_id'>";
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
                    echo "<td><input type='checkbox' name='checkbox[]' value='". $row['id_ordine'] ."'></td><td>". $row["id_ordine"] ."</td><td>". $row["articolo"]   ."</td><td>". $row["taglia"]   ."</td><td>Da prendere in carico</td>";
                    echo"</tr>";
                }
                echo "</table>";
                echo"<br><br>"; 
                echo"<input class='submit' type='submit' name='task' id='task' value='Conferma ricezione'>";
            }
            
            break;
        case 'completa-ordini':
            {
                $ordini = completaOrdine();
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
                    echo "<td><input type='checkbox' name='checkbox[]' value='". $row['id_ordine'] ."'></td><td>". $row["id_ordine"] ."</td><td>". $row["articolo"]   ."</td><td>". $row["taglia"]   ."</td><td>Da completare</td>";
                    echo"</tr>";
                }
                echo "</table>";
                echo"<br><br>"; 
                echo"<input class='submit' type='submit' name='completed' id='completed' value='Conferma'>";
            }
    default:
    endswitch;
    else:
        ?>
        <h2>Bentrovato, <?= $user['nome']; ?> <br>Benvenuto nel pannello fornitore. <br />
        <?php

    endif;
?>

</div>
</div>
</body>
</body>
</html>

<?php mysqli_close($conn); ?>