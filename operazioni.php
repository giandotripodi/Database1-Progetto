<?php
require_once "config.php";
require_once "database.php";
session_start();




if((isset($_GET['nome_art']))&&(isset($_GET['taglia']))&&(isset($_GET['quantita']))&&(isset($_GET['prezzo']))&&(isset($_GET['categoria']))&&(isset($_GET['sottocategoria']))&&(isset($_GET['reparto']))&&(isset($_GET['flag_aggiungi']))&&(isset($_GET['sezione']))){

    $nome_art = @$_GET['nome_art'];
    $taglia = @$_GET['taglia'];
    $quantita = @$_GET['quantita'];
    $prezzo = @$_GET['prezzo'];
    $categoria = @$_GET['categoria'];
    $reparto = @$_GET['reparto'];
    
    if(empty($nome_art)){
        echo "Errore: inserire il nome dell'articolo. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
    }
    elseif(empty($taglia)){
        echo "Errore: inserire la taglia. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
    }
    
    elseif(empty($quantita)){
        echo "Errore: inserire la quantità. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
    }
    
    elseif(empty($prezzo)){
        echo "Errore: inserire il prezzo. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
    }
    
    elseif(empty($categoria)){
        echo "Errore: inserire la categoria. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
    }
    
    elseif(empty($reparto)){
        echo "Errore: inserire il reparto. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
    }
    else{
        $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
        if(!$conn) {
        echo mysqli_connect_error();
        }
        InsertArticolo(addslashes($nome_art),addslashes($taglia),addslashes($quantita),addslashes($prezzo),addslashes($categoria),addslashes($reparto));
        echo"Operazione riuscita, sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
    }
}
if((isset($_GET['id_negozio']))&&(isset($_GET['nome']))&&(isset($_GET['via']))&&(isset($_GET['cap']))&&(isset($_GET['citta']))){

    $id_negozio = @$_GET['id_negozio'];
    $nome = @$_GET['nome'];
    $via = @$_GET['via'];
    $cap = @$_GET['cap'];
    $citta = @$_GET['citta'];

    if (empty($nome)){
        echo "Errore: inserire il nome del negozio. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
    }
    else{
        $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
        if(!$conn){
            echo mysqli_connect_error();
        }
        aggiornaNegozio(addslashes($id_negozio), addslashes($nome), addslashes($via), addslashes($cap), addslashes($citta));
        echo"Operazione riuscita, sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
    }
}

if((isset($_GET['id_addetto'])&&isset($_GET['id_reparto']))){

    $id_addetto = @$_GET['id_addetto'];
    $id_reparto = @$_GET['id_reparto'];

    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    aggiornaReparto(addslashes($id_addetto), addslashes($id_reparto));
    echo"Operazione riuscita, sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
    
    
}

if((isset($_GET['flag_aggiungi']))&&(isset($_GET['id_magazziniere']))&&(isset($_GET['id_giorno']))&&(isset($_GET['id_orario']))){

    $id_magazziniere = @$_GET['id_magazziniere'];
    $id_giorno = @$_GET['id_giorno'];
    $id_orario = @$_GET['id_orario'];
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    inserisciOrarioM(addslashes($id_magazziniere), addslashes($id_giorno), addslashes($id_orario));
    echo"Operazione riuscita, sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
    

}

if((isset($_GET['flag_aggiungi']))&&(isset($_GET['id_addetto']))&&(isset($_GET['id_giorno']))&&(isset($_GET['id_orario']))){

    $flag_aggiungi = @$_GET['flag_aggiungi'];
    $id_addetto = @$_GET['id_addetto'];
    $id_giorno = @$_GET['id_giorno'];
    $id_orario = @$_GET['id_orario'];

    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    if($flag_aggiungi == 1){
    inserisciOrarioA(addslashes($id_addetto), addslashes($id_giorno), addslashes($id_orario));
    }
    echo"Operazione riuscita, sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
    

}
if((isset($_GET['flag_modifica']))&&(isset($_GET['id_addetto']))&&(isset($_GET['id_giorno']))&&(isset($_GET['id_orario']))){
    
    $flag_modifica = @$_GET['flag_modifica'];
    $id_addetto = @$_GET['id_addetto'];
    $id_giorno = @$_GET['id_giorno'];
    $id_orario = @$_GET['id_orario'];
    
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    if($flag_modifica == 1){
    modificaOrarioA($id_addetto, $id_orario, $id_giorno);
    }
    echo"Operazione riuscita, sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";

}

if((isset($_GET['flag_modifica']))&&(isset($_GET['id_magazziniere']))&&(isset($_GET['id_giorno']))&&(isset($_GET['id_orario']))){
    
    $flag_modifica = @$_GET['flag_modifica'];
    $id_magazziniere = @$_GET['id_magazziniere'];
    $id_giorno = @$_GET['id_giorno'];
    $id_orario = @$_GET['id_orario'];
    
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    if($flag_modifica == 1){
    modificaOrarioM($id_magazziniere, $id_orario, $id_giorno);
    }
    echo"Operazione riuscita, sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";

}

if((isset($_GET['delete']))&&(isset($_GET['checkbox']))){
    $checkarr = @$_GET['checkbox'];
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    foreach($checkarr as $id_articolo){
        deleteArticolo($id_articolo);
    }
    echo"Operazione riuscita, sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";

}

if((isset($_GET['delete']))&&(empty($_GET['checkbox']))){
    echo "Errore: selezionare almeno un articolo. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
}

if((isset($_GET['execute']))&&(isset($_GET['checkbox']))){
    $checkarr = $_GET['checkbox'];
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    foreach($checkarr as $id_ordine){
        adminUpdateordine($id_ordine);
    }
    echo"Operazione riuscita, sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
}

if((isset($_GET['execute']))&&(empty($_GET['checkbox']))){
    echo "Errore: selezionare almeno un articolo. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
}

if((isset($_GET['flag_ordine']))&&(isset($_GET['flag_addetto']))&&(isset($_GET['nome_art']))&&(isset($_GET['taglia']))&&(isset($_GET['quantita']))){

    $nome_art = @$_GET['nome_art'];
    $taglia = @$_GET['taglia'];
    $quantita = @$_GET['quantita'];
    if(empty($nome_art)){
        echo "Errore: inserire il nome dell'articolo. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/addetto.php'/>";
    }
    if(empty($taglia)){
        echo "Errore: inserire la taglia. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/addetto.php'/>";
    }
    if(empty($quantita)){
        echo "Errore: inserire la quantita. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/addetto.php'/>";
    }
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    for($x = 1; $x <= $quantita; $x++){
        createOrdine($nome_art);
        $id_ordine = idOrdine();
        createArticoloOrd(addslashes($nome_art), addslashes($id_ordine),addslashes($taglia));
    }
    echo"Operazione riuscita, sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/addetto.php'/>";
    
}
if((isset($_GET['flag_ordine']))&&(isset($_GET['flag_direttore']))&&(isset($_GET['nome_art']))&&(isset($_GET['taglia']))&&(isset($_GET['quantita']))){

    $nome_art = @$_GET['nome_art'];
    $taglia = @$_GET['taglia'];
    $quantita = @$_GET['quantita'];
    if(empty($nome_art)){
        echo "Errore: inserire il nome dell'articolo. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
    }
    if(empty($taglia)){
        echo "Errore: inserire la taglia. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
    }
    if(empty($quantita)){
        echo "Errore: inserire la quantita. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
    }
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    for($x = 1; $x <= $quantita; $x++){
        createOrdine($nome_art);
        $id_ordine = idOrdine();
        createArticoloOrd(addslashes($nome_art), addslashes($id_ordine),addslashes($taglia));
    }
    echo"Operazione riuscita, sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/direttore.php'/>";
    
}

if((isset($_GET['update_articolo']))&&(isset($_GET['id_articolo']))&&(isset($_GET['prezzo']))&&(isset($_GET['categoria']))&&(isset($_GET['sottocategoria']))&&(isset($_GET['reparto']))){

    $id_articolo = @$_GET['id_articolo'];
    $prezzo = @$_GET['prezzo'];
    $categoria = @$_GET['categoria'];
    $sottocategoria = @$_GET['sottocategoria'];
    $reparto = @$_GET['reparto'];

    if(empty($prezzo)){
        echo "Errore: inserire il prezzo dell'articolo. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/addetto.php'/>";
    }
    if(empty($categoria)){
        echo "Errore: inserire la taglia. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/addetto.php'/>";
    }
    if(empty($sottocategoria)){
        echo "Errore: inserire la sottocategoria. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/addetto.php'/>";
    }
    if(empty($reparto)){
        echo "Errore: inserire il reparto. Sarai reindirizzato nel pannello in 3 secondi...";
        echo"<meta http-equiv='refresh' content='3;url=/addetto.php'/>";
    }
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    updateArticolo(addslashes($id_articolo), addslashes($prezzo), addslashes($categoria), addslashes($reparto));
    echo"Operazione riuscita, sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/addetto.php'/>";
}

if((isset($_GET['register'])&&(isset($_GET['checkbox'])))){
    $checkarr = @$_GET['checkbox'];
    $data= (date('Y-m-d H:i:s'));
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    foreach($checkarr as $id_articolo){
        insertVendita($id_articolo, $data);
    }
    echo"Operazione riuscita, sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/addetto.php'/>";
    
}

if((isset($_GET['register'])&&(empty($_GET['checkbox'])))){
    echo"Errore, selezionare almeno un articolo. Sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/addetto.php'/>";
}

if((isset($_GET['received'])&&(isset($_GET['checkbox'])))){

    $checkarr = @$_GET['checkbox'];
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    foreach($checkarr as $id_ordine){
        ordineRicevuto($id_ordine);
    }
    echo"Operazione riuscita, sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/magazzino.php'/>";
}

if((isset($_GET['received'])&&(empty($_GET['checkbox'])))){
    echo"Errore, selezionare almeno un articolo. Sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/magazzino.php'/>";
}

if((isset($_GET['task'])&&(isset($_GET['checkbox']))&&isset($_GET['id_fornitore']))){
    $id_fornitore = @$_GET['id_fornitore'];
    $checkarr = @$_GET['checkbox'];
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    foreach($checkarr as $id_ordine){
        fornitoreUpdateordine($id_ordine, $id_fornitore);
    }
    echo"Operazione riuscita, sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/fornitore.php'/>";
}

if((isset($_GET['task'])&&(empty($_GET['checkbox']))&&isset($_GET['id_fornitore']))){
    echo"Errore, selezionare almeno un articolo. Sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/fornitore.php'/>";
}

if((isset($_GET['completed'])&&(isset($_GET['checkbox'])))){

    $checkarr = @$_GET['checkbox'];
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    foreach($checkarr as $id_ordine){
        fornitoreComplordine($id_ordine);
    }
    echo"Operazione riuscita, sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/fornitore.php'/>";
}

if((isset($_GET['completed'])&&(empty($_GET['checkbox'])))){
    echo"Errore, selezionare almeno un articolo. Sarai reindirizzato nel pannello in 3 secondi...";
    echo"<meta http-equiv='refresh' content='3;url=/fornitore.php'/>";
}


?>