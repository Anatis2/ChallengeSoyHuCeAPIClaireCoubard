

<section>

<h3>Tableau des 10 derniers relevés météo</h3>

<form method="get" action="resultat.php">
    <label for="nomVilleComparaison">Sélectionnez une ville : </label>
    <select name="nomVilleComparaison">
        <option value="Toutes">Toutes</option>
        <?php recupNomsVilles(); ?>
    </select>
    <input type="submit" value="Rechercher"/>
</form>

<br/><br/>

