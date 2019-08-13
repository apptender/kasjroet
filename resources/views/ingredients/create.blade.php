<h2>Ingredienten</h2>
<form action="/ingredients" method="POST">
    @csrf
    <label for="name">
        Naam
        <input type="text" name="name" id="name">
    </label>
    <label for="ingredientcode">
        Code
        <input type="text" name="ingredientcode" id="ingredientcode">
    </label>
    <label for="description">
        Omschrijving
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
    </label>
    <label for="kosher">
        Kosher
        <input type="checkbox" name="kosher" id="kosher">
    </label>
    <label for="koshertype">
        Kosher type
        <select name="koshertype" id="koshertype">
            <option value="">Niet van Toepassing</option>
            <option value="melkkost">Melkkost</option>
            <option value="Vleeskost">Vleeskost</option>
            <option value="parve">Parve</option>
        </select>
    </label>
    <input type="submit" value="submit">
</form>
