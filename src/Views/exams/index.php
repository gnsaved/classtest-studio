<?php $title = 'Assessments'; ?>
<?php ob_start(); ?>

<div class="assessments-page">
    <div class="page-header">
        <h1>All Assessments</h1>
        <a href="/assessment/create" class="btn btn-primary">Create New Assessment</a>
    </div>
    
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Subject</th>
                <th>Type</th>
                <th>Term</th>
                <th>Status</th>
                <th>Total Marks</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assessments as $assessment): ?>
            <tr>
                <td><?= htmlspecialchars($assessment['title']) ?></td>
                <td><?= htmlspecialchars($assessment['subject_name']) ?></td>
                <td><?= htmlspecialchars($assessment['exam_type_name']) ?></td>
                <td><?= htmlspecialchars($assessment['term'] ?? 'N/A') ?></td>
                <td>
                    <span class="badge badge-<?= $assessment['status'] ?>">
                        <?= ucfirst($assessment['status']) ?>
                    </span>
                </td>
                <td><?= $assessment['total_marks'] ?></td>
                <td><?= date('M d, Y', strtotime($assessment['created_at'])) ?></td>
                <td>
                    <a href="/assessment/edit/<?= $assessment['id'] ?>" class="btn btn-sm">Edit</a>
                    <?php if ($assessment['status'] === 'published'): ?>
                        <a href="/results/<?= $assessment['id'] ?>" class="btn btn-sm btn-success">Results</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php $content = ob_get_clean(); ?>
<?php require __DIR__ . '/../layouts/main.php'; ?>
