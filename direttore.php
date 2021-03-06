<?php require_once "autenticazione.php";
      require_once "config.php";
      session_start();

if(isset($_SESSION['logged_in'])) {
        $ruolo = @$_SESSION['ruolo'];
        if($ruolo == 'admin'){
        $user_id = $_SESSION['logged_in'];
        $sql = "SELECT * FROM direttore WHERE id_direttore = $user_id";
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
        <title> Pannello Direttore </title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <link rel="stylesheet" href="adminstyle.css">
    </head>
    <body>
    <div id="wrapper">

    <div id='menu_div'>
    <li id="sitename"><a href="direttore.php"><b>Pannello Direttore</b></a></li>
    <li><a href="?action=aggiungi-articolo">Aggiungi Articolo</a></li>
    <li><a href="?action=elimina-articolo">Elimina articolo</a></li>
    <li><a href="?action=gestione-ordini">Gestione ordini</a></li>
    <li><a href="?action=modifica-orario">Modifica orario</a></li>
    <li><a href="?action=inserisci-orario">Inserisci orario</a></li>
    <li><a href="?action=imposta-reparto">Imposta reparto</a></li>
    <li><a href="?action=controlla-vendite">Controlla vendite</a></li>
    <li><a href="?action=aggiorna-info">Aggiorna informazioni</a></li>
    <li><a href="logout.php">Logout</a></li>
    </div>

<div id="content">
<?php
    if(isset($_GET['action'])):   
    switch($_GET['action']):

        case 'aggiungi-articolo':
            {
                echo "<h1>Aggiungi articolo</h1><br><br>";
        
                $flag_categoria = @$_POST['categoria'];
                $flag_sottocategoria = @$_POST['sottocategoria'];
                $flag_reparto = @$_POST['reparto'];
                        
        
                //Cerca categorie
                $categoria = cercaCategoria();
        
                if(empty($flag_categoria)&&empty($flag_reparto)&&empty($flag_sottocategoria)){
                    echo "<form class='form-style' method='post' action='direttore.php?action=aggiungi-articolo'/>";
                    echo "<h3>Nome articolo:</h3>";
                    echo "<input class='form-input' type='text' name='nome_art' placeholder='Inserisci il nome'/>";
                    echo "<h3>Taglia:</h3>";
                    echo "<input class='form-input' type='text' name='taglia' placeholder='Inserisci la taglia'/>";
                    echo "<h3>Quantità:</h3>";
                    //echo "<input type='text' name='quantita' placeholder='Inserisci la quantità'/>";
                    echo "<select class='form-select' name ='quantita'>";
                    for($i = 1; $i <= 99; $i++){
                    echo "<option>" .$i. "</option>";
                    }
                    echo "</select>";
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
                        echo "<form class='form-style' method='post' action='direttore.php?action=aggiungi-articolo'/>";
                        echo "<input type='hidden' name='nome_art' value='".$_POST['nome_art']."'>";
                        echo "<input type='hidden' name='taglia' value='".$_POST['taglia']."'>";
                        echo "<input type='hidden' name='quantita' value='".$_POST['quantita']."'>";
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
                        
                    if(!empty($flag_categoria)&&empty($flag_reparto)&&!empty($flag_sottocategoria)){
                        echo "<form class='form-style' method='post' action='direttore.php?action=aggiungi-articolo'/>";
                        echo "<input type='hidden' name='nome_art' value='".$_POST['nome_art']."'>";
                        echo "<input type='hidden' name='taglia' value='".$_POST['taglia']."'>";
                        echo "<input type='hidden' name='quantita' value='".$_POST['quantita']."'>";
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
        
                    if(!empty($flag_categoria)&&!empty($flag_reparto)&&!empty($flag_sottocategoria)){
                        if($flag_categoria == 1 || $flag_categoria == 4){
                            $flag_categoria = $flag_sottocategoria;
                        }
                        echo "<form class='form-style' method='get' action='operazioni.php'/>";
                        echo "<input type='hidden' name='nome_art' value='".$_POST['nome_art']."'>";
                        echo "<input type='hidden' name='taglia' value='".$_POST['taglia']."'>";
                        echo "<input type='hidden' name='quantita' value='".$_POST['quantita']."'>";
                        echo "<input type='hidden' name='prezzo' value='".$_POST['prezzo']."'>";
                        echo "<input type='hidden' name='categoria' value='$flag_categoria'>";
                        echo "<input type='hidden' name='sottocategoria' value='$flag_sottocategoria'>";
                        echo "<input type='hidden' name='reparto' value='$flag_reparto'>";
                        echo "<input type='hidden' name='flag_aggiungi' value='1'>";
                        echo "<h3>Sezione:</h3>";
                        echo "<select class='form-select' name='sezione'>";
                            
                        while ($row = $sezione->fetch_assoc()){
                            echo "<option value='".$row['id_sezione']."'>" .$row['sezione']. "</option>";
                        }
                        echo "</select>";
                        echo "<br><br>";
                        echo "<input class='form-input-sub' type='submit' value='Aggiungi articolo'>";
                        }
                    }
            break;
        
        case 'aggiorna-info':
            echo "<h1>Aggiorna informazioni del negozio</h1>";
            {
                $flag_negozio = @$_POST['negozio'];
                
                $negozio = cercaNegozio();
                
                if(empty($flag_negozio)){
                    echo "<form class='form-style' method='post' action='direttore.php?action=aggiorna-info'/>";
                    echo "<h3>Seleziona negozio:</h3>";
                    echo "<select class='form-select' name='negozio'>";
                    while ($row = $negozio->fetch_assoc()){
                    echo "<option value='".$row['id_negozio']."'>" .$row['nome']. "</option>";
                    }
                    echo "</select>";
                    echo "<br><br>";
                    echo "<input class='form-input-sub' type='submit' value='Avanti'>";
                }
                if(!empty($flag_negozio)){

                    echo "<form class='form-style' method='get' action='operazioni.php'/>";
                    echo "<input type='hidden' name='id_negozio' value='$flag_negozio'>";
                    echo "<h3>Nome negozio:</h3>";
                    echo "<input class='form-input' type='text' name='nome' placeholder='Inserisci il nome'>";
                    echo "<h3>Via:</h3>";
                    echo "<input class='form-input' type='text' name='via' placeholder='Inserisci la via'>";
                    echo "<h3>Cap:</h3>";
                    echo "<input class='form-input' type='text' name='cap' placeholder='Inserisci il cap'>";
                    echo "<h3>Citta':</h3>";
                    echo "<input class='form-input' type='text' name='citta' placeholder='Inserisci la città'>";
                    echo "<br><br>";
                    echo "<input class='form-input-sub' type='submit' value='Aggiorna informazioni'>";

                }

            }
            break;
        case 'imposta-reparto':
            echo "<h1>Imposta Reparto</h1>";
            {
                $flag_addetto = @$_POST['addetto'];
                //Visualizza addetto
                $addetto = cercaAddetto();

                if(empty($flag_addetto)){
                    echo "<form class='form-style' method='post' action='direttore.php?action=imposta-reparto'/>";
                    echo "<h3>Seleziona un addetto vendita:</h3>";
                    echo "<select class='form-select' name='addetto'>";
                    while ($row = $addetto->fetch_assoc()){
                        echo "<option value='".$row['id_addetto']."'>" .$row['nome']. "</option>";
                    }
                    echo "</slect>";
                    echo "<br><br>";
                    echo "<input class='form-input-sub' type='submit' value='Avanti'>";
                }
                
                if(!empty($flag_addetto)){

                    $reparto = cercaReparto();
                    echo "<form class='form-style' method='get' action='operazioni.php'/>";
                    echo "<input type='hidden' name='id_addetto' value='$flag_addetto'>";
                    echo "<h3>Seleziona reparto:</h3>";
                    echo "<select class='form-select' name='id_reparto'>";
                    while ($row = $reparto->fetch_assoc()){
                    echo "<option value='".$row['id_reparto']."'>" .$row['nome']. "</option>";
                    }
                    echo "</select>";
                    echo "<br><br>";
                    echo "<input class='form-input-sub' type='submit' value='Avanti'>";

                }
                
            }
            break;
        case 'inserisci-orario':
            echo"<h1>Inserisci orario dipendenti</h1>";
            {
                $flag_addetto=@$_POST['addetto'];
                $flag_magazziniere=@$_POST['magazziniere'];
                $addetto = cercaAddetto();
                $magazziniere = cercaMagazziniere();
                
                if(empty($flag_addetto)&&empty($flag_magazziniere)){

                echo "<form class='form-style' method='post' action='direttore.php?action=inserisci-orario'/>";
                echo "<h3>Addetti vendita:</h3>";
                echo "<select class='form-select' name='addetto'>";
                while ($row = $addetto->fetch_assoc()){
                echo "<option value=0>...</option>";
                echo "<option value='".$row['id_addetto']."'>" .$row['nome'].  " - Addetto vendita</option>";
                }
                echo "</select>";
                echo "<h3>Magazzinieri:</h3>";
                echo "<select class='form-select' name='magazziniere'>";
                while ($row = $magazziniere->fetch_assoc()){
                    echo "<option value=0>...</option>";
                    echo "<option value='".$row['id_magazziniere']."'>" .$row['nome'].  " - Magazziniere</option>";
                }
                echo "</select>";
                echo "<input class='form-input-sub' type='submit' value='Avanti'>";
                }

                if(!empty($flag_magazziniere)&&(empty($flag_addetto))){
                    $flag_aggiungi = 1;
                    $giorno = cercaGiorno();
                    $orario = cercaOrario();
                    echo "<form class='form-style' method='get' action='operazioni.php'/>";
                    echo "<input type='hidden' name='id_magazziniere' value='$flag_magazziniere'>";
                    echo "<input type='hidden' name='flag_aggiungi' value='$flag_aggiungi'>";
                    echo "<h3>Seleziona giorno:</h3>";
                    echo "<select class='form-select' name='id_giorno'>";
                    while ($row = $giorno->fetch_assoc()){
                        echo "<option value='".$row['id_giorno']."'>" .$row['giorno']. "</option>";
                    }
                    echo "</select>";
                    echo "<h3>Seleziona turno:</h3>";
                    echo "<select class='form-select' name='id_orario'>";
                    while ($row = $orario->fetch_assoc()){
                        echo "<option value='".$row['id_orario']."'>" .$row['orario']. "</option>";
                    }
                    echo "</select>";
                    echo "<input class='form-input-sub' type='submit' value='Inserisci orario'>";
                }

                if(empty($flag_magazziniere)&&(!empty($flag_addetto))){
                    $flag_aggiungi = 1;
                    $giorno = cercaGiorno();
                    $orario = cercaOrario();
                    echo "<form class='form-style' method='get' action='operazioni.php'/>";
                    echo "<input type='hidden' name='id_addetto' value='$flag_addetto'>";
                    echo "<input type='hidden' name='flag_aggiungi' value='$flag_aggiungi'>";
                    echo "<h3>Seleziona giorno:</h3>";
                    echo "<select class='form-select' name='id_giorno'>";
                    while ($row = $giorno->fetch_assoc()){
                        echo "<option value='".$row['id_giorno']."'>" .$row['giorno']. "</option>";
                    }
                    echo "</select>";
                    echo "<h3>Seleziona turno:</h3>";
                    echo "<select class='form-select' name='id_orario'>";
                    while ($row = $orario->fetch_assoc()){
                        echo "<option value='".$row['id_orario']."'>" .$row['orario']. "</option>";
                    }
                    echo "</select>";
                    echo "<input class='form-input-sub' type='submit' value='Inserisci orario'>";
                }
            }
            break;
        case 'modifica-orario':
            echo"<h1>Modifica orario dipendente</h1>";
            {
                $flag_addetto=@$_POST['addetto'];
                $flag_magazziniere=@$_POST['magazziniere'];
                $addetto = cercaAddetto();
                $magazziniere = cercaMagazziniere();
                
                if(empty($flag_addetto)&&empty($flag_magazziniere)){

                echo "<form class='form-style' method='post' action='direttore.php?action=modifica-orario'/>";
                echo"<h2>Seleziona un dipendente</h2>";
                echo"<br><br>";
                echo "<h3>Addetti vendita:</h3>";
                echo "<select class='form-select' name='addetto'>";
                while ($row = $addetto->fetch_assoc()){
                echo "<option value=0>...</option>";
                echo "<option value='".$row['id_addetto']."'>" .$row['nome'].  " - Addetto vendita</option>";
                }
                echo "</select>";
                echo "<h3>Magazzinieri:</h3>";
                echo "<select class='form-select' name='magazziniere'>";
                while ($row = $magazziniere->fetch_assoc()){
                    echo "<option value=0>...</option>";
                    echo "<option value='".$row['id_magazziniere']."'>" .$row['nome']."  ".$row['cognome']. "  - Magazziniere</option>";
                }
                echo "</select>";
                echo "<input class='form-input-sub' type='submit' value='Avanti'>";
                }
                if(!empty($flag_addetto)&&empty($flag_magazziniere)){
                    $flag_modifica = 1;
                    $orario_add = orarioAddetto($flag_addetto);
                    $giorno = cercaGiorno();
                    $orario = cercaOrario();
                    echo"<center>";
                    echo "<table>";
                    echo "<tr>";
                        echo"<th>Orario</th>";
                        echo"<th>Giorno</th>";
                    while($row = $orario_add->fetch_assoc()){
                         echo "<tr><td>". $row["orario"] ."</td><td>". $row["giorno"] ."</td><tr>";
                    }
                    echo "</table>";
                    echo"</center>";
                    echo"<br><br><br><br>";
                    echo "<form class='form-style' method='get' action='operazioni.php'/>";
                    echo "<input type='hidden' name='flag_modifica' value='$flag_modifica'>";
                    echo "<input type='hidden' name='id_addetto' value='$flag_addetto'>";
                    echo"<h3>Seleziona il giorno da modificare</h3>";
                    echo"<select class='form-select' name='id_giorno'>";
                    while ($row = $giorno->fetch_assoc()){
                        echo "<option value='".$row['id_giorno']."'>" .$row['giorno']."</option>";
                    }
                    echo "</select>";
                    echo"<br>";
                    echo"<h3>Seleziona il turno</h3>";
                    echo"<select class='form-select' name='id_orario'>";
                    while ($row = $orario->fetch_assoc()){
                        echo "<option value='".$row['id_orario']."'>".$row['orario']. "</option>";
                    }
                    echo "</select>";
                    echo "<input class='form-input-sub' type='submit' value='Modifica orario'>";

                }
                if(!empty($flag_magazziniere)&&(empty($flag_addetto))){
                    
                    $flag_modifica = 1;
                    $orario_mag = orarioMag($flag_magazziniere);
                    $giorno = cercaGiorno();
                    $orario = cercaOrario();
                    echo"<center>";
                    echo"<table>";
                    echo "<tr>";
                        echo"<th>Orario</th>";
                        echo"<th>Giorno</th>";
                    echo "</tr>";
                    while($row = $orario_mag->fetch_assoc()){
                        echo "<tr><td>". $row["orario"] ."</td><td>". $row["giorno"] ."</td></tr>";
                       }
                    echo"</table>";
                    echo"</center>";
                    echo"<br><br><br><br>";
                    echo "<form class='form-style' method='get' action='operazioni.php'/>";
                    echo "<input type='hidden' name='flag_modifica' value='$flag_modifica'>";
                    echo "<input type='hidden' name='id_magazziniere' value='$flag_magazziniere'>";

                    echo"<h3>Seleziona il giorno da modificare</h3>";
                    echo"<select class='form-select' name='id_giorno'>";
                    while ($row = $giorno->fetch_assoc()){
                        echo "<option value='".$row['id_giorno']."'>" .$row['giorno']."</option>";
                    }
                    echo "</select>";
                    echo"<br>";
                    echo"<h3>Seleziona il turno</h3>";
                    echo"<select class='form-select' name='id_orario'>";
                    while ($row = $orario->fetch_assoc()){
                        echo "<option value='".$row['id_orario']."'>".$row['orario']. "</option>";
                    }
                    echo "</select>";
                    echo "<input class='form-input-sub' type='submit' value='Modifica orario'>";

                }
            }
            break;
        
        case 'elimina-articolo':
            echo"<h1>Elimina articolo</h1>";
            {
            $articolo = cercaArticolo();
            $no_cat = cercaArticolono_cat();
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
            echo"</tr>";
            while($row = $articolo->fetch_assoc()){
                echo"<tr>";
                echo "<td><input type='checkbox' name='checkbox[]' value='". $row['id_articolo'] ."'></td><td>". $row["id_articolo"] ."</td><td>". $row["nome_articolo"]   ."</td><td>". $row["categoria"] ."</td><td>". $row["sottocategoria"]  ."</td><td>".  $row["Reparto"]  ."</td>";
                echo"</tr>";
            }
            while($row = $no_cat->fetch_assoc()){
                echo"<tr>";
                echo "<td><input type='checkbox' name='checkbox[]' value='". $row['id_articolo'] ."'></td><td>". $row["id_articolo"] ."</td><td>". $row["nome_articolo"]   ."</td><td>". $row["categoria"] ."</td><td>-------</td><td>".  $row["Reparto"]  ."</td>";
                echo"</tr>";
            }
            echo"</table>";
            echo "<br><br>";
            echo"<input class='submit' type='submit' name='delete' id='delete' value='Elimina articolo'>";
            }
            break;     

        case'gestione-ordini':
            echo"<h1>Gestione ordini</h1>";
            {
            $flag_menu = @$_POST['selezione'];
            if(empty($flag_menu)){
            echo "<form class='form-style' method='post' action='direttore.php?action=gestione-ordini'/>";
            echo "<select class='form-select' name='selezione'>";
            echo "<option value=0>Seleziona un'operazione...</option>";
            echo "<option value=1>Crea ordine</option>";
            echo "<option value=2>Conferma ordine</option>";
            echo "<option value=3>Controlla stato ordini</option>";
            echo "</select>";
            echo"<br><br>";
            echo "<input class='form-input-sub' type='submit' value='Avanti'>";
            }
            if($flag_menu == 1){
                $flag_nome=@$_POST['nome_art'];
                $flag_taglia=@$_POST['taglia'];

                if(empty($flag_taglia)&&empty($flag_nome)){
                echo "<form class='form-style' method='get' action='operazioni.php'/>";
                echo "<input type='hidden' name='flag_ordine' value='1'>";
                echo "<input type='hidden' name='flag_direttore' value='1'>";
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
            if($flag_menu == 2){

                $ordini = searchexOrdini();
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
                    echo "<td><input type='checkbox' name='checkbox[]' value='". $row['id_ordine'] ."'></td><td>". $row["id_ordine"] ."</td><td>". $row["articolo"]   ."</td><td>". $row["taglia"]   ."</td><td>Da effettuare</td>";
                    echo"</tr>";
                }
                echo "</table>";
                echo"<br><br>"; 
                echo"<input class='submit' type='submit' name='execute' id='execute' value='Effettua ordine'>";
            }

            if($flag_menu == 3){
                $ordini = checkOrdini();
                echo"<center>";
                echo"<h3>Ordini presi in carico:</h3>";
                echo"<table>";
                echo"<tr>";
                echo"<th>ID ordine</th>";
                echo"<th>Fornitore</th>";
                echo"<th>Articolo</th>";
                echo"<th>Taglia</th>";
                echo"<th>Stato</th>";
                echo"</tr>";
                while($row = $ordini->fetch_assoc()){
                    echo"<tr>";
                    if($row['stato'] == 4){
                    echo "<td>". $row["id_ordine"] ."</td><td>". $row["fornitore"] ."</td><td>". $row["articolo"]  ."</td><td>". $row["taglia"]  ."</td><td>Spedito</td>";
                    echo"</tr>";
                    }
                    elseif($row['stato'] == 5){
                        echo "<td>". $row["id_ordine"] ."</td><td>". $row["fornitore"] ."</td><td>". $row["articolo"]  ."</td><td>". $row["taglia"]  ."</td><td>Consegnato</td>";
                        echo"</tr>";
                    }
                }
                echo"</table>";
                echo"<br><br>";
                echo"<h3>Ordini non presi in carico:</h3>";
                $ordini = checkOrdininof();
                echo"<center>";
                echo"<table>";
                echo"<tr>";
                echo"<th>ID ordine</th>";
                echo"<th>Articolo</th>";
                echo "<th>Taglia</th>";
                echo"<th>Stato</th>";
                echo"</tr>";
                while($row = $ordini->fetch_assoc()){
                    echo"<tr>";
                    echo "<td>". $row["id_ordine"] ."</td><td>". $row["articolo"] ."</td><td>". $row["taglia"] ."</td><td>Non preso in carico</td>";
                    echo"</tr>";
                    }
                }
                }
            
            break; 
        case'controlla-vendite':
            {
                echo "<h1>Controlla vendite</h1><br><br>";
                if((isset($_POST['mese']))){
                    $mese = @$_POST['mese'];
                    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
                    if(!$conn){
                    echo mysqli_connect_error();
                    }
                    $vendite = printVenditeMens($mese);
                    $totale = controlloVendite($mese);
                    $total = $totale->fetch_assoc();
                    if(mysqli_num_rows($vendite) != 0){
                    echo"<center>";
                    echo "Il resoconto delle vendite per questo mese è: <h2>". $total["totale"] . "€</h2>";
                    echo "<h2>Lista articoli venduti</h2>";
                    echo"<table>";
                    echo"<tr>";
                    echo"<th>ID Articolo</th>";
                    echo"<th>Nome Articolo</th>";
                    echo"<th>Categoria</th>";
                    echo"<th>Sottocategoria</th>";
                    echo"<th>Reparto</th>";
                    echo"<th>quantità</th>";
                    echo "<th>Taglia</th>";
                    echo "<th>Prezzo</th>";
                    echo "<th>Data vendita</th>";
                    echo"</tr>";
                    while($row = $vendite->fetch_assoc()){
                        echo"<tr>";
                        echo "<td>". $row["id_articolo"] ."</td><td>". $row["nome_articolo"]   ."</td><td>". $row["categoria"] ."</td><td>". $row["sottocategoria"]  ."</td><td>".  $row["reparto"]  ."</td><td>".  $row["quantita"]  ."</td><td>".  $row["taglia"]  ."</td><td>".  $row["prezzo"]  ."€</td><td>".  $row["data_vendita"]  ."</td>";
                        echo"</tr>";
                        }
                    }
                    else{
                        echo "Nessun resoconto vendite trovato nel mese selezionato.";
                    }
                    echo"</table>";
                    echo"<br><br>";
                }

                echo "<form class='form-style' method='post' action='direttore.php?action=controlla-vendite'/>";
                echo "<h3>Seleziona un mese:</h3>";
                echo "<select class='form-select' name='mese'>";
                echo "<option value='00'>...</option>";
                echo "<option value='01'>Gennaio</option>";
                echo "<option value='02'>Febbraio</option>";
                echo "<option value='03'>Marzo</option>";
                echo "<option value='04'>Aprile</option>";
                echo "<option value='05'>Maggio</option>";
                echo "<option value='06'>Giugno</option>";
                echo "<option value='07'>Luglio</option>";
                echo "<option value='08'>Agosto</option>";
                echo "<option value='09'>Settembre</option>";
                echo "<option value='10'>Ottobre</option>";
                echo "<option value='11'>Novembre</option>";
                echo "<option value='12'>Dicembre</option>";
                echo "</select>";
                echo "<br><br>";
                echo "<input class='form-input-sub' type='submit' value='Cerca articolo'>";
            }
    default:
           
    endswitch;
    else:
         ?>
            <h2>Bentrovato, <?= $user['nome']; ?> <br>Benvenuto nel pannello direttore. <br /></h2>
            <?php
    endif;


?>

</div>
</div>
</body>

<div id="content">
</div>

<?php mysqli_close($conn); ?>
