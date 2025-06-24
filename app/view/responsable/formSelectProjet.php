<?php
// app/view/responsable/formSelectProjet.php
require __DIR__ . '/../../view/fragment/fragmentMenu.php';
?>
<div class="container mt-5 pt-5">
  <h2>Sélectionnez un projet</h2>
  <form method="post" action="index.php?controller=responsable&action=<?= htmlspecialchars($_GET['action'] ?? 'listExaminateursProjet') ?>">
    <div class="mb-3">
      <label for="projet_id" class="form-label">Projet</label>
      <select class="form-select" id="projet_id" name="projet_id" required>
        <option value="">-- Choisir --</option>
        <?php foreach($prs as $p): ?>
          <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['label']) ?> (Groupe <?= $p['groupe'] ?>)</option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
  </form>
</div>

<?php require __DIR__ . '/../fragment/fragmentFooter.php'; ?>
