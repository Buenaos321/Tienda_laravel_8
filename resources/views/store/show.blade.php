@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $product->name }}</h1>
        </div>
        <div class="col-md-12">
            <div class="card" style="width: 100%">
                <div class="card-body">
                    <div  id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        
                        <div class="carousel-inner">
                            @php
                              $i=0;  
                            @endphp
                            
                            @foreach($images as $image)
                                @if ($i==0)
                                    <div class="carousel-item active">
                                        <div class="container">
                                            <img src="{{ asset('storage/images/'.$image->url) }}" class="d-block w-100 " alt="{{ $image->name }}"  height="400">
                                        </div>
                                        
                                    </div>  
                                @else
                                    <div class="carousel-item ">
                                        <div class="container">
                                            <img src="{{ asset('storage/images/'.$image->url) }}" class="d-block w-100" alt="{{ $image->name }}" height="400">
                                        </div>
                                        
                                    </div> 
                                @endif
                                
                                @php
                                    $i=$i+1;
                                @endphp
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                    </div>
                    

                    <h5 class="card-title pt-4">Precio: {{ $product->price }}</h5>
                    <p class="card-text">
                        {{ $product->description }}
                    </p>
                    <p class="card-text">
                        Estado: {{ $product->status }}
                    </p>
                    <p class="card-text">
                        Garantía: {{ $product->warranty }}
                    </p>
                    <p class="card-text">
                        En stock: {{ $product->stok }}
                    </p>

                    
                        <a href="/store" class="btn btn-outline-primary">Volver atrás</a>
                        <a href="/store/{{$product->id}}/edit" class="btn btn-outline-success">Editar</a>
                </div>
            </div>
        </div>
    </div>
@endsection