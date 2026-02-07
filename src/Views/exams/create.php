<?php $title = 'Create Assessment'; ?>
<?php ob_start(); ?>

<div class="create-assessment">
    <h1>Create New Assessment</h1>
    
    <form method="POST" action="/assessment/create" class="assessment-form">
        <div class="form-group">
            <label for="title">Assessment Title *</label>
            <input type="text" id="title" name="title" required>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="exam_type_id">Exam Type *</label>
                <select id="exam_type_id" name="exam_type_id" required>
                    <option value="">Select Type</option>
                    <?php foreach ($examTypes as $type): ?>
                        <option value="<?= $type['id'] ?>"><?= htmlspecialchars($type['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="subject_id">Subject *</label>
                <select id="subject_id" name="subject_id" required>
                    <option value="">Select Subject</option>
                    <?php foreach ($subjects as $subject): ?>
                        <option value="<?= $subject['id'] ?>"><?= htmlspecialchars($subject['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="term">Term</label>
                <input type="text" id="term" name="term" placeholder="e.g., First Term">
            </div>
            
            <div class="form-group">
                <label for="session">Session</label>
                <input type="text" id="session" name="session" placeholder="e.g., 2023/2024">
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="duration_minutes">Duration (minutes)</label>
                <input type="number" id="duration_minutes" name="duration_minutes" value="60">
            </div>
            
            <div class="form-group">
                <label for="scheduled_at">Schedule For</label>
                <input type="datetime-local" id="scheduled_at" name="scheduled_at">
            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create Assessment</button>
            <a href="/assessments" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/main.php'; ?>
