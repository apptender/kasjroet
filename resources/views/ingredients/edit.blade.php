<h2>Ingredienten</h2>
<form method="post" action="{{route('ingredients.update', $ingredient->id)}}">
    @method('patch')
    @csrf
    <label for="name">
        Naam
        <input type="text" name="name" id="name" value="{{$ingredient->name}}">
    </label>
    <label for="ingredientcode">
        Code
        <input type="text" name="ingredientcode" id="ingredientcode" value="{{$ingredient->ingredientcode}}">
    </label>
    <label for="description">
        Omschrijving
        <textarea name="description" id="description" cols="30" rows="10" value="{{$ingredient->description}}"></textarea>
    </label>
    <label for="kosher">
        Kosher
        <input type="checkbox" name="kosher" id="kosher" value="{{$ingredient->kosher}}">
    </label>
    <input type="submit" value="submit">
</form>
