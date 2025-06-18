<?php require_once(__DIR__ . '/../fragment/fragmentMenu.php'); ?>

<h2 class="my-4">Assigner un examinateur</h2>

<form method="post" action="index.php?controller=responsable&action=ajoutExaminateur">
    <div class="mb-3">
        <label for="idProjet" class="form-label">Projet :</label>
        <select name="idProjet" id="idProjet" class="form-select">
            <?php foreach ($projets as $p): ?>
                <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['label']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="idExaminateur" class="form-label">Examinateur :</label>
        <select name="idExaminateur" id="idExaminateur" class="form-select">
            <?php foreach ($examinateurs as $e): ?>
                <option value="<?= $e['id'] ?>"><?= htmlspecialchars($e['prenom']) ?> <?= htmlspecialchars($e['nom']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="creneau" class="form-label">Créneau :</label>
        <input type="text" name="creneau" id="creneau" class="form-control" placeholder="Ex : Lundi 10h">
    </div>

    <button type="submit" class="btn btn-success">Assigner</button>
</form>

<?php require_once(__DIR__ . '/../fragment/fragmentFooter.php'); ?>
