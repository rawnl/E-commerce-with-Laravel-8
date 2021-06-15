@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <img class="detail-image" src="{{asset('storage/images/'.$product[0]->image)}}" alt="">
        </div>

        <div class="col-sm-6">
            <a href="/">Retour</a>
            <h2>{{$product[0]->name}}</h2>
            <h1>{{$product[0]->price}} DA</h3>
            <p>Catégorie: <a>{{$product[0]->category_name}}</a></p>
            
            @if($product[0]->stock_status == "instock")
                <p>Status:  En stock  </p> 
                <p>Quantité: {{$product[0]->quantity}}</p>
            @else
                <p>Status:  Disponible prochainement</p>
                <button class="btn btn-info">réserver</button>
            @endif
            
            <p>Description: <br> {{$product[0]->short_description}}</p>
            <p>Détails: <br> {{$product[0]->description}}</p>

            <form action="{{route('add_to_cart')}}" method="POST">
            @csrf
                <input type="hidden" name="product_id" value="{{$product[0]->id}}">
                <p class="text-right">
                <button class="btn btn-primary">Ajouter au panier</button> 
                </p>
            </form>
        </div>

    </div>
</div>
@endsection
