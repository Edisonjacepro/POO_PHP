<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des événements</title>
</head>
<body>
    <h1>Liste des événements</h1>
    <a href="index.php?page=create">Créer un nouvel événement</a>

    <ul>
        <?php foreach ($events as $event): ?>
            <li>
                <?= htmlspecialchars($event['name']) ?> - <?= htmlspecialchars($event['date']) ?>
                <!-- Lien vers la page de modification -->
                <a href="index.php?page=edit&id=<?= $event['id']; ?>">Modifier</a>
                <a href="index.php?page=index&action=delete&id=<?= $event['id'] ?>">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
