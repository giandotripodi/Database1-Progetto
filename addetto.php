<?php require_once "autenticazione.php";
      require_once "config.php";
      require_once "database.php";
      
      session_start();

if(isset($_SESSION['logged_in'])) {
        $ruolo = @$_SESSION['ruolo'];
        if($ruolo == 'addetto'){
        $user_id = $_SESSION['logged_in'];
        $sql = "SELECT * FROM addetto_vendita WHERE id_addetto = $user_id";
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
        <title> Pannello Addetto Vendita </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <link rel="stylesheet" href="adminstyle.css">
    </head>
    <body>
    <div id="wrapper">

    <div id='menu_div'>
    <li id="sitename"><a href="addetto.php"><b>Pannello Adetto</b></a></li>
    <li><a href="?action=cerca-articolo">Cerca articolo</a></li>
    <li><a href="?action=sistema-articolo">Sitema articolo</a></li>
    <li><a href="?action=registra-vendita">Registra vendita</a></li>
    <li><a href="?action=crea-ordine">Crea segnalazione</a></li>
    <li><a href="logout.php">Logout</a></li>
    </div>

<div id="content">
<?php
    if(isset($_GET['action'])):   
    switch($_GET['action']):
        case 'cerca-articolo':
            {
                echo "<h1>Cerca articolo</h1><br><br>";
                if((isset($_POST['nome_art']))&&(isset($_POST['taglia']))){
                    $nome_art = @$_POST['nome_art'];
                    $taglia = @$_POST['taglia'];
                    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
                    if(!$conn){
                    echo mysqli_connect_error();
                    }
                    $articolo = cercaArticoloAddetto($nome_art, $taglia);
                    $magazzino = cercaArticoloMag($nome_art, $taglia);
                    if(mysqli_num_rows($articolo) != 0){
                    echo"<center>";
                    echo"<table>";
                    echo"<tr>";
                    echo"<th>ID Articolo</th>";
                    echo"<th>Nome Articolo</th>";
                    echo"<th>Categoria</th>";
                    echo"<th>Sottocategoria</th>";
                    echo"<th>Reparto</th>";
                    echo "<th>Taglia</th>";
                    echo"</tr>";
                    while($row = $articolo->fetch_assoc()){
                        echo"<tr>";
                        echo "<td>". $row["id_articolo"] ."</td><td>". $row["nome_articolo"]   ."</td><td>". $row["categoria"] ."</td><td>". $row["sottocategoria"]  ."</td><td>".  $row["Reparto"]  ."</td><td>".  $row["taglia"]  ."</td>";
                        echo"</tr>";
                        }
                    }
                    elseif(mysqli_num_rows($magazzino) != 0){
                        echo"<h2>L'articolo è presente nel magazzino</h2>";
                        echo"<center>";
                        echo"<table>";
                        echo"<tr>";
                        echo"<th>ID Articolo</th>";
                        echo"<th>Nome Articolo</th>";
                        echo "<th>Taglia</th>";
                        echo"</tr>";
                        while($row = $magazzino->fetch_assoc()){
                            echo"<tr>";
                            echo "<td>". $row["id_articolo"] ."</td><td>". $row["nome_articolo"]   ."</td><td>".  $row["taglia"]  ."</td>";
                            echo"</tr>";
                            }
                    }
                    
                    else{
                        echo "Nessun articolo trovato! <a href='/addetto.php?action=crea-ordine'>Clicca qui</a> per creare una segnalazione di ordine ";
                    }
                    echo"</table>";
                    echo"<br><br>";
                }

                echo "<form class='form-style' method='post' action='addetto.php?action=cerca-articolo'/>";
                echo "<h3>Nome articolo:</h3>";
                echo "<input class='form-input' type='text' name='nome_art' placeholder='Inserisci il nome'/>";
                echo "<h3>Taglia:</h3>";
                echo "<input class='form-input' type='text' name='taglia' placeholder='Inserisci la taglia'/>";
                echo "<br><br>";
                echo "<input class='form-input-sub' type='submit' value='Cerca articolo'>";

            }
            break;
        case 'crea-ordine':
            {   
                echo"<h1>Crea segnalazione di ordine</h1>";
                
                $flag_nome=@$_POST['nome_art'];
                $flag_taglia=@$_POST['taglia'];

                if(empty($flag_taglia)&&empty($flag_nome)){
                echo "<form class='form-style' method='get' action='operazioni.php'/>";
                echo "<input type='hidden' name='flag_ordine' value='1'>";
                echo "<input type='hidden' name='flag_addetto' value='1'>";
                echo "<h3>Nome articolo:</h3>";
                echo "<input class='form-input' type='text' name='nome_art' placeholder='Inserisci il nome'/>";
                echo "<h3>Taglia:</h3>";
                echo "<input class='form-input' type='text' name='taglia' placeholder='Inserisci la taglia'/>";
                echo "<h3>Quantità:</h3>";
                echo "<select class='form-select' name ='quantita'>";
                for($i = 1; $i <= 99; $i++){
                echo "<option>" .$i. "</option>";
                }
                echo "<br><br>";
                echo "<input class='form-input-sub' type='submit' value='Crea ordine'>";
                }
            }
            break;
        case 'sistema-articolo':
            {
                echo "<h1>Sistema articolo</h1>";
                $flag_idarticolo=@$_POST['id_articolo'];
                $flag_categoria=@$_POST['categoria'];
                $flag_sottocategoria = @$_POST['sottocategoria'];
                $flag_reparto = @$_POST['reparto'];

                if(empty($flag_idarticolo)){
                echo "<form method='post' action='addetto.php?action=sistema-articolo'/>";
                $articoli = printArticolonull();
                if(mysqli_num_rows($articoli) != 0){
                    echo"<center>";
                    echo"<table>";
                    echo"<tr>";
                    echo "<th></th>";
                    echo"<th>ID Articolo</th>";
                    echo"<th>Nome Articolo</th>";
                    echo"<th>Taglia</th>";
                    echo"</tr>";
                    while($row = $articoli->fetch_assoc()){
                        echo"<tr>";
                        echo "<td><input type='radio' name='id_articolo' value='". $row['id_articolo'] ."'></td><td>". $row["id_articolo"] ."</td><td>". $row["nome_articolo"]   ."</td><td>". $row["taglia"]   ."</td>";
                        echo"</tr>";
                        }
                    }
                    else{
                        echo "Nessun articolo da sistemare!";
                    }
                    echo"</table>";
                    echo"<br><br>";
                    echo "<input class='submit' type='submit' value='Seleziona articolo'>";
                }
                    
                    
    
                //Cerca categorie
                $categoria = cercaCategoria();
    
                if(empty($flag_categoria)&&empty($flag_reparto)&&empty($flag_sottocategoria)&&!empty($flag_idarticolo)){
                    echo "<form class='form-style' method='post' action='addetto.php?action=sistema-articolo'/>";
                    echo "<input type='hidden' name='id_articolo' value='$flag_idarticolo'>";
                    echo "<h3>Prezzo:</h3>";
                    echo "<input class='form-input' type ='text' name='prezzo' placeholder='Inserisci il prezzo'/>";
                echo "<br><br>";
                echo "<h3>Categoria:</h3>";
                echo "<select class='form-select' name='categoria'>";
                echo "<option value='0'>...</option>";
                echo "<option value='1'>Maglia</option>";
                echo "<option value='4'>Pantalone</option>";
                while ($row = $categoria->fetch_assoc()){
                echo "<option value='".$row['id_categoria']."'>" .$row['categoria']. "</option>";
                }
                echo "</select>";
                echo "<br><br>";
                echo "<input class='form-input-sub' type='submit' value='Avanti'>";
                }
    
                //Cerca Sottocategorie
                $sottocategoria = sottoCategoria($flag_categoria); 
    
                if(!empty($flag_categoria)&&empty($flag_reparto)&&empty($flag_sottocategoria)){ 
                    echo "<form class='form-style' method='post' action='addetto.php?action=sistema-articolo'/>";
                    echo "<input type='hidden' name='id_articolo' value='$flag_idarticolo'>";
                    echo "<input type='hidden' name='prezzo' value='".$_POST['prezzo']."'>";
                    echo "<input type='hidden' name='categoria' value='$flag_categoria'>";
                    echo "<h3>Sottocategoria:</h3>";
                    echo "<select class='form-select' name='sottocategoria'>";
                    echo "<option value='NULL'>Nessuna sottocategoria</option>";
                    if($sottocategoria){
                        while($row = $sottocategoria->fetch_assoc()){
                        echo "<option value='".$row['id_sottocategoria']."'>" .$row['sottocategoria']. "</option>";
                        }
                    }
                    echo "</select>";
                    echo "<br><br>";
                    echo "<input class='form-input-sub' type='submit' value='Avanti'>";
                    }
    
                //Cerca reparti
                $reparto = cercaReparto();
                    
                if(!empty($flag_categoria)&&empty($flag_reparto)&&!empty($flag_sottocategoria)&&!empty($flag_idarticolo)){
                    echo "<form class='form-style' method='post' action='addetto.php?action=sistema-articolo'/>";
                    echo "<input type='hidden' name='id_articolo' value='$flag_idarticolo'>";
                    echo "<input type='hidden' name='prezzo' value='".$_POST['prezzo']."'>";
                    echo "<input type='hidden' name='categoria' value='$flag_categoria'>";
                    echo "<input type='hidden' name='sottocategoria' value='$flag_sottocategoria'>";
                    echo "<h3>Reparto:</h3>";
                    echo "<select class='form-select' name='reparto'>";
                    while($row = $reparto->fetch_assoc()){
                    echo "<option value='".$row['id_reparto']."'>" .$row['nome']. "</option>";
                    }
                    echo "</select>";
                    echo "<br><br>";
                    echo "<input class='form-input-sub' type='submit' value='Avanti'>";
                    }
    
                //Cerca sezione
                $sezione = cercaSezione($flag_reparto);
    
                if(!empty($flag_categoria)&&!empty($flag_reparto)&&!empty($flag_sottocategoria)&&!empty($flag_idarticolo)){
                    if($flag_categoria == 1 || $flag_categoria == 4){
                        $flag_categoria = $flag_sottocategoria;
                    }
                    echo "<form class='form-style' method='get' action='operazioni.php'/>";
                    echo "<input type='hidden' name='id_articolo' value='$flag_idarticolo'>";
                    echo "<input type='hidden' name='prezzo' value='".$_POST['prezzo']."'>";
                    echo "<input type='hidden' name='categoria' value='$flag_categoria'>";
                    echo "<input type='hidden' name='sottocategoria' value='$flag_sottocategoria'>";
                    echo "<input type='hidden' name='reparto' value='$flag_reparto'>";
                    echo "<input type='hidden' name='update_articolo' value='1'>";
                    echo "<h3>Sezione:</h3>";
                    echo "<select class='form-select' name='sezione'>";
                        
                    while ($row = $sezione->fetch_assoc()){
                        echo "<option value='".$row['id_sezione']."'>" .$row['sezione']. "</option>";
                    }
                    echo "</select>";
                    echo "<br><br>";
                    echo "<input class='form-input-sub' type='submit' value='Sistema articolo'>";
                    }
                
                }
                break;
            case 'registra-vendita':
                {
                    echo "<h1>Registra vendita</h1>";
                    $vendita = printVendita();
                    echo "<form method='get' action='operazioni.php'/>";
                    echo"<center>";
                    echo"<table>";
                    echo"<tr>";
                    echo"<th></th>";
                    echo"<th>ID Articolo</th>";
                    echo"<th>Nome Articolo</th>";
                    echo"<th>Categoria</th>";
                    echo"<th>Sottocategoria</th>";
                    echo"<th>Reparto</th>";
                    echo"<th>Taglia</th>";
                    echo"<th>Prezzo</th>";
                    echo"</tr>";
                    while($row = $vendita->fetch_assoc()){
                        echo"<tr>";
                        echo "<td><input type='checkbox' name='checkbox[]' value='". $row['id_articolo'] ."'></td><td>". $row["id_articolo"] ."</td><td>". $row["nome_articolo"]   ."</td><td>". $row["categoria"] ."</td><td>". $row["sottocategoria"]  ."</td><td>".  $row["reparto"]  ."</td><td>".  $row["taglia"]  ."</td><td>".  $row["prezzo"]  ."€"."</td>";
                        echo"</tr>";
                    }
                    echo"</table>";
                    echo"<br><br>";
                    echo"<input class='submit' type='submit' name='register' id='register' value='Conferma vendita'>";
                    }
                break;

            
    default:
    endswitch;
    else:
        ?>
       <h2>Bentrovato, <?= $user['nome']; ?> <br>Benvenuto nel pannello addetto vendita. <br />
            <h3><br>Ecco il tuo orario lavorativo: <br /></h3>
        <?php
            $user_id = $_SESSION['logged_in'];
            $orario_add = orarioAddetto($user_id);
            
            echo"<br><br>";
            echo"<center>";
            echo "<table id='table-login'>";
            echo "<tr>";
            echo"<th>Orario</th>";
            echo"<th>Giorno</th>";
            while($row = $orario_add->fetch_assoc()){
                echo "<tr><td>". $row["orario"] ."</td><td>". $row["giorno"] ."</td><tr>";
            }
            echo "</table>";
            echo"</center>";
    endif;
?>

</div>
</div>
</body>

<div id="content">
</div>
</body>
</html>

<?php mysqli_close($conn); ?>
