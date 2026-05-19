<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tableau de bord – Étudiant</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen font-sans">

  <!-- ===================================================
       TOP BAR
  ==================================================== -->
  <header class="bg-white border-b border-gray-200 px-6 h-14 flex items-center justify-between">

    <!-- Logo -->
    <span class="text-emerald-600 font-bold text-lg">🎓 QuizApp</span>

    <!-- Student name + avatar -->
    <div class="flex items-center gap-3 text-sm text-gray-500">

      <span>Bonjour, Ahmed</span>
      <!-- PHP: <span>Bonjour, <?php echo htmlspecialchars($user['name']); ?></span> -->

      <div class="w-8 h-8 rounded-full bg-emerald-100 border border-emerald-200 flex items-center justify-center text-xs font-bold text-emerald-700">
        AH
        <!-- PHP: <?php echo strtoupper(substr($user['name'], 0, 2)); ?> -->
      </div>

    </div>
  </header>


  <!-- ===================================================
       PAGE CONTENT
  ==================================================== -->
  <main class="max-w-3xl mx-auto px-4 py-6 space-y-6">


    <!-- -----------------------------------------------
         STATS ROW
    ------------------------------------------------ -->
    <div class="grid grid-cols-3 gap-3">

      <div class="bg-gray-200 rounded-lg p-4">
        <p class="text-xs text-gray-500 mb-1">Quiz complétés</p>
        <p class="text-2xl font-bold text-gray-900">8</p>
      </div>

      <div class="bg-gray-200 rounded-lg p-4">
        <p class="text-xs text-gray-500 mb-1">Moyenne générale</p>
        <p class="text-2xl font-bold text-gray-900">73%</p>
      </div>

      <div class="bg-gray-200 rounded-lg p-4">
        <p class="text-xs text-gray-500 mb-1">Meilleur score</p>
        <p class="text-2xl font-bold text-gray-900">18/20</p>
      </div>

    </div>


    <!-- -----------------------------------------------
         JOIN QUIZ BY CODE
    ------------------------------------------------ -->
    <div class="bg-white border border-gray-200 rounded-xl p-5">

      <p class="text-sm font-bold text-gray-800">Rejoindre un quiz</p>
      <p class="text-xs text-gray-400 mt-1">Entrez le code fourni par votre formateur</p>

      <!-- PHP: action="join_quiz.php" -->
      <form action="join_quiz.php" method="POST" class="flex gap-2 mt-3">

        <input
          type="text"
          name="code"
          maxlength="6"
          placeholder="ex: A4BX9"
          class="flex-1 border border-gray-300 rounded-lg px-3 py-2 text-sm tracking-widest font-bold text-gray-900 focus:outline-none focus:border-emerald-500"
        />

        <button type="submit" name="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold px-5 py-2 rounded-lg">
          Accéder
        </button>

      </form>
    </div>
    <!-- -----------------------------------------------
         DIVIDER
    ------------------------------------------------ -->
    <hr class="border-gray-200" />


    <!-- -----------------------------------------------
         RECENT RESULTS
         PHP: replace rows with a foreach loop
         <?php foreach ($results as $result): ?> ... <?php endforeach; ?>
    ------------------------------------------------ -->
    <div>
      <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Résultats récents</p>

      <div class="space-y-3">

        <!-- Result – Good score (green) -->
        <div class="bg-white border border-gray-200 rounded-xl px-4 py-3 flex items-center gap-3">

          <div class="w-12 h-12 rounded-full border-2 border-emerald-500 bg-emerald-50 flex flex-col items-center justify-center flex-shrink-0">
            <span class="text-sm font-bold text-emerald-900 leading-none">18</span>
            <!-- PHP: <span ...><?php echo $result['score']; ?></span> -->
            <span class="text-[10px] text-gray-400 leading-none">/20</span>
            <!-- PHP: <span ...>/<?php echo $result['total']; ?></span> -->
          </div>

          <div class="flex-1">
            <p class="text-sm font-bold text-gray-900">Algorithmique avancée</p>
            <!-- PHP: <p ...><?php echo htmlspecialchars($result['quiz_title']); ?></p> -->
            <p class="text-xs text-gray-400 mt-0.5">12 mai 2025</p>
            <!-- PHP: <p ...><?php echo $result['submitted_at']; ?></p> -->

            <div class="w-28 h-1.5 bg-gray-200 rounded-full mt-2 overflow-hidden">
              <div class="h-1.5 bg-emerald-500 rounded-full" style="width: 90%"></div>
              <!-- PHP: style="width: <?php echo $result['percentage']; ?>%" -->
            </div>
          </div>

          <span class="text-xs font-bold px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 flex-shrink-0">
            90%
            <!-- PHP: <?php echo $result['percentage']; ?>% -->
          </span>

        </div>


        <!-- Result – Medium score (yellow) -->
        <div class="bg-white border border-gray-200 rounded-xl px-4 py-3 flex items-center gap-3">

          <div class="w-12 h-12 rounded-full border-2 border-yellow-400 bg-yellow-50 flex flex-col items-center justify-center flex-shrink-0">
            <span class="text-sm font-bold text-yellow-900 leading-none">13</span>
            <span class="text-[10px] text-gray-400 leading-none">/20</span>
          </div>

          <div class="flex-1">
            <p class="text-sm font-bold text-gray-900">Réseaux – Couche TCP/IP</p>
            <p class="text-xs text-gray-400 mt-0.5">8 mai 2025</p>
            <div class="w-28 h-1.5 bg-gray-200 rounded-full mt-2 overflow-hidden">
              <div class="h-1.5 bg-yellow-400 rounded-full" style="width: 65%"></div>
            </div>
          </div>

          <span class="text-xs font-bold px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 flex-shrink-0">
            65%
          </span>

        </div>


        <!-- Result – Low score (red) -->
        <div class="bg-white border border-gray-200 rounded-xl px-4 py-3 flex items-center gap-3">

          <div class="w-12 h-12 rounded-full border-2 border-red-400 bg-red-50 flex flex-col items-center justify-center flex-shrink-0">
            <span class="text-sm font-bold text-red-900 leading-none">7</span>
            <span class="text-[10px] text-gray-400 leading-none">/20</span>
          </div>

          <div class="flex-1">
            <p class="text-sm font-bold text-gray-900">Programmation orientée objet</p>
            <p class="text-xs text-gray-400 mt-0.5">2 mai 2025</p>
            <div class="w-28 h-1.5 bg-gray-200 rounded-full mt-2 overflow-hidden">
              <div class="h-1.5 bg-red-400 rounded-full" style="width: 35%"></div>
            </div>
          </div>

          <span class="text-xs font-bold px-3 py-1 rounded-full bg-red-100 text-red-700 flex-shrink-0">
            35%
          </span>

        </div>

      </div>
    </div>

  </main>

</body>
</html>
