Daniel Rota 5IC 2022/2023 Tecnologie e Progettazione di Sistemi Informatici

<h1> APPLICATIVO GESTIONALE EVENTI </h1>

<h2> INTRODUZIONE </h2>

Il software mette a disposizione una serie di funzionalità dedite alla manipolazione di dati persistenti presenti su un Database <i>MySQL</i>.

Il tema di riferimento è la "Gestione di eventi" da parte di un utente, il quale possiede la possibilità di modificare dati già esistenti, aggiungerne di nuovi ed eliminare quelli già esistenti, oltre ovviamente a visualizzare quelli già creati.

Per stabilire una connessione con il Database locale, ho deciso di utilizzare il driver <i>PDO</i>, in quanto maggiormente affidabile rispetto all'alternativa <i>mysqli</i>, questo permette infatti una maggiore flessibilità per quanto riguarda l'interfacciarsi con diverse tipologie di Basi di Dati, oltre che a una maggiore sicurezza nei confronti degli attacchi cosidetti di "<i>Injection</i>", dove vengono sfruttate le vulnerabilità dell'interfaccia dell'applicativo, inserendo ad esempio codice SQL in campi di testo e danneggiando così il lato back-end.

Infine, è stato implementato l'uso di una <i>Sessione</i> (Inizializzata con: <i> session_start() </i>), in modo da mantenere i dati relativi all'interazione con l'utente corrente anche dopo un eventuale refresh della pagina. 

<h2> ANALISI CODICE </h2>

In questa sezione vengono analizzati piccoli pezzi di codice, così da esplicare i concetti salienti sui quali l'applicativo si basa.

<hr>

All'avvio del software, viene controllato il numero di dati presenti sul Database, se questo è pari a zero, viene eseguito il file <i>data.sql</i>, contenente una serie di Query per l'inizializzazione con dati demo:

if ($stmt->rowCount() == 0) { <br> $data = file_get_contents("Data/data.sql"); <br> $connection->exec($data); <br>
}

<hr>

Per la completa visualizzazione dei dati, viene eseguito un ciclo, in vengono iterati tutti gli elementi presenti nel Database tramite il metodo <i>fetch</i>, a loro volta stampati a schermo e inseriti in una table:

while ($row = $stmt->fetch(PDO::FETCH_ASSOC))

<hr>

Con lo scopo mantenere la <i>Primary Key</i> del dato del quale si sta eseguendo l'aggiornamento, viene sfruttata la possibilità di "assegnare" variabili alla Sessione in corso:

$_SESSION['pk-event-update'] = $_POST['action'];

<hr>

La chiave dell'<i>Evento</i>, viene di volta in volta passata da una pagina all'altra tramite il <i>submit</i> di un <i>form</i>, questa viene poi utilizzata per filtrare i dati presenti sul Database, facendo riferimento a quello che si vuole effettivamente manipolare, il parametro in questione viene ad esempio utilizzato nel seguente modo:

$sql = "DELETE FROM Events WHERE pkEvent = '$pk'";

<hr>

Durante la creazione e/o l'aggiornamento di dati sulla Base di Dati, è ovviamente necessario ottenere i valori relativi ai medesimi, per fare questo, ho utilizzato la variabile globale <i>$_REQUEST</i>, in grado di ottenere i valori passati da una pagina all'altra tramite il <i>submit</i> della stessa; le informazioni vengono ricavate nel seguente modo:

$name = $_REQUEST['event-name']; <br>
$description = $_REQUEST['event-description']; <br>
$people_number = $_REQUEST['event-people-number'];
