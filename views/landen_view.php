<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landen - WK 2026 Hub</title>
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

            <h1 class="text-4xl text-white mt-6">Deelnemende landen</h1>
            <p class="text-gray-200 mt-1">Klik op een land voor de groep en alle wedstrijden.</p>

            <!-- Zoekbalk -->
            <form action="landen.php" method="GET" class="mt-4">
                <input type="hidden" name="groep" value="<?= $groep ?>">
                <input type="text" name="q" value="<?= $zoek ?>" placeholder="🔍 Zoek een land..."
                       class="w-full bg-white border border-gray-300 rounded-xl px-5 py-3 outline-none focus:border-green-600">
            </form>

            <div class="mt-5 flex flex-col md:flex-row gap-5">

                <!-- Filterkolom links -->
                <aside class="md:w-44 bg-white border border-gray-300 rounded-xl p-4 h-fit">
                    <p class="font-bold text-sm text-gray-500 mb-2">Filter op groep</p>
                    <div class="flex md:flex-col gap-2 flex-wrap">
                        <a href="landen.php" class="px-3 py-2 rounded text-sm <?php if ($groep == "") echo 'bg-blue-950 text-white'; else echo 'hover:bg-gray-100'; ?>">Alle</a>
                        <?php foreach ($groepen as $g) { ?>
                            <a href="landen.php?groep=<?= $g['letter'] ?>" class="px-3 py-2 rounded text-sm <?php if ($groep == $g['letter']) echo 'bg-blue-950 text-white'; else echo 'hover:bg-gray-100'; ?>">Groep <?= $g['letter'] ?></a>
                        <?php } ?>
                    </div>
                </aside>

                <!-- Landkaartjes -->
                <section class="flex-1 grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                    <?php if ($aantalRijen > 0) { ?>
                        <?php foreach ($resultaten as $rij) { ?>
                            <a href="land.php?ID=<?= $rij['id'] ?>"
                               class="bg-white border border-gray-300 rounded-xl p-5 hover:shadow-lg hover:-translate-y-1 transition">
                                <img src="<?= $rij['vlag'] ?>" alt="Vlag van <?= $rij['naam'] ?>" width="40" height="30" class="w-10 h-[30px] object-cover rounded-sm shadow bg-gray-100">
                                <p class="font-bold text-blue-950 mt-2"><?= $rij['naam'] ?></p>
                                <span class="inline-block mt-1 text-xs font-bold text-green-700 bg-green-100 px-2 py-1 rounded-full">
                                    Groep <?= $rij['letter'] ?>
                                </span>
                            </a>
                        <?php } ?>
                    <?php } else { ?>
                        <p class="text-gray-200 col-span-full">Geen resultaten gevonden</p>
                    <?php } ?>
                </section>

            </div>
        </main>
    </section>

    <footer class="bg-blue-950 text-gray-300 text-center text-sm py-8">
        WK 2026 Hub · gemaakt met HTML, Tailwind CSS, PHP en SQLite
    </footer>

</body>
</html>

