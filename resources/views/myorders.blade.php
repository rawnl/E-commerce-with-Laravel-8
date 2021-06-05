@extends('master')
@section('content')
<div class="product-class">
    <div class="catalogue-wraper">
        <h3>Mes commandes </h3>
        @if ($orders!=null)
            @foreach ($orders as $item)
                
            <div class="row">
                <div class="col-sm-3">
                    <img class="catalogue-img" src="{{$item->image}}" alt="...">
                </div>  

                <div class="col-sm-6">
                    <h3>Article : {{$item->name}}</h3>
                    <p>Status : {{$item->status}}</p>
                    <p>Adresse : {{$item->address}}</p>
                    <p>Méthode de paiement : {{$item->payment_method}}</p>
                    <p>Paiement : {{$item->payment_status}}</p>
                </div>
                <hr>
            </div>
            
            @endforeach    
        @else
            <div class="row">
                <div class="col-sm-3">
                    <h4>Aucune commande</h4>
                </div>
            </div>
        @endif

        
    </div>

</div>
@endsection
