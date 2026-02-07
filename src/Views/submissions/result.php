<?php $title = 'Assessment Result'; ?>
<?php ob_start(); ?>

<div class="result-page">
    <div class="result-header">
        <h1>Assessment Submitted</h1>
        <p class="assessment-title"><?= htmlspecialchars($submission['assessment_title']) ?></p>
    </div>
    
    <div class="result-summary">
        <div class="score-card">
            <h2>Your Score</h2>
            <div class="score">
                <span class="score-obtained"><?= $submission['score'] ?></span>
                <span class="score-divider">/</span>
                <span class="score-total"><?= $submission['total_marks'] ?></span>
            </div>
            <p class="percentage">
                <?= round(($submission['score'] / $submission['total_marks']) * 100, 2) ?>%
            </p>
        </div>
    </div>
    
    <div class="answers-review">
        <h2>Your Answers</h2>
        
        <?php foreach ($answers as $answer): ?>
        <div class="answer-item <?= $answer['is_correct'] ? 'correct' : 'incorrect' ?>">
            <div class="answer-header">
                <span class="question-type"><?= ucfirst($answer['question_type']) ?></span>
                <span class="marks"><?= $answer['marks_obtained'] ?>/<?= $answer['marks'] ?> marks</span>
            </div>
            
            <p class="question-text"><?= nl2br(htmlspecialchars($answer['question_text'])) ?></p>
            
            <?php if ($answer['question_type'] === 'mcq'): ?>
            <div class="answer-given">
                <strong>Your Answer:</strong> <?= htmlspecialchars($answer['answer_text']) ?>
                <?php if ($answer['is_correct']): ?>
                    <span class="badge badge-success">Correct</span>
                <?php else: ?>
                    <span class="badge badge-danger">Incorrect</span>
                <?php endif; ?>
            </div>
            <?php else: ?>
            <div class="essay-answer">
                <strong>Your Answer:</strong>
                <p><?= nl2br(htmlspecialchars($answer['answer_text'])) ?></p>
                <p class="grading-note">Essay questions require manual grading</p>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div class="result-actions">
        <a href="/student/assessments" class="btn btn-primary">Back to Assessments</a>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/main.php'; ?>
