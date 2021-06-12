@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <img class="detail-image" src="{{asset('storage/images/'.$product['image'])}}" alt="">
        </div>

        <div class="col-sm-6">
            <a href="/">Retour</a>
            <h2>{{$product['name']}}</h2>
            <h1>{{$product['price']}} DA</h3>
            <p>Catégorie: {{$product['category']}}</p>
            
            @if($product['stock_status'] == "instock")
                <p>Status:  En stock  </p> 
                <p>Quantité: {{$product['quantity']}}</p>
            @else
                <p>Status:  Diponible prochainement</p>
                <button class="btn btn-info">réserver</button>
            @endif
            
            <p>Description: <br> {{$product['short_description']}}</p>
            <p>Détails: <br> {{$product['description']}}</p>

            <form action="{{route('add_to_cart')}}" method="POST">
            @csrf
                <input type="hidden" name="product_id" value="{{$product['id']}}">
                <p class="text-right">
                <button class="btn btn-primary">Ajouter au panier</button> 
                </p>
            </form>
        </div>

    </div>
</div>
@endsection
