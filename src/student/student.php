<?php
$conn = new PDO("mysql:host=localhost;dbname=EduQuiz","root","");

function getTotalQuizes($connect , $student_id){
    $sql = " SELECT COUNT(*) AS ttl FROM results WHERE student_id = ". $student_id;
    $res = $connect->query($sql);
    $result = $res->fetch();

    return (int) $result['ttl'];
}
function getAverageScore($connect , $student_id){
    $sql = " SELECT AVG(score) AS average FROM results WHERE student_id = ". $student_id;
    $result = $connect->query($sql);
    $avg = $result->fetch();
    return round($avg['average'], 2);
}
function getHighestScore($connect , $student_id){
    $sql = " SELECT MAX(score) AS highest_score FROM results WHERE student_id = ". $student_id;
    $result = $connect->query($sql);
    $score = $result->fetch();

    return $score['highest_score'];
}
function quizExists($connect, $code) {
    $sql = " SELECT COUNT(*) AS total FROM quizes WHERE quiz_code = ".$code;

    $result = $connect->query($sql);
    $row = $result->fetch();

    if ($row['total'] > 0) {
        $_SESSION['quiz_code'] = $code;
        return true;
    }

    return false;
}
function joinQuizByCode(){
    if(isset($submit) && empty($code)){

    }
}
function getAllPastQuizes($connect, int $student_id){
    // 1. Use prepared statement to avoid SQL injection
    // 2. Fixed table name: quizzes (not quizes)
    // 3. Added question count and total questions for percentage calculation
    $sql = " SELECT r.score, q.title, (SELECT COUNT(*) FROM questions WHERE quiz_id = q.id) AS total_questions FROM results r JOIN quizzes q ON r.quiz_id = q.id WHERE r.student_id = :student_id ORDER BY r.id DESC ";
 
    $stmt = $connect->prepare($sql);
    $stmt->execute([':student_id' => $student_id]);
    $pastres = $stmt->fetchAll();
 
    if (empty($pastres)) {
        echo '<p class="text-sm text-gray-400 text-center py-6">Aucune tentative pour le moment.</p>';
        return;
    }
 
    foreach ($pastres as $resu) {
 
        $total      = (int) $resu['total_questions'];
        $score      = (float) $resu['score']; //nmbr of correct questions
        $percentage = $total > 0 ? round(($score / $total) * 100) : 0;
 
        if ($percentage >= 70) {
            $circle_border = 'border-emerald-500';
            $circle_bg     = 'bg-emerald-50';
            $circle_text   = 'text-emerald-900';
            $bar_color     = 'bg-emerald-500';
            $badge_bg      = 'bg-emerald-100';
            $badge_text    = 'text-emerald-700';
        } elseif ($percentage >= 50) {
            $circle_border = 'border-yellow-400';
            $circle_bg     = 'bg-yellow-50';
            $circle_text   = 'text-yellow-900';
            $bar_color     = 'bg-yellow-400';
            $badge_bg      = 'bg-yellow-100';
            $badge_text    = 'text-yellow-700';
        } else {
            $circle_border = 'border-red-400';
            $circle_bg     = 'bg-red-50';
            $circle_text   = 'text-red-900';
            $bar_color     = 'bg-red-400';
            $badge_bg      = 'bg-red-100';
            $badge_text    = 'text-red-700';
        }
 
        // Use heredoc (not backticks) for multiline HTML strings
        // htmlspecialchars() prevents XSS on any user-provided text
        echo "
        <div class='bg-white border border-gray-200 rounded-xl px-4 py-3 flex items-center gap-3'>
 
            <div class='w-12 h-12 rounded-full border-2 {$circle_border} {$circle_bg} flex flex-col items-center justify-center flex-shrink-0'>
                <span class='text-sm font-bold {$circle_text} leading-none'>{$score}</span>
                <span class='text-[10px] text-gray-400 leading-none'>/{$total}</span>
            </div>
 
            <div class='flex-1'>
                <p class='text-sm font-bold text-gray-900'>" .$resu['title'] . "</p>
                <div class='w-28 h-1.5 bg-gray-200 rounded-full mt-2 overflow-hidden'>
                    <div class='h-1.5 {$bar_color} rounded-full' style='width:{$percentage}%'></div>
                </div>
            </div>
 
            <span class='text-xs font-bold px-3 py-1 rounded-full {$badge_bg} {$badge_text} flex-shrink-0'>
                {$percentage}%
            </span>
 
        </div>";
    }
}

function startQuize($connect, int $student_id){


}

function displayQuizQuestions( $connect, int $quiz_id) {
    $stmt = $connect->prepare(" SELECT id, question FROM questions WHERE quiz_id = :quiz_id ORDER BY id ASC");
    $stmt->execute([':quiz_id' => $quiz_id]);
    $questions = $stmt->fetchAll();
    foreach ($questions as $index => $q) {
        $question_number = $index + 1;
        $question_id     = $q['id'];
        $stmt2 = $connect->prepare(" SELECT id, option_text FROM reponces WHERE question_id = :question_id ORDER BY id ASC ");
        $stmt2->execute([':question_id' => $question_id]);
        $choices = $stmt2->fetchAll();
        // ── Question card ──
        echo "
        <div class='bg-white border border-gray-200 rounded-xl p-5 mb-4'>
            <p class='text-xs font-bold text-emerald-600 mb-2'>Question {$question_number}</p>
            <p class='text-sm font-bold text-gray-900 mb-4'>" . $q['question'] . "</p>
            <div class='space-y-2'>";
                foreach ($choices as $choice) {
                    $choice_id   = $choice['id'];
                    $choice_text = htmlspecialchars($choice['option_text']);
                    echo "
                    <label class='flex items-center gap-3 border border-gray-200 rounded-lg px-4 py-3 cursor-pointer hover:bg-gray-50 has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50'>
                        <input type='checkbox' name='answer_{$question_id}[]' value='{$choice_id}' class='accent-emerald-600 w-4 h-4' />
                        <span class='text-sm text-gray-700'>{$choice_text}</span>
                    </label>";
                }
        echo " </div> </div>";
    }
}
 