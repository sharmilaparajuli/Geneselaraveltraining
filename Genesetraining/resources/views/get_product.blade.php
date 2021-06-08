

@extends('layout')
@section('content')
<h1>Products</h1>
@foreach($products as $product)
<article>
    <h2><a href="/product">{{$product['product_name']}} </a></h2>
        <p>{{$product['product_desc']}}</p>
        <h2><a>{{$product['price']}} </a></h2>
</article>

@endforeach

@endsection