<h2>Categorieen</h2>
<form action="/categories" method="POST">
    @csrf
    <label for="name">
        Naam
        <input type="text" name="name" id="name">
    </label>
    <label for="categorycode">
        Code
        <input type="text" name="categorycode" id="categorycode">
    </label>
    <label for="description">
        Omschrijving
        <textarea name="description" id="description" cols="30" rows="10"></textarea>
    </label>
    <input type="submit" value="submit">
</form>
