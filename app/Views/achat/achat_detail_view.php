<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Liste des achats</h1>
    <form action="/achatDetail/insert" method="post">
        

        <label for="produit">Produit:</label>
        <select name="idProduit" id="produit">
            <?php foreach ($produits as $produit): ?>
                <option value="<?= $produit['id'] ?>"><?= $produit['designation'] ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>
        <label for="quantite">Quantité:</label>
        <input type="number" name="quantite" id="quantite" min="1" required>
        <br><br>

        <input type="submit" value="Valider">
    </form>
</body>
</html>