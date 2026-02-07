<?php
$user = \ClassTest\Helpers\Auth::user();
$currentPage = $_SERVER['REQUEST_URI'];
?>

<nav class="navbar">
    <div class="navbar-top">
        <div class="navbar-brand">
            <h1>ðŸ“š ClassTest Studio</h1>
        </div>
        
        <div class="navbar-user">
            <span><?= htmlspecialchars($user['name']) ?></span>
            <span style="opacity: 0.7; font-size: 0.8rem;">(<?= ucfirst($user['role']) ?>)</span>
            <a href="/logout" class="btn-logout">Logout</a>
        </div>
    </div>
    
    <?php if ($user['role'] === 'admin'): ?>
    <div class="navbar-tabs">
        <a href="/dashboard" class="<?= strpos($currentPage, '/dashboard') !== false ? 'active' : '' ?>">Dashboard</a>
        <a href="/assessments" class="<?= strpos($currentPage, '/assessment') !== false ? 'active' : '' ?>">Assessments</a>
        <a href="/assessment/create">Create New</a>
    </div>
    <?php endif; ?>
</nav>
