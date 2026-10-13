<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Land - WK 2026</title>
    <link href="output.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        h1, h2, h3, .logo { font-family: 'Anton', sans-serif; }
    </style>
</head>
<body class="bg-blue-950 text-gray-800">

    <!-- Navigatiebalk -->
    <header class="bg-blue-950 sticky top-0 z-20">
        <div class="max-w-5xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="index.html" class="logo text-2xl text-white">⚽ WK <span class="text-amber-400">2026</span></a>
            <nav class="flex gap-2 text-sm font-semibold">
                <a href="index.html" class="px-3 py-2 rounded text-gray-300 hover:bg-white/10 hover:text-white">Home</a>
                <a href="landen.php" class="px-3 py-2 rounded bg-green-600 text-white">Landen</a>
                <a href="bracket.php" class="px-3 py-2 rounded text-gray-300 hover:bg-white/10 hover:text-white">Bracket</a>
            </nav>
        </div>
    </header>

    <!-- Stadionfoto als achtergrond met donkere overlay -->
    <section class="relative bg-cover bg-center bg-fixed min-h-screen"
             style="background-image: url('img/stadion.webp');">
        <div class="absolute inset-0 bg-blue-950/40"></div>

        <main class="relative z-10 max-w-5xl mx-auto px-4 pb-12">

            <?php if ($aantalRijen > 0) { ?>
                <?php $rij = $resultaten[0]; ?>

                <!-- Koptegel: vlag, naam, ranking, groep -->
                <section class="mt-6 bg-white border border-gray-300 rounded-xl p-6 flex items-center gap-6 flex-wrap shadow-lg">
                    <img src="<?= $rij['vlag'] ?>" alt="Vlag van <?= $rij['naam'] ?>" width="80" height="60" class="w-20 h-[60px] object-cover rounded shadow bg-gray-100">
                    <div>
                        <h1 class="text-4xl text-blue-950"><?= $rij['naam'] ?></h1>
                        <p class="text-gray-500">FIFA-ranking: <?= $rij['ranking'] ?></p>
                        <span class="inline-block mt-2 bg-amber-400 text-blue-950 font-bold px-3 py-1 rounded-full">
                            Groep <?= $rij['letter'] ?>
                        </span>
                    </div>
                </section>

                <!-- Wedstrijden -->
                <h2 class="text-2xl text-white mt-8 mb-3">Wedstrijden</h2>
                <div class="overflow-x-auto">
                <table class="w-full bg-white border border-gray-300 rounded-xl overflow-hidden shadow-lg">
                    <tr class="bg-blue-950 text-white text-left text-sm">
                        <th class="px-4 py-3">Datum</th>
                        <th class="px-4 py-3">Duel</th>
                        <th class="px-4 py-3">Stadion</th>
                        <th class="px-4 py-3">Uitslag</th>
                    </tr>
                    <?php foreach ($wedstrijden as $wedstrijd) { ?>
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-3"><?= $wedstrijd['datum'] ?></td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center gap-2">
                                    <img src="<?= $wedstrijd['vlag1'] ?>" alt="" width="24" height="18" class="w-6 h-[18px] object-cover"> <?= $wedstrijd['naam1'] ?>
                                    -
                                    <?= $wedstrijd['naam2'] ?> <img src="<?= $wedstrijd['vlag2'] ?>" alt="" width="24" height="18" class="w-6 h-[18px] object-cover">
                                </span>
                            </td>
                            <td class="px-4 py-3"><?= $wedstrijd['stadion'] ?></td>
                            <td class="px-4 py-3 font-bold text-blue-950"><?= $wedstrijd['doelpunten1'] ?> - <?= $wedstrijd['doelpunten2'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
                </div>

                <a href="landen.php" class="inline-block mt-6 bg-white border-2 border-green-600 text-green-700 font-bold px-4 py-2 rounded-lg hover:bg-green-600 hover:text-white shadow-lg">
                    ‹ Terug naar de landen
                </a>

            <?php } else { ?>
                <p class="bg-white border border-gray-300 rounded-xl p-6 mt-6">
                    Geen land gevonden.
                    <a href="landen.php" class="text-green-700 font-bold underline">Terug naar de landen</a>
                </p>
            <?php } ?>
        </main>
    </section>

    <footer class="bg-blue-950 text-gray-300 text-center text-sm py-8">
        WK 2026 · gemaakt met HTML, Tailwind CSS, PHP en SQLite
    </footer>

</body>
</html>

