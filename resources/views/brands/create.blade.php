<h2>Merken</h2>
<form action="/brands" method="post">
    @csrf
    <label for="brandname">
        Merknaam
        <input type="text" name="brandname" id="brandname"/>
    </label>
    <label for="brandcode">
        Merkcode
        <input type="text" name="brandcode" id="brandcode">
    </label>
    <input type="submit" value="submit">
</form>
