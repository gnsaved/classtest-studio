<?php $title = 'My Assessments'; ?>
<?php ob_start(); ?>

<div class="student-dashboard">
    <div class="page-header">
        <h1>Available Assessments</h1>
    </div>
    
    <div class="search-filter-bar">
        <input type="text" id="searchInput" placeholder="Search assessments..." onkeyup="filterAssessments()">
        <select id="subjectFilter" onchange="filterAssessments()">
            <option value="">All Subjects</option>
            <option value="Mathematics">Mathematics</option>
            <option value="Physics">Physics</option>
            <option value="Chemistry">Chemistry</option>
            <option value="Biology">Biology</option>
            <option value="Computer Science">Computer Science</option>
        </select>
        <select id="statusFilter" onchange="filterAssessments()">
            <option value="">All Status</option>
            <option value="not-started">Not Started</option>
            <option value="in-progress">In Progress</option>
            <option value="submitted">Submitted</option>
        </select>
    </div>
    
    <div class="assessments-grid" id="assessmentsGrid">
        <?php foreach ($assessments as $assessment): ?>
        <div class="assessment-card" data-subject="<?= htmlspecialchars($assessment['subject_name']) ?>" data-status="not-started">
            <h3><?= htmlspecialchars($assessment['title']) ?></h3>
            <div class="assessment-card-body">
                <div class="assessment-status-badge">
                    <span class="badge badge-scheduled">Scheduled</span>
                </div>
                
                <div class="assessment-meta">
                    <div><strong>Subject:</strong> <?= htmlspecialchars($assessment['subject_name']) ?></div>
                    <div><strong>Type:</strong> <?= htmlspecialchars($assessment['exam_type_name']) ?></div>
                    <div><strong>Duration:</strong> <?= $assessment['duration_minutes'] ?> mins</div>
                    <div><strong>Marks:</strong> <?= $assessment['total_marks'] ?></div>
                </div>
                
                <?php if ($assessment['term']): ?>
                    <p style="font-size: 0.85rem; color: var(--text-light); margin-bottom: 1rem;">
                        <?= htmlspecialchars($assessment['term']) ?> • <?= htmlspecialchars($assessment['session']) ?>
                    </p>
                <?php endif; ?>
                
                <a href="/assessment/take/<?= $assessment['id'] ?>" class="btn btn-primary" style="width: 100%;">Start Assessment</a>
            </div>
        </div>
        <?php endforeach; ?>
        
        <?php if (empty($assessments)): ?>
        <div class="empty-state" style="grid-column: 1 / -1;">
            <p>No assessments available at the moment.</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
function filterAssessments() {
    const searchValue = document.getElementById('searchInput').value.toLowerCase();
    const subjectFilter = document.getElementById('subjectFilter').value;
    const statusFilter = document.getElementById('statusFilter').value;
    const cards = document.querySelectorAll('.assessment-card');
    
    cards.forEach(card => {
        const title = card.querySelector('h3').textContent.toLowerCase();
        const subject = card.getAttribute('data-subject');
        const status = card.getAttribute('data-status');
        
        const matchesSearch = title.includes(searchValue);
        const matchesSubject = !subjectFilter || subject === subjectFilter;
        const matchesStatus = !statusFilter || status === statusFilter;
        
        if (matchesSearch && matchesSubject && matchesStatus) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/main.php'; ?>
