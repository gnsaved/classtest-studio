<?php $title = 'Results Summary'; ?>
<?php ob_start(); ?>

<div class="results-page">
    <div class="results-header">
        <h1>Results Summary</h1>
        <h2><?= htmlspecialchars($assessment['title']) ?></h2>
    </div>
    
    <div class="stats-summary">
        <div class="stat-card">
            <h3><?= $stats['total_submissions'] ?? 0 ?></h3>
            <p>Total Submissions</p>
        </div>
        
        <div class="stat-card">
            <h3><?= round($stats['average_score'] ?? 0, 2) ?></h3>
            <p>Average Score</p>
        </div>
        
        <div class="stat-card">
            <h3><?= $stats['highest_score'] ?? 0 ?></h3>
            <p>Highest Score</p>
        </div>
        
        <div class="stat-card">
            <h3><?= $stats['lowest_score'] ?? 0 ?></h3>
            <p>Lowest Score</p>
        </div>
    </div>
    
    <div class="results-table">
        <div class="table-actions">
            <h2>Submissions</h2>
            <a href="/results/export/<?= $assessment['id'] ?>" class="btn btn-success">Export to CSV</a>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Score</th>
                    <th>Percentage</th>
                    <th>Submitted At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($submissions as $submission): ?>
                <tr>
                    <td><?= htmlspecialchars($submission['user_name']) ?></td>
                    <td><?= htmlspecialchars($submission['user_email']) ?></td>
                    <td><?= $submission['score'] ?> / <?= $submission['total_marks'] ?></td>
                    <td>
                        <?php 
                        $percentage = ($submission['score'] / $submission['total_marks']) * 100;
                        $class = $percentage >= 70 ? 'success' : ($percentage >= 50 ? 'warning' : 'danger');
                        ?>
                        <span class="badge badge-<?= $class ?>">
                            <?= round($percentage, 2) ?>%
                        </span>
                    </td>
                    <td><?= date('M d, Y h:i A', strtotime($submission['submitted_at'])) ?></td>
                    <td>
                        <a href="/submission/result/<?= $submission['id'] ?>" class="btn btn-sm">View</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <?php if (empty($submissions)): ?>
        <div class="empty-state">
            <p>No submissions yet.</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/main.php'; ?>
