<form method="POST" action="/POO_PHP/event-manager/public/index.php?page=edit&id=<?php echo $event['id']; ?>">
    <label for="name">Nom de l'événement:</label>
    <input type="text" id="name" name="name" value="<?php echo $event['name']; ?>" required>
    
    <label for="date">Date de l'événement:</label>
    <input type="date" id="date" name="date" value="<?php echo $event['date']; ?>" required>
    
    <label for="description">description:</label>
    <input type="text" id="description" name="description" value="<?php echo $event['description']; ?>" required>

    <input type="submit" value="Mettre à jour">
</form>
