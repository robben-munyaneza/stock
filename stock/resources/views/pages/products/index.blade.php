@extends('components.sidebar')

@section('content')

<h2>PRODUCTS LIST</h2>

<a href="{{ route('products.create') }}">Add Products</a>

<table border="1">
    <tr>
       
        <th>pname</th>
        <th>update</th>
        <th>delete</th>
    </tr>

    @foreach ($products as $product)
        <tr>
          
            <td>{{ $product->pname }}</td>
            <td><a href="{{route('products.edit', $product->pcode)}}">edit</a></td>
            
                <td><Form action="{{route('products.destroy', $product->pcode)}}" method="POST" onsubmit="return confirm('do you want to delete the product');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">delete</button>

                </form>
                </td>
        </tr>
    @endforeach

</table>

@endsection
