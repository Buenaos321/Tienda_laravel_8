@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Tienda de zapatos</h1>
        </div>
    </div>
    <div class="row pt-4">
        <div class="com-md-12">
            <a class="btn btn-outline-primary" href="/store/create">Crear producto</a>
        </div>
    </div>
   

    <div class="row pt-4">
        <div class="col-md-12">
            <ul class="list-group">
                @foreach ($products as $product)
                    <li class="list-group-item">
                       <h5> {{$product->name}}</h5>
                       <p> {{$product->description}}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    
@endsection
