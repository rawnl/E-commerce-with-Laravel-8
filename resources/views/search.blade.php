@extends('master')
@section('content')
<div class="product-class">
    
 <div id="myCarousel" class="carousel slide" data-ride="carousel">

    <div class="catalogue-wraper">
        <h3>Résultats de racherche </h3>
        @foreach ($result as $item)
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail search-item">
                    <img class="catalogue-img" src="{{asset('storage/images/'.$item['image'])}}" alt="...">
                    <div class="caption">
                        <h3>{{$item['name']}}</h3>
                        <p>Prix : {{$item['price']}} DA</p>
                        <p class="text-right">
                            <a href="#" class="btn btn-primary" role="button">Ajouter au panier</a> 
                            <a href="detail/{{$item['id']}}" class="btn btn-default" role="button">Détails</a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
