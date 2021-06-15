@extends('master')
@section('content')
<div class="product-class">
    <div class="catalogue-wraper d-flex justify-content-center">
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
                    <img class="catalogue-img" src="{{asset('storage/images/'.$item->image)}}" alt="...">
                </div>  

                <input type="hidden" id="{{$item->id}}" value="{{$item->quantity}}">
                <div class="col-sm-3">
                    <h3>{{$item->name}}</h3>
                    <p>Prix : {{$item->price}} DA</p>
                    <p>Total : {{$item->total}} DA</p>
                </div>

                <div class="col-sm-3">

                    <div class="btn-group-vertical" role="group" aria-label="...">
                        <a href="{{ route('increase-quantity', ['id' => $item->cart_id ]) }} " class="btn btn-default"><span class="dropup"><span class="caret"></span></span></a>
                        <p></p>
                        <p class="text-center">{{$item->cart_quantity}}</p>
                        <p></p>
                        <a href="{{ route('decrease-quantity', ['id' => $item->cart_id ]) }} " type="button" class="btn btn-default"><span class="caret"></span></a>
                        <br>
                        <a href="remove_from_cart/{{$item->cart_id}}" class="btn btn-danger" role="button">Retirer du panier</a>
                    </div>
    
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
