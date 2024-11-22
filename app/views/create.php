<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un événement</title>
</head>
<body>
    <h1>Créer un événement</h1>
    <form method="POST" action="/POO_PHP/event-manager/public/index.php?page=create">
    <input type="text" name="name" placeholder="Nom de l'événement" required>
    <input type="datetime-local" name="date" required>
    <textarea name="description" placeholder="Description de l'événement" required></textarea>
    <button type="submit">Créer un événement</button>
</form>
</body>
</html>
