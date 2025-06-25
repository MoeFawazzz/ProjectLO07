<div class="container mt-4 pt-5">
    <h2>Mes notifications</h2>

    <?php if (!empty($_SESSION['success_message'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_SESSION['success_message']) ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <ul class="list-group">
        <?php foreach ($notifications as $notif): ?>
            <li class="list-group-item d-flex justify-content-between align-items-start <?= $notif['is_read'] ? '' : 'list-group-item-warning' ?>">
                <div>
                    <?= htmlspecialchars($notif['message']) ?><br>
                    <small class="text-muted"><?= $notif['created_at'] ?></small>
                </div>
                <a href="index.php?controller=notification&action=delete&id=<?= $notif['id'] ?>" 
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Supprimer cette notification ?')">
                    Supprimer
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
