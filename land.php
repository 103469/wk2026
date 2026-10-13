<?php
require 'config.php';

// ID uit de URL (bijv. land.php?ID=21)
$ID = "";
if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
}

try {
    // 1. Het land ophalen met de groep-letter erbij
    $query  = "SELECT landen.*, groepen.letter ";
    $query .= "FROM landen ";
    $query .= "JOIN groepen ON groepen.id = landen.groep_id ";
    $query .= "WHERE landen.id = :ID";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':ID', $ID);
    $stmt->execute();

    $resultaten = $stmt->fetchAll();
    $aantalRijen = count($resultaten);

    // 2. De wedstrijden van dit land ophalen
    $query2  = "SELECT wedstrijden.*, ";
    $query2 .= "l1.naam AS naam1, l1.vlag AS vlag1, ";
    $query2 .= "l2.naam AS naam2, l2.vlag AS vlag2 ";
    $query2 .= "FROM wedstrijden ";
    $query2 .= "JOIN landen l1 ON l1.id = wedstrijden.land1_id ";
    $query2 .= "JOIN landen l2 ON l2.id = wedstrijden.land2_id ";
    $query2 .= "WHERE wedstrijden.land1_id = :ID1 OR wedstrijden.land2_id = :ID2 ";
    $query2 .= "ORDER BY wedstrijden.datum";

    $stmt2 = $conn->prepare($query2);
    $stmt2->bindParam(':ID1', $ID);
    $stmt2->bindParam(':ID2', $ID);
    $stmt2->execute();
    $wedstrijden = $stmt2->fetchAll();

} catch (PDOException $e) {
    echo "<p>FOUT: " . $e->getMessage() . "</p>";
    exit;
}

include 'views/land_view.php';
