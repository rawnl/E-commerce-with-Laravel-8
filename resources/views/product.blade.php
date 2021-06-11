@extends('master')
@section('content')
<div class="product-class">
    
 <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
    
     
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        
        @foreach ($products as $item)
            <div class="item {{$item['id']==1?'active':'' }}">
                <a href="detail/{{$item['id']}}">
                <img src="{{asset('storage/images/'.$item['image'])}}" class="slider-image">
                <div class="carousel-caption slider-text">
                    <h3>{{$item['name']}}</h3>
                    <p>{{$item['short-description']}}</p>
                </div>
                </a>
            </div>
        @endforeach

      </div>
    
      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Précedent</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Suivant</span>
      </a>
    </div>

    <div class="catalogue-wraper">
        <h3>Catalogue : </h3>
        @foreach ($products as $item)
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail catalogue-item">
                    <img class="catalogue-img" src="{{asset('storage/images/'.$item['image'])}}" alt="...">
                    <div class="caption">
                        <h3>{{$item['name']}}</h3>
                        
                        @if ($item['sale-price'] != null )
                            <p>Prix : <del> {{$item['price']}} DA </del> {{$item['sale-price']}} DA</p>                            
                        @else
                            <p>Prix : {{$item['price']}} DA </p>                        
                        @endif
                        <p> {{$item['short-description']}}</p>
                        <div class="d-flex justify-content-between text-right">                            
                           <a href="addToCart/{{$item['id']}}" class="btn btn-primary" role="button">Ajouter au panier</a>
                           <a href="detail/{{$item['id']}}" class="btn btn-default" role="button">Détails</a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
