<?php
require 'config.php';

// Zoekterm uit de URL (bijv. landen.php?q=ned)
$zoek = "";
if (isset($_GET['q'])) {
    $zoek = $_GET['q'];
}

// Groepfilter uit de URL (bijv. landen.php?groep=B)
$groep = "";
if (isset($_GET['groep'])) {
    $groep = $_GET['groep'];
}

try {
    // Alle landen ophalen met de groep-letter erbij
    $query  = "SELECT landen.id, landen.naam, landen.vlag, groepen.letter ";
    $query .= "FROM landen ";
    $query .= "JOIN groepen ON groepen.id = landen.groep_id ";
    $query .= "WHERE landen.naam LIKE :zoek ";
    if ($groep != "") {
        $query .= "AND groepen.letter = :groep ";
    }
    $query .= "ORDER BY groepen.letter, landen.naam";

    $stmt = $conn->prepare($query);
    $zoekTerm = "%" . $zoek . "%";
    $stmt->bindParam(':zoek', $zoekTerm);
    if ($groep != "") {
        $stmt->bindParam(':groep', $groep);
    }
    $stmt->execute();

    $resultaten = $stmt->fetchAll();
    $aantalRijen = count($resultaten);

    // Alle groepen voor de filterknoppen
    $stmt2 = $conn->prepare("SELECT * FROM groepen ORDER BY letter");
    $stmt2->execute();
    $groepen = $stmt2->fetchAll();

} catch (PDOException $e) {
    echo "<p>FOUT: " . $e->getMessage() . "</p>";
    exit;
}

include 'views/landen_view.php';
