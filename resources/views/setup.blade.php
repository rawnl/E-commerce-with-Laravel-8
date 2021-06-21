@extends('master')
@section('content')
<div class="container">

<section>
    <h2>Ecran</h2><br>
    @foreach ($setup_products as $item)
        @if ($item->category_name == "Ecran")
        <div class="row-fluid ">
            <div class="col-sm-4 ">
                <div class="card-columns-fluid">
        
                    <div class="card  bg-light" style = "width: 22rem; " >
        
                        <img class="card-img-top"  src="{{asset('storage/images/'.$item->image)}}" height="120px" width="120px" alt="Card image cap">
                    
                        <div class="card-body">
                            <h5 class="card-title"><b>{{$item->name}}</b></h5>
                            @if ($item->sale_price != null && $item->sale_price != $item->price)
                                <p class="card-text">Prix : <del> {{$item->price}} DA </del> {{$item->sale_price}} DA</p>                            
                            @else
                                <p class="card-text">Prix : {{$item->price}} DA </p>                        
                            @endif
                            <a href="#" class="btn btn-success">Selectionner</a>
                            <a href="#" class="btn btn-default">Détails</a>
                        </div>
                    </div>
                </div>
            </div>           
        @endif
        @endforeach

      </div>
</section>

<section>    
    <h2>Unité Centrale</h2><br>
    @foreach ($setup_products as $item)
        @if ($item->category_name == "Unite Centrale")
        <div class="row-fluid ">
            <div class="col-sm-4 ">
                <div class="card-columns-fluid">
        
                    <div class="card  bg-light" style = "width: 22rem; " >
        
                        <img class="card-img-top"  src="{{asset('storage/images/'.$item->image)}}" height="120px" width="120px" alt="Card image cap">
                    
                        <div class="card-body">
                            <h5 class="card-title"><b>{{$item->name}}</b></h5>
                            @if ($item->sale_price != null && $item->sale_price != $item->price)
                                <p class="card-text">Prix : <del> {{$item->price}} DA </del> {{$item->sale_price}} DA</p>                            
                            @else
                                <p class="card-text">Prix : {{$item->price}} DA </p>                        
                            @endif
                            <a href="#" class="btn btn-success">Selectionner</a>
                            <a href="#" class="btn btn-default">Détails</a>
                        </div>
                    </div>
                </div>
            </div>            
        @endif
        @endforeach

      </div>
</section>

<section>    
    <h2>Computer Case</h2><br>
    @foreach ($setup_products as $item)
        @if ($item->category_name == "Computer Case")
        <div class="row-fluid ">
            <div class="col-sm-4 ">
                <div class="card-columns-fluid">
        
                    <div class="card  bg-light" style = "width: 22rem; " >
        
                        <img class="card-img-top"  src="{{asset('storage/images/'.$item->image)}}" height="120px" width="120px" alt="Card image cap">
                    
                        <div class="card-body">
                            <h5 class="card-title"><b>{{$item->name}}</b></h5>
                            @if ($item->sale_price != null && $item->sale_price != $item->price)
                                <p class="card-text">Prix : <del> {{$item->price}} DA </del> {{$item->sale_price}} DA</p>                            
                            @else
                                <p class="card-text">Prix : {{$item->price}} DA </p>                        
                            @endif
                            <a href="#" class="btn btn-success">Selectionner</a>
                            <a href="#" class="btn btn-default">Détails</a>
                        </div>
                    </div>
                </div>
            </div>            
        @endif
        @endforeach

      </div>
</section>

<section>    
    <h2>Cartes Mere</h2><br>
    @foreach ($setup_products as $item)
        @if ($item->category_name == "Carte Mere")
        <div class="row-fluid ">
            <div class="col-sm-4 ">
                <div class="card-columns-fluid">
        
                    <div class="card  bg-light" style = "width: 22rem; " >
        
                        <img class="card-img-top"  src="{{asset('storage/images/'.$item->image)}}" height="120px" width="120px" alt="Card image cap">
                    
                        <div class="card-body">
                            <h5 class="card-title"><b>{{$item->name}}</b></h5>
                            @if ($item->sale_price != null && $item->sale_price != $item->price)
                                <p class="card-text">Prix : <del> {{$item->price}} DA </del> {{$item->sale_price}} DA</p>                            
                            @else
                                <p class="card-text">Prix : {{$item->price}} DA </p>                        
                            @endif
                            <a href="#" class="btn btn-success">Selectionner</a>
                            <a href="#" class="btn btn-default">Détails</a>
                        </div>
                    </div>
                </div>
            </div>            
        @endif
        @endforeach

      </div>
</section>

<section>    
    <h2>CPU</h2><br>
    @foreach ($setup_products as $item)
        @if ($item->category_name == "CPU")
        <div class="row-fluid ">
            <div class="col-sm-4 ">
                <div class="card-columns-fluid">
        
                    <div class="card  bg-light" style = "width: 22rem; " >
        
                        <img class="card-img-top"  src="{{asset('storage/images/'.$item->image)}}" height="120px" width="120px" alt="Card image cap">
                    
                        <div class="card-body">
                            <h5 class="card-title"><b>{{$item->name}}</b></h5>
                            @if ($item->sale_price != null && $item->sale_price != $item->price)
                                <p class="card-text">Prix : <del> {{$item->price}} DA </del> {{$item->sale_price}} DA</p>                            
                            @else
                                <p class="card-text">Prix : {{$item->price}} DA </p>                        
                            @endif
                            <a href="#" class="btn btn-success">Selectionner</a>
                            <a href="#" class="btn btn-default">Détails</a>
                        </div>
                    </div>
                </div>
            </div>            
        @endif
        @endforeach

      </div>
</section>

<section>    
    <h2>Carte Graphique</h2><br>
    @foreach ($setup_products as $item)
        @if ($item->category_name == "Carte Graphique")
        <div class="row-fluid ">
            <div class="col-sm-4 ">
                <div class="card-columns-fluid">
        
                    <div class="card  bg-light" style = "width: 22rem; " >
        
                        <img class="card-img-top"  src="{{asset('storage/images/'.$item->image)}}" height="120px" width="120px" alt="Card image cap">
                    
                        <div class="card-body">
                            <h5 class="card-title"><b>{{$item->name}}</b></h5>
                            @if ($item->sale_price != null && $item->sale_price != $item->price)
                                <p class="card-text">Prix : <del> {{$item->price}} DA </del> {{$item->sale_price}} DA</p>                            
                            @else
                                <p class="card-text">Prix : {{$item->price}} DA </p>                        
                            @endif
                            <a href="#" class="btn btn-success">Selectionner</a>
                            <a href="#" class="btn btn-default">Détails</a>
                        </div>
                    </div>
                </div>
            </div>            
        @endif
        @endforeach

      </div>
</section>


<section>    
    <h2>RAM</h2><br>
    @foreach ($setup_products as $item)
        @if ($item->category_name == "RAM")
        <div class="row-fluid ">
            <div class="col-sm-4 ">
                <div class="card-columns-fluid">
        
                    <div class="card  bg-light" style = "width: 22rem; " >
        
                        <img class="card-img-top"  src="{{asset('storage/images/'.$item->image)}}" height="120px" width="120px" alt="Card image cap">
                    
                        <div class="card-body">
                            <h5 class="card-title"><b>{{$item->name}}</b></h5>
                            @if ($item->sale_price != null && $item->sale_price != $item->price)
                                <p class="card-text">Prix : <del> {{$item->price}} DA </del> {{$item->sale_price}} DA</p>                            
                            @else
                                <p class="card-text">Prix : {{$item->price}} DA </p>                        
                            @endif
                            <a href="#" class="btn btn-success">Selectionner</a>
                            <a href="#" class="btn btn-default">Détails</a>
                        </div>
                    </div>
                </div>
            </div>            
        @endif
        @endforeach

      </div>
</section>

<section>    
    <h2>Power Supply</h2><br>
    @foreach ($setup_products as $item)
        @if ($item->category_name == "Power Supply")
        <div class="row-fluid ">
            <div class="col-sm-4 ">
                <div class="card-columns-fluid">
        
                    <div class="card  bg-light" style = "width: 22rem; " >
        
                        <img class="card-img-top"  src="{{asset('storage/images/'.$item->image)}}" height="120px" width="120px" alt="Card image cap">
                    
                        <div class="card-body">
                            <h5 class="card-title"><b>{{$item->name}}</b></h5>
                            @if ($item->sale_price != null && $item->sale_price != $item->price)
                                <p class="card-text">Prix : <del> {{$item->price}} DA </del> {{$item->sale_price}} DA</p>                            
                            @else
                                <p class="card-text">Prix : {{$item->price}} DA </p>                        
                            @endif
                            <a href="#" class="btn btn-success">Selectionner</a>
                            <a href="#" class="btn btn-default">Détails</a>
                        </div>
                    </div>
                </div>
            </div>            
        @endif
        @endforeach

      </div>
</section>

<section>    
    <h2>Disque Dur</h2><br>
    @foreach ($setup_products as $item)
        @if ($item->category_name == "Disque Dur")
        <div class="row-fluid ">
            <div class="col-sm-4 ">
                <div class="card-columns-fluid">
        
                    <div class="card  bg-light" style = "width: 22rem; " >
        
                        <img class="card-img-top"  src="{{asset('storage/images/'.$item->image)}}" height="120px" width="120px" alt="Card image cap">
                    
                        <div class="card-body">
                            <h5 class="card-title"><b>{{$item->name}}</b></h5>
                            @if ($item->sale_price != null && $item->sale_price != $item->price)
                                <p class="card-text">Prix : <del> {{$item->price}} DA </del> {{$item->sale_price}} DA</p>                            
                            @else
                                <p class="card-text">Prix : {{$item->price}} DA </p>                        
                            @endif
                            <a href="#" class="btn btn-success">Selectionner</a>
                            <a href="#" class="btn btn-default">Détails</a>
                        </div>
                    </div>
                </div>
            </div>            
        @endif
        @endforeach

      </div>
</section>

<section>    
    <h2>Ventilateur</h2><br>
    @foreach ($setup_products as $item)
        @if ($item->category_name == "Ventilateur")
        <div class="row-fluid ">
            <div class="col-sm-4 ">
                <div class="card-columns-fluid">
        
                    <div class="card  bg-light" style = "width: 22rem; " >
        
                        <img class="card-img-top"  src="{{asset('storage/images/'.$item->image)}}" height="120px" width="120px" alt="Card image cap">
                    
                        <div class="card-body">
                            <h5 class="card-title"><b>{{$item->name}}</b></h5>
                            @if ($item->sale_price != null && $item->sale_price != $item->price)
                                <p class="card-text">Prix : <del> {{$item->price}} DA </del> {{$item->sale_price}} DA</p>                            
                            @else
                                <p class="card-text">Prix : {{$item->price}} DA </p>                        
                            @endif
                            <a href="#" class="btn btn-success">Selectionner</a>
                            <a href="#" class="btn btn-default">Détails</a>
                        </div>
                    </div>
                </div>
            </div>            
        @endif
        @endforeach

      </div>
</section>

</div>
@endsection