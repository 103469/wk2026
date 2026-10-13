<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bracket - WK 2026 Hub</title>
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
                <a href="landen.php" class="px-3 py-2 rounded text-gray-300 hover:bg-white/10 hover:text-white">Landen</a>
                <a href="bracket.php" class="px-3 py-2 rounded bg-green-600 text-white">Bracket</a>
            </nav>
        </div>
    </header>

    <!-- Stadionfoto als achtergrond met donkere overlay -->
    <section class="relative bg-cover bg-center bg-fixed min-h-screen"
             style="background-image: url('img/stadion.webp');">
        <div class="absolute inset-0 bg-blue-950/40"></div>

        <main class="relative z-10 max-w-5xl mx-auto px-4 pb-12">

            <h1 class="text-4xl text-white mt-6">Groepsstanden</h1>
            <p class="text-gray-200 mt-1">
                De nummers 1 en 2 van elke groep gaan door, plus de 8 beste nummers 3.
                De uitslagen zijn voorbeelddata.
            </p>

            <!-- De stand per groep -->
            <section class="mt-5 grid grid-cols-1 md:grid-cols-3 gap-4">
                <?php foreach ($groepStanden as $stand) { ?>
                    <div class="bg-white border border-gray-300 rounded-xl p-5 shadow-lg">
                        <h2 class="text-xl text-blue-950 mb-3">Groep <?= $stand['letter'] ?></h2>
                        <?php $positie = 1; ?>
                        <?php foreach ($stand['punten'] as $team => $aantalPunten) { ?>
                            <div class="flex items-center gap-2 py-1.5 border-t border-gray-200">
                                <span class="w-6 h-6 rounded-full text-xs font-bold text-white flex items-center justify-center <?php if ($positie <= 2) echo 'bg-green-600'; else echo 'bg-gray-500'; ?>">
                                    <?= $positie ?>
                                </span>
                                <img src="<?= $stand['vlaggen'][$team] ?>" alt="" width="24" height="18" class="w-6 h-[18px] object-cover">
                                <span><?= $team ?></span>
                                <span class="ml-auto text-gray-500 font-bold"><?= $aantalPunten ?> pnt</span>
                            </div>
                            <?php $positie = $positie + 1; ?>
                        <?php } ?>
                    </div>
                <?php } ?>
            </section>
        </main>
    </section>

    <footer class="bg-blue-950 text-gray-300 text-center text-sm py-8">
        WK 2026 Hub · gemaakt met HTML, Tailwind CSS, PHP en SQLite
    </footer>

</body>
</html>

