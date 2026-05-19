<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quiz – Structures de données</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen font-sans">

  <!-- ===================================================
       TOP BAR
  ==================================================== -->
  <header class="bg-white border-b border-gray-200 px-6 h-14 flex items-center justify-between">

    <div>
      <p class="text-sm font-bold text-gray-900">Structures de données – Module 3</p>
      <!-- PHP: <p ...><?php echo htmlspecialchars($quiz['title']); ?></p> -->
      <p class="text-xs text-gray-400">15 questions</p>
      <!-- PHP: <p ...><?php echo $quiz['question_count']; ?> questions</p> -->
    </div>

    <!-- Back to dashboard -->
    <a href="dashboard.php" class="text-xs text-gray-400 hover:text-gray-600">
      ← Retour
    </a>

  </header>


  <!-- ===================================================
       PAGE CONTENT
  ==================================================== -->
  <main class="max-w-2xl mx-auto px-4 py-6">

    <!-- PHP: <form action="submit_quiz.php" method="POST"> -->
    <form action="submit_quiz.php" method="POST">

      <!-- Hidden quiz ID -->
      <input type="hidden" name="quiz_id" value="1" />
      <!-- PHP: value="<?php echo $quiz['id']; ?>" -->


      <!-- -----------------------------------------------
           PROGRESS BAR
      ------------------------------------------------ -->
      <div class="mb-6">
        <div class="flex justify-between text-xs text-gray-400 mb-1">
          <span>3 réponses sur 15</span>
          <!-- PHP: <span><?php echo $answered; ?> réponses sur <?php echo $total; ?></span> -->
          <span>20%</span>
          <!-- PHP: <span><?php echo round(($answered / $total) * 100); ?>%</span> -->
        </div>
        <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
          <div class="h-2 bg-emerald-500 rounded-full" style="width: 20%"></div>
          <!-- PHP: style="width: <?php echo round(($answered / $total) * 100); ?>%" -->
        </div>
      </div>


      <!-- -----------------------------------------------
           QUESTIONS
           PHP: replace all question blocks below with:

           <?php foreach ($questions as $i => $question): ?>

             <div class="bg-white border border-gray-200 rounded-xl p-5 mb-4">

               <p class="text-xs font-bold text-emerald-600 mb-2">
                 Question <?php echo $i + 1; ?>
               </p>

               <p class="text-sm font-bold text-gray-900 mb-4">
                 <?php echo htmlspecialchars($question['text']); ?>
               </p>

               <div class="space-y-2">
                 <?php foreach ($question['choices'] as $choice): ?>
                   <label class="flex items-center gap-3 border border-gray-200 rounded-lg px-4 py-3 cursor-pointer hover:bg-gray-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50">
                     <input
                       type="radio"
                       name="answer_<?php echo $question['id']; ?>"
                       value="<?php echo $choice['id']; ?>"
                       class="accent-emerald-600 w-4 h-4"
                     />
                     <span class="text-sm text-gray-700">
                       <?php echo htmlspecialchars($choice['text']); ?>
                     </span>
                   </label>
                 <?php endforeach; ?>
               </div>

             </div>

           <?php endforeach; ?>
      ------------------------------------------------ -->


      <!-- ══ Question 1 ══ -->
      <div class="bg-white border border-gray-200 rounded-xl p-5 mb-4">

  <p class="text-xs font-bold text-emerald-600 mb-2">Question 1</p>

  <p class="text-sm font-bold text-gray-900 mb-4">
    Quelle est la complexité temporelle d'une recherche dans un tableau non trié ?
  </p>

  <div class="space-y-2">

    <label class="flex items-center gap-3 border border-gray-200 rounded-lg px-4 py-3 cursor-pointer hover:bg-gray-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50">
      <input type="checkbox" name="answer_1[]" value="A" class="accent-emerald-600 w-4 h-4" />
      <span class="text-sm text-gray-700">O(1)</span>
    </label>

    <label class="flex items-center gap-3 border border-gray-200 rounded-lg px-4 py-3 cursor-pointer hover:bg-gray-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50">
      <input type="checkbox" name="answer_1[]" value="B" class="accent-emerald-600 w-4 h-4" />
      <span class="text-sm text-gray-700">O(log n)</span>
    </label>

    <label class="flex items-center gap-3 border border-gray-200 rounded-lg px-4 py-3 cursor-pointer hover:bg-gray-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50">
      <input type="checkbox" name="answer_1[]" value="C" class="accent-emerald-600 w-4 h-4" />
      <span class="text-sm text-gray-700">O(n)</span>
    </label>

    <label class="flex items-center gap-3 border border-gray-200 rounded-lg px-4 py-3 cursor-pointer hover:bg-gray-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50">
      <input type="checkbox" name="answer_1[]" value="D" class="accent-emerald-600 w-4 h-4" />
      <span class="text-sm text-gray-700">O(n²)</span>
    </label>

  </div>
</div>


      <!-- ══ Question 2 ══ -->
      <div class="bg-white border border-gray-200 rounded-xl p-5 mb-4">

        <p class="text-xs font-bold text-emerald-600 mb-2">Question 2</p>

        <p class="text-sm font-bold text-gray-900 mb-4">
          Quelle structure de données suit le principe LIFO (Last In, First Out) ?
        </p>

        <div class="space-y-2">

          <label class="flex items-center gap-3 border border-gray-200 rounded-lg px-4 py-3 cursor-pointer hover:bg-gray-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50">
            <input type="radio" name="answer_2" value="A" class="accent-emerald-600 w-4 h-4" />
            <span class="text-sm text-gray-700">File (Queue)</span>
          </label>

          <label class="flex items-center gap-3 border border-gray-200 rounded-lg px-4 py-3 cursor-pointer hover:bg-gray-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50">
            <input type="radio" name="answer_2" value="B" class="accent-emerald-600 w-4 h-4" />
            <span class="text-sm text-gray-700">Pile (Stack)</span>
          </label>

          <label class="flex items-center gap-3 border border-gray-200 rounded-lg px-4 py-3 cursor-pointer hover:bg-gray-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50">
            <input type="radio" name="answer_2" value="C" class="accent-emerald-600 w-4 h-4" />
            <span class="text-sm text-gray-700">Tableau (Array)</span>
          </label>

          <label class="flex items-center gap-3 border border-gray-200 rounded-lg px-4 py-3 cursor-pointer hover:bg-gray-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50">
            <input type="radio" name="answer_2" value="D" class="accent-emerald-600 w-4 h-4" />
            <span class="text-sm text-gray-700">Liste chaînée</span>
          </label>

        </div>
      </div>


      <!-- ══ Question 3 ══ -->
      <div class="bg-white border border-gray-200 rounded-xl p-5 mb-4">

        <p class="text-xs font-bold text-emerald-600 mb-2">Question 3</p>

        <p class="text-sm font-bold text-gray-900 mb-4">
          Dans un arbre binaire de recherche, où se trouve la valeur minimale ?
        </p>

        <div class="space-y-2">

          <label class="flex items-center gap-3 border border-gray-200 rounded-lg px-4 py-3 cursor-pointer hover:bg-gray-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50">
            <input type="radio" name="answer_3" value="A" class="accent-emerald-600 w-4 h-4" />
            <span class="text-sm text-gray-700">À la racine</span>
          </label>

          <label class="flex items-center gap-3 border border-gray-200 rounded-lg px-4 py-3 cursor-pointer hover:bg-gray-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50">
            <input type="radio" name="answer_3" value="B" class="accent-emerald-600 w-4 h-4" />
            <span class="text-sm text-gray-700">Dans le sous-arbre droit</span>
          </label>

          <label class="flex items-center gap-3 border border-gray-200 rounded-lg px-4 py-3 cursor-pointer hover:bg-gray-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50">
            <input type="radio" name="answer_3" value="C" class="accent-emerald-600 w-4 h-4" />
            <span class="text-sm text-gray-700">Dans le nœud le plus à gauche</span>
          </label>

          <label class="flex items-center gap-3 border border-gray-200 rounded-lg px-4 py-3 cursor-pointer hover:bg-gray-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50">
            <input type="radio" name="answer_3" value="D" class="accent-emerald-600 w-4 h-4" />
            <span class="text-sm text-gray-700">Dans le nœud le plus à droite</span>
          </label>

        </div>
      </div>


      <!-- -----------------------------------------------
           SUBMIT BUTTON
      ------------------------------------------------ -->
      <div class="mt-6">
        <button
          type="submit"
          class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm py-3 rounded-xl"
        >
          Soumettre le quiz
        </button>
        <p class="text-xs text-center text-gray-400 mt-2">
          Une fois soumis, vous ne pourrez plus modifier vos réponses.
        </p>
      </div>

    </form>

  </main>

</body>
</html>
