<?php $title = 'Edit Assessment'; ?>
<?php ob_start(); ?>

<div class="edit-assessment">
    <div class="assessment-header">
        <h1><?= htmlspecialchars($assessment['title']) ?></h1>
        <div class="header-actions">
            <span class="badge badge-<?= $assessment['status'] ?>">
                <?= ucfirst($assessment['status']) ?>
            </span>
            <?php if ($assessment['status'] === 'draft'): ?>
                <a href="/assessment/publish/<?= $assessment['id'] ?>" class="btn btn-success">Publish</a>
            <?php endif; ?>
            <a href="/assessment/view/<?= $assessment['id'] ?>" class="btn btn-secondary">Preview</a>
        </div>
    </div>
    
    <div class="assessment-info">
        <p><strong>Subject:</strong> <?= htmlspecialchars($assessment['subject_name']) ?></p>
        <p><strong>Type:</strong> <?= htmlspecialchars($assessment['exam_type_name']) ?></p>
        <p><strong>Duration:</strong> <?= $assessment['duration_minutes'] ?> minutes</p>
        <p><strong>Total Marks:</strong> <?= $assessment['total_marks'] ?></p>
    </div>
    
    <div class="sections-container">
        <h2>Sections</h2>
        
        <button class="btn btn-primary" onclick="showAddSectionModal()">Add Section</button>
        
        <?php foreach ($sections as $section): ?>
        <div class="section-card">
            <h3><?= htmlspecialchars($section['title']) ?> 
                <span class="section-type">(<?= ucfirst($section['section_type']) ?>)</span>
            </h3>
            
            <?php if ($section['description']): ?>
                <p class="section-description"><?= htmlspecialchars($section['description']) ?></p>
            <?php endif; ?>
            
            <div class="questions-list">
                <?php foreach ($section['questions'] as $index => $question): ?>
                <div class="question-item">
                    <div class="question-header">
                        <span class="question-number">Q<?= $index + 1 ?></span>
                        <span class="question-marks"><?= $question['marks'] ?> marks</span>
                    </div>
                    <p class="question-text"><?= nl2br(htmlspecialchars($question['question_text'])) ?></p>
                    
                    <?php if ($question['question_type'] === 'mcq' && $question['options']): ?>
                    <div class="mcq-options">
                        <?php foreach ($question['options'] as $key => $option): ?>
                        <div class="option">
                            <input type="radio" disabled <?= $question['correct_answer'] === $key ? 'checked' : '' ?>>
                            <label><?= htmlspecialchars($option) ?></label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            
            <button class="btn btn-sm" onclick="showAddQuestionModal(<?= $section['id'] ?>)">
                Add Question
            </button>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div id="addSectionModal" class="modal" style="display:none;">
    <div class="modal-content">
        <h2>Add Section</h2>
        <form id="addSectionForm">
            <input type="hidden" name="assessment_id" value="<?= $assessment['id'] ?>">
            
            <div class="form-group">
                <label>Section Title</label>
                <input type="text" name="title" required>
            </div>
            
            <div class="form-group">
                <label>Description</label>
                <textarea name="description"></textarea>
            </div>
            
            <div class="form-group">
                <label>Section Type</label>
                <select name="section_type" required>
                    <option value="mcq">Multiple Choice</option>
                    <option value="essay">Essay/Written</option>
                    <option value="mixed">Mixed</option>
                </select>
            </div>
            
            <div class="modal-actions">
                <button type="submit" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal('addSectionModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<div id="addQuestionModal" class="modal" style="display:none;">
    <div class="modal-content">
        <h2>Add Question</h2>
        <form id="addQuestionForm">
            <input type="hidden" name="section_id" id="question_section_id">
            <input type="hidden" name="assessment_id" value="<?= $assessment['id'] ?>">
            
            <div class="form-group">
                <label>Question Type</label>
                <select name="question_type" id="question_type" onchange="toggleQuestionType()" required>
                    <option value="mcq">Multiple Choice</option>
                    <option value="essay">Essay</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Question Text</label>
                <textarea name="question_text" required></textarea>
            </div>
            
            <div class="form-group">
                <label>Marks</label>
                <input type="number" name="marks" required min="1">
            </div>
            
            <div id="mcqOptions" style="display:none;">
                <div class="form-group">
                    <label>Option A</label>
                    <input type="text" name="options[a]">
                </div>
                <div class="form-group">
                    <label>Option B</label>
                    <input type="text" name="options[b]">
                </div>
                <div class="form-group">
                    <label>Option C</label>
                    <input type="text" name="options[c]">
                </div>
                <div class="form-group">
                    <label>Option D</label>
                    <input type="text" name="options[d]">
                </div>
                <div class="form-group">
                    <label>Correct Answer</label>
                    <select name="correct_answer">
                        <option value="a">A</option>
                        <option value="b">B</option>
                        <option value="c">C</option>
                        <option value="d">D</option>
                    </select>
                </div>
            </div>
            
            <div class="modal-actions">
                <button type="submit" class="btn btn-primary">Add Question</button>
                <button type="button" class="btn btn-secondary" onclick="closeModal('addQuestionModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function showAddSectionModal() {
    document.getElementById('addSectionModal').style.display = 'block';
}

function showAddQuestionModal(sectionId) {
    document.getElementById('question_section_id').value = sectionId;
    document.getElementById('addQuestionModal').style.display = 'block';
    toggleQuestionType();
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

function toggleQuestionType() {
    const type = document.getElementById('question_type').value;
    document.getElementById('mcqOptions').style.display = type === 'mcq' ? 'block' : 'none';
}

document.getElementById('addSectionForm').onsubmit = async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    const response = await fetch('/assessment/add-section', {
        method: 'POST',
        body: formData
    });
    
    if (response.ok) {
        location.reload();
    }
};

document.getElementById('addQuestionForm').onsubmit = async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    const response = await fetch('/assessment/add-question', {
        method: 'POST',
        body: formData
    });
    
    if (response.ok) {
        location.reload();
    }
};
</script>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/main.php'; ?>
