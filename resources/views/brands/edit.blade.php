<h2>Merken</h2>
<form action="{{route('brands.update', $brand->id)}}" method="post">
    @csrf
    @method('patch')
    <label for="brandname">
        Merknaam
        <input type="text" name="brandname" id="brandname" value="{{$brand->brandname}}"/>
    </label>
    <label for="brandcode">
        Merkcode
        <input type="text" name="brandcode" id="brandcode" value="{{$brand->brandcode}}">
    </label>
    <input type="submit" value="submit">
</form>
