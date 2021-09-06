@extends('layouts.app')

@section('content')
    <h1>Tienda de zapatos</h1>
    <ul class="list-group">
        @foreach ($products as $product)
            <li class="list-group-item">
               <h5> {{$product->name}}</h5>
               <p> {{$product->description}}</p>
            </li>
        @endforeach
    </ul>
@endsection
