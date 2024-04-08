<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcolo Codice Fiscale</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Calcolo Codice Fiscale</h2>
        <form method="post">
            <div class="form-group">
                <label for="cognome">Cognome:</label>
                <input type="text" class="form-control" id="cognome" name="cognome" required>
            </div>
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="sesso">Sesso:</label>
                <select class="form-control" id="sesso" name="sesso">
                    <option value="M">Maschio</option>
                    <option value="F">Femmina</option>
                </select>
            </div>
            <div class="form-group">
                <label for="data_nascita">Data di Nascita:</label>
                <input type="date" class="form-control" id="data_nascita" name="data_nascita" required>
            </div>
            <div class="form-group">
                <label for="codice_luogo_nascita">Codice Luogo di Nascita:</label>
                <input type="text" class="form-control" id="codice_luogo_nascita" name="codice_luogo_nascita" required>
            </div>
            <div class="form-group">
                <label for="codice_fiscale">Codice Fiscale:</label>
                <input type="text" class="form-control" id="codice_fiscale" name="codice_fiscale" readonly>
            </div>
            <button type="submit" class="btn btn-primary" name="calcola">Calcola Codice Fiscale</button>
        </form>
    </div>

    <div class="alert alert-warning" role="alert" style="margin: 32px; text-align: center;">
        Questo progetto cerca di calcolare il codice fiscale di una persona partendo da questi
        <a href="https://www.agenziaentrate.gov.it/portale/web/guest/schede/istanze/richiesta-ts_cf/informazioni-codificazione-pf"
            target="_blank">criteri dell'Agenzia delle Entrate</a>.<br><br>
        <strong>DISCLAIMER:</strong> Questo è solamente un esercizio di programmazione: non mi riterrò in alcun modo
        responsabile se i risultati forniti risultano errati!
    </div>

    <?php
    
    require_once('./calcola-codice-fiscale-php.php');

    if (isset($_POST['calcola'])) {
        $cognome = $_POST['cognome'];
        $nome = $_POST['nome'];
        $sesso = $_POST['sesso'];
        $data_nascita = $_POST['data_nascita'];
        $codice_luogo_nascita = $_POST['codice_luogo_nascita'];

        // Call the function to calculate the fiscal code
        $codice_fiscale = calcolaCodiceFiscale($cognome, $nome, $sesso, $data_nascita, $codice_luogo_nascita);

        // Display the result
        echo "<script>document.getElementById('codice_fiscale').value = '$codice_fiscale';</script>";
    }
    ?>

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>