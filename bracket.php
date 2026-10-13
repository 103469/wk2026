<?php
require 'config.php';

try {
    $stmt = $conn->prepare("SELECT * FROM groepen ORDER BY letter");
    $stmt->execute();
    $groepen = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "<p>FOUT: " . $e->getMessage() . "</p>";
    exit;
}

// Punten per groep berekenen
$groepStanden = [];

foreach ($groepen as $groep) {

    // Landen van deze groep ophalen
    $stmt = $conn->prepare("SELECT * FROM landen WHERE groep_id = :groepID");
    $stmt->bindParam(':groepID', $groep['id']);
    $stmt->execute();
    $landen = $stmt->fetchAll();

    // Elk land begint op 0 punten
    $punten = [];
    $vlaggen = [];
    foreach ($landen as $land) {
        $punten[$land['naam']] = 0;
        $vlaggen[$land['naam']] = $land['vlag'];
    }

    // Alle wedstrijden van deze groep ophalen
    $query  = "SELECT wedstrijden.*, l1.naam AS naam1, l2.naam AS naam2 ";
    $query .= "FROM wedstrijden ";
    $query .= "JOIN landen l1 ON l1.id = wedstrijden.land1_id ";
    $query .= "JOIN landen l2 ON l2.id = wedstrijden.land2_id ";
    $query .= "WHERE l1.groep_id = :groepID";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':groepID', $groep['id']);
    $stmt->execute();
    $duels = $stmt->fetchAll();

    // Punten uitdelen
    foreach ($duels as $duel) {
        // Nog niet gespeeld? Dan geen punten (anders telt het als gelijkspel)
        if ($duel['doelpunten1'] === null || $duel['doelpunten2'] === null) {
            continue;
        }

        $team1 = $duel['naam1'];
        $team2 = $duel['naam2'];

        if ($duel['doelpunten1'] > $duel['doelpunten2']) {
            $punten[$team1] = $punten[$team1] + 3;
        } elseif ($duel['doelpunten2'] > $duel['doelpunten1']) {
            $punten[$team2] = $punten[$team2] + 3;
        } else {
            $punten[$team1] = $punten[$team1] + 1;
            $punten[$team2] = $punten[$team2] + 1;
        }
    }

    // Sorteren op punten (hoog naar laag)
    arsort($punten);

    $groepStanden[] = [
        'letter'  => $groep['letter'],
        'punten'  => $punten,
        'vlaggen' => $vlaggen
    ];
}

include 'views/bracket_view.php';
