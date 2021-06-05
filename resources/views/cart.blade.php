@extends('master')
@section('content')
<div class="product-class">
    <div class="catalogue-wraper">
        <h3>Contenu du panier </h3>
        @if ($products!=null)
            <br>
            <div class="row">    
                <div class="col-sm-6">
                    <p class="text-left">
                        <a href="{{route('order_now')}}" class="btn btn-success" role="button">Confirmer ma commande</a>
                    </p>
                </div>
            </div>
            <br>
            @foreach ($products as $item)
                
            <div class="row">
                <div class="col-sm-3">
                    <img class="catalogue-img" src="{{$item->image}}" alt="...">
                </div>  

                <div class="col-sm-3">
                    <h3>{{$item->name}}</h3>
                    <p>Prix : {{$item->price}} DA</p>
                    <p>{{$item->description}}</p>
                </div>
                
                <div class="col-sm-3">
                    <p class="text-right">
                        <a href="remove_from_cart/{{$item->cart_id}}" class="btn btn-danger" role="button">Retirer du panier</a>
                    </p>
                </div>
            </div>
            
            @endforeach    
        @else
            <div class="row">
                <div class="col-sm-3">
                    <h4>Votre panier est vide</h4>
                </div>
            </div>
        @endif

        
    </div>

</div>
@endsection
