<?= $this->extend('dashboard/layout') ?>

<?= $this->section('content') ?>
<div class="header-card">
    <div class="header-text">
        <h1>Welcome back, Elizabeth Addams!</h1>
        <p>Your profile is 25% complete. Take tests for better teamwork.</p>
        <div class="header-actions">
            <button class="btn btn-primary">Take Color profiling test</button>
            <button class="btn btn-secondary">Take Core test</button>
        </div>
    </div>
    <img src="https://via.placeholder.com/80" alt="Profile" class="header-avatar">
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon teams">👥</div>
        <div class="stat-info">
            <h3>4</h3>
            <p>Teams</p>
        </div>
    </div>
</div>

<div class="content-grid">
    <div class="card">
    </div>

    <div class="card">
    </div>
</div>
<?= $this->endSection() ?>