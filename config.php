<?php 

require_once "database.php";
require_once "autenticazione.php";

function cercaArticolo(){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn) {
        echo mysqli_connect_error();
    }
    $sql = "SELECT articolo.id_articolo, articolo.nome_articolo, categoria.categoria, sotto_categoria.sottocategoria, reparto.nome AS Reparto FROM articolo 
            INNER JOIN categoria ON articolo.id_categoria = categoria.id_categoria INNER JOIN sotto_categoria ON categoria.id_categoria = sotto_categoria.id_sottocategoria 
            INNER JOIN reparto ON articolo.id_reparto = reparto.id_reparto WHERE articolo.data_vendita IS NULL ";
    $result = mysqli_query($conn, $sql) or die("Bad query: $sql");
    return $result; 
}

function cercaArticolono_cat(){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT articolo.id_articolo, articolo.nome_articolo, categoria.categoria, reparto.nome as Reparto FROM articolo 
            INNER JOIN categoria ON articolo.id_categoria = categoria.id_categoria INNER JOIN reparto ON articolo.id_reparto = reparto.id_reparto WHERE articolo.id_categoria > 7 ";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function cercaArticoloAddetto($nome_art, $taglia){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn) {
        echo mysqli_connect_error();
    }
    $sql ="SELECT articolo.id_articolo, articolo.nome_articolo, categoria.categoria, sotto_categoria.sottocategoria, reparto.nome AS Reparto, articolo.taglia FROM articolo 
            INNER JOIN categoria ON articolo.id_categoria = categoria.id_categoria INNER JOIN sotto_categoria ON categoria.id_categoria = sotto_categoria.id_sottocategoria 
            INNER JOIN reparto ON articolo.id_reparto = reparto.id_reparto WHERE nome_articolo = '$nome_art' AND taglia = '$taglia' AND articolo.data_vendita IS NULL";
    $result = mysqli_query($conn, $sql) or die("Bad query: $sql");
    return $result;
}
function cercaArticoloMag($nome_art, $taglia){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn) {
        echo mysqli_connect_error();
    }
    $sql ="SELECT id_articolo, nome_articolo, taglia FROM articolo WHERE nome_articolo = '$nome_art' AND taglia = '$taglia' 
           AND data_vendita IS NULL AND id_categoria IS NULL AND id_reparto IS NULL AND id_ordine IS NULL ";
    $result = mysqli_query($conn, $sql) or die("Bad query: $sql");
    return $result;
}

function deleteArticolo($id_articolo){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql ="DELETE FROM articolo WHERE id_articolo = $id_articolo";
    $result = mysqli_query($conn, $sql) or die("Bad query: $sql");
}

function cercaReparto() {
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn) {
        echo mysqli_connect_error();
    }
    $sql = "SELECT * FROM reparto";
    $result = mysqli_query($conn, $sql) or die("Bad query: $sql");
    return $result;
}

function cercaSezione($id_rep){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT * FROM sezione WHERE id_reparto = '$id_rep'";
    $result = mysqli_query($conn, $sql) or die("Bad query: $sql");
    return $result;
}

function InsertArticolo($nome_art, $taglia, $quantita, $prezzo, $categoria, $reparto){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    for($x = 1; $x <= $quantita; $x++){
    $sql = "INSERT INTO articolo (id_categoria, id_reparto, id_ordine, nome_articolo, quantita, prezzo, taglia) VALUES ('$categoria', '$reparto', NULL, '$nome_art', 1, '$prezzo', '$taglia')";
    $result = mysqli_query($conn, $sql) or die("Bad query: $sql");
    }

}

function cercaCategoria(){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn) {
        echo mysqli_connect_error();
    }

    $sql = "SELECT * FROM categoria WHERE categoria = 'Camicia' 
            UNION SELECT * FROM categoria WHERE categoria = 'Felpa' 
            UNION SELECT * FROM categoria WHERE categoria ='Giacca' 
            UNION SELECT * FROM categoria WHERE categoria = 'Completo'";
    $result = mysqli_query($conn, $sql) or die("Bad query: $sql");
    
    return $result;
}
function creaOrdine($id_ordine, $nome_art){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "INSERT INTO ordine (id_ordine, id_direttore, id_fornitore, articolo, stato) VALUES ('$id_ordine', '', '', '$nome_art', 1)";
}
function sottoCategoria($f_categoria){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    switch($f_categoria):

        case '1':
            $sql = "SELECT * FROM sotto_categoria WHERE id_sottocategoria <= 3";
            $result = mysqli_query($conn, $sql) or die("Bad query: $sql");
            return $result;
            break;

        case '4':
            $sql = "SELECT * FROM sotto_categoria WHERE id_sottocategoria <= 7 AND id_sottocategoria > 3";
            $result = mysqli_query($conn, $sql) or die("Bad query: $sql");
            return $result;
            break;

        endswitch;
    
}

function cercaNegozio(){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT * FROM negozio";
    $result = mysqli_query($conn, $sql) or die("Bad query: $sql");
    return $result;
}

function aggiornaNegozio($id_negozio, $nome, $via, $cap, $citta){
    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql= "UPDATE negozio SET nome ='$nome', via ='$via', cap='$cap', citta='$citta' WHERE id_negozio = '$id_negozio' ";
    $result = mysqli_query($conn, $sql) or die("Bad query: $sql");

}

function cercaAddetto(){
    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql ="SELECT * FROM addetto_vendita";
    $result = mysqli_query($conn, $sql) or die("Bad query: $sql");
    return $result;
}

function aggiornaReparto($id_addetto, $id_reparto){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql= "UPDATE addetto_vendita SET id_reparto = '$id_reparto' WHERE id_addetto = '$id_addetto'";
    $result = mysqli_query($conn, $sql) or die("Bad query: $sql");
    return $result;
}

function cercaMagazziniere(){
    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql ="SELECT * FROM magazziniere";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function cercaGiorno(){
    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql ="SELECT * FROM giorno";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function cercaOrario(){
    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql ="SELECT * FROM orario";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function inserisciOrarioM($id_magazziniere, $id_giorno, $id_orario){
    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql= "INSERT INTO orario_lavorativo (id_direttore, id_magazziniere, id_addetto, id_orario, id_giorno) VALUES(NULL, '$id_magazziniere', NULL, '$id_orario', '$id_giorno')";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function inserisciOrarioA($id_addetto, $id_giorno, $id_orario){

    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql= "INSERT INTO orario_lavorativo (id_direttore, id_magazziniere, id_addetto, id_orario, id_giorno) VALUES(NULL, NULL, '$id_addetto', '$id_orario', '$id_giorno')";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;

}
function orarioAddetto($id_addetto){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT orario_lavorativo.id_addetto, orario.orario, giorno.giorno FROM orario_lavorativo INNER JOIN orario ON orario_lavorativo.id_orario = orario.id_orario 
            INNER JOIN giorno ON orario_lavorativo.id_giorno = giorno.id_giorno WHERE id_addetto = $id_addetto ORDER BY giorno.id_giorno ASC";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function modificaOrarioA($id_addetto, $id_orario, $id_giorno){
    $conn = mysqli_connect('localhost','root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT orario_lavorativo.id_addetto, orario.orario, giorno.giorno FROM orario_lavorativo INNER JOIN orario ON orario_lavorativo.id_orario = orario.id_orario 
            INNER JOIN giorno ON orario_lavorativo.id_giorno = giorno.id_giorno WHERE id_addetto = $id_addetto AND orario_lavorativo.id_giorno = $id_giorno";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    
    if($rowcount=mysqli_num_rows($result)){
        mysqli_free_result($result);
        $sql = "UPDATE orario_lavorativo SET id_orario = '$id_orario' WHERE id_giorno = '$id_giorno' AND id_addetto = '$id_addetto'";
        $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
        return $result;
    }
    else{
        echo "Errore! Seleziona un giorno presente nell'orario!";
    }
    
}

function orarioMag($id_magazziniere){
    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT orario_lavorativo.id_magazziniere, orario.orario, giorno.giorno FROM orario_lavorativo INNER JOIN orario ON orario_lavorativo.id_orario = orario.id_orario 
    INNER JOIN giorno ON orario_lavorativo.id_giorno = giorno.id_giorno WHERE id_magazziniere = '$id_magazziniere' ORDER BY giorno.id_giorno ASC";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;

}

function modificaOrarioM($id_magazziniere, $id_orario, $id_giorno){
    $conn = mysqli_connect('localhost','root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT orario_lavorativo.id_magazziniere, orario.orario, giorno.giorno FROM orario_lavorativo INNER JOIN orario ON orario_lavorativo.id_orario = orario.id_orario 
            INNER JOIN giorno ON orario_lavorativo.id_giorno = giorno.id_giorno WHERE id_magazziniere = $id_magazziniere AND orario_lavorativo.id_giorno = $id_giorno";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    
    if($rowcount=mysqli_num_rows($result)){
        mysqli_free_result($result);
        $sql = "UPDATE orario_lavorativo SET id_orario = '$id_orario' WHERE id_giorno = '$id_giorno' AND id_magazziniere = '$id_magazziniere'";
        $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
        return $result;
    }
    else{
        echo "Errore! Seleziona un giorno presente nell'orario!";
    }
    
}

function checkOrdini(){
    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT ordine.id_ordine, fornitore.nome as fornitore, ordine.articolo, articolo.taglia, ordine.stato FROM ordine 
            INNER JOIN fornitore ON ordine.id_fornitore = fornitore.id_fornitore INNER JOIN articolo ON ordine.id_ordine = articolo.id_ordine ";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function checkOrdininof(){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT ordine.id_ordine, ordine.articolo, articolo.taglia, ordine.stato FROM ordine 
            INNER JOIN articolo ON ordine.id_ordine = articolo.id_ordine WHERE ordine.id_fornitore IS NULL AND ordine.stato = 2";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function searchexOrdini(){
    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT ordine.id_ordine, ordine.articolo, articolo.taglia, ordine.stato FROM ordine INNER JOIN articolo ON ordine.id_ordine = articolo.id_ordine WHERE ordine.stato = 1";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function ricezioneOrdini(){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT ordine.id_ordine, fornitore.nome as fornitore, ordine.articolo, articolo.taglia, ordine.stato FROM ordine 
    INNER JOIN fornitore ON ordine.id_fornitore = fornitore.id_fornitore INNER JOIN articolo ON ordine.id_ordine = articolo.id_ordine WHERE stato = 5";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function adminUpdateordine($id_ordine){

    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "UPDATE ordine set stato = 2 WHERE id_ordine = '$id_ordine'";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;

}

function createOrdine($nome_art){

    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    
    $sql = "INSERT INTO ordine (id_direttore, id_fornitore, articolo, stato) VALUES (NULL, NULL, '$nome_art', 1)";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;

}

function idOrdine(){
    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT id_ordine FROM ordine ORDER BY id_ordine DESC LIMIT 1";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    if(mysqli_num_rows($result) > 0){
        $row = $result->fetch_assoc();
        return $row['id_ordine'];
    }
}

function createArticoloOrd($nome_art, $id_ordine, $taglia){

    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "INSERT INTO articolo (id_categoria, id_reparto, id_ordine, nome_articolo, quantita, prezzo, taglia) 
            VALUES (NULL, NULL, '$id_ordine', '$nome_art', '1', '0', '$taglia')";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    
}

function printArticolonull(){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_erorr();
    }
    $sql = "SELECT id_articolo, nome_articolo, taglia FROM articolo WHERE id_categoria IS NULL AND id_reparto IS NULL AND id_ordine IS NULL AND data_vendita IS NULL ";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function updateArticolo($id_articolo, $prezzo, $categoria, $reparto){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "UPDATE articolo SET id_categoria = '$categoria', id_reparto = '$reparto', prezzo = '$prezzo' WHERE id_articolo = '$id_articolo'";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
}

function printVendita(){

    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT articolo.id_articolo, articolo.nome_articolo, categoria.categoria, sotto_categoria.sottocategoria, reparto.nome AS reparto, articolo.taglia, articolo.prezzo FROM articolo 
            INNER JOIN categoria ON articolo.id_categoria = categoria.id_categoria INNER JOIN sotto_categoria ON articolo.id_categoria = sotto_categoria.id_sottocategoria 
            INNER JOIN reparto ON articolo.id_reparto = reparto.id_reparto WHERE articolo.data_vendita IS NULL";

    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function insertVendita($id_articolo, $data){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "UPDATE articolo SET data_vendita = '$data' WHERE id_articolo = '$id_articolo'";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");

}

function controlloVendite($mese){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT sum(prezzo) as totale FROM articolo WHERE data_vendita LIKE '_____%$mese%____________";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function printVenditeMens($mese){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT articolo.id_articolo, articolo.nome_articolo, categoria.categoria, sotto_categoria.sottocategoria, reparto.nome as reparto, articolo.quantita, articolo.taglia, articolo.prezzo, articolo.data_vendita FROM articolo 
            INNER JOIN categoria ON articolo.id_categoria = categoria.id_categoria INNER JOIN sotto_categoria ON categoria.id_categoria = sotto_categoria.id_sottocategoria 
            INNER JOIN reparto ON articolo.id_reparto = reparto.id_reparto WHERE data_vendita LIKE '_____%$mese%____________'";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function ordineRicevuto($id_ordine){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql2= "SET foreign_key_checks = 0";
    mysqli_query($conn, $sql2);
    $sql1 = "DELETE FROM ordine WHERE id_ordine = '$id_ordine'";
    mysqli_query($conn, $sql1) or die("Bad query:$sql1");
    $sql = "UPDATE articolo set id_ordine = NULL WHERE id_ordine = '$id_ordine'";
    mysqli_query($conn, $sql) or die("Bad query:$sql");
    $sql3= "SET foreign_key_checks = 1";
    mysqli_query($conn, $sql3);

}

function incaricoOrdini(){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT ordine.id_ordine, ordine.articolo, articolo.taglia, ordine.stato FROM ordine INNER JOIN articolo ON ordine.id_ordine = articolo.id_ordine WHERE ordine.stato = 2";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function fornitoreUpdateordine($id_ordine, $id_fornitore){
    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "UPDATE ordine set stato = 4, id_fornitore = '$id_fornitore' WHERE id_ordine = '$id_ordine'";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function completaOrdine(){
    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "SELECT ordine.id_ordine, ordine.articolo, articolo.taglia, ordine.stato FROM ordine INNER JOIN articolo ON ordine.id_ordine = articolo.id_ordine WHERE ordine.stato = 4";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}

function fornitoreComplordine($id_ordine){
    $conn = mysqli_connect('localhost', 'root', '','my_tripodibasi1');
    if(!$conn){
        echo mysqli_connect_error();
    }
    $sql = "UPDATE ordine set stato = 5 WHERE id_ordine = '$id_ordine'";
    $result = mysqli_query($conn, $sql) or die("Bad query:$sql");
    return $result;
}


?>

