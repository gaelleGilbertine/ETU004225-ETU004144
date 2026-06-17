<html>
    <h1>Créer un Achat</h1>
<form action="/achats/insert" method="post">
    <label for="Caisses">Caisse:</label>
    <select name="idCaisse" id="Caisses">
        <?php foreach ($caisses as $caisse): ?>
            <option value="<?= $caisse['id'] ?>"><?= $caisse['nomDeCaisse'] ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <input type="hidden" name="idUser" value="1"> 

    <input type="submit" value="Créer un achat">
</form>
</html>