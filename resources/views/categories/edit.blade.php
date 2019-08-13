<h2>Categorieen</h2>
<form method="POST" action="{{route('categories.update', $category->id)}}">
    @method('patch')
    @csrf
    <label for="name">
        Naam
        <input type="text" name="name" id="name" value="{{$category->name}}">
    </label>
    <label for="categorytcode">
        Code
        <input type="text" name="categorycode" id="categorycode" value="{{$category->categorycode}}">
    </label>
    <label for="description">
        Omschrijving
        <textarea name="description" id="description" cols="30" rows="10" value="{{$category->description}}"></textarea>
    </label>
    <input type="submit" value="submit">
</form>
