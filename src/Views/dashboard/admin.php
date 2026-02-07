<?php $title = 'Dashboard'; ?>
<?php ob_start(); ?>

<div class="dashboard">
    <div class="page-header">
        <h1>Assessment Dashboard</h1>
        <a href="/assessment/create" class="btn btn-success btn-sm">+ Create New Assessment</a>
    </div>
    
    <div class="stats-container">
        <div class="stats-grid">
            <div class="stat-box">
                <span class="stat-value"><?= $stats['total_assessments'] ?></span>
                <span class="stat-label">Total Assessments</span>
            </div>
            <div class="stat-box">
                <span class="stat-value"><?= $stats['published_assessments'] ?></span>
                <span class="stat-label">Published</span>
            </div>
            <div class="stat-box">
                <span class="stat-value"><?= $stats['total_submissions'] ?></span>
                <span class="stat-label">Total Submissions</span>
            </div>
            <div class="stat-box">
                <span class="stat-value"><?= $stats['total_students'] ?></span>
                <span class="stat-label">Active Students</span>
            </div>
        </div>
    </div>
    
    <div class="table-container">
        <div class="table-header">
            <span>Recent Assessments</span>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Assessment Title</th>
                    <th>Subject</th>
                    <th>Type</th>
                    <th>Term/Session</th>
                    <th>Status</th>
                    <th>Total Marks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentAssessments as $assessment): ?>
                <tr>
                    <td><strong><?= htmlspecialchars($assessment['title']) ?></strong></td>
                    <td><?= htmlspecialchars($assessment['subject_name']) ?></td>
                    <td><?= htmlspecialchars($assessment['exam_type_name']) ?></td>
                    <td><?= htmlspecialchars($assessment['term'] ?? '-') ?></td>
                    <td>
                        <span class="badge badge-<?= $assessment['status'] ?>">
                            <?= ucfirst($assessment['status']) ?>
                        </span>
                    </td>
                    <td><?= $assessment['total_marks'] ?></td>
                    <td>
                        <a href="/assessment/edit/<?= $assessment['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                        <?php if ($assessment['status'] === 'published'): ?>
                            <a href="/results/<?= $assessment['id'] ?>" class="btn btn-sm btn-success">Results</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/main.php'; ?>
