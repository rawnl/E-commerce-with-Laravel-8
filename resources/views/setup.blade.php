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
                            <button type="button" class="btn btn-success" onclick="select(this.id, this.name)" name="monitor" id="{{ $item->id }}">Sélectionner</button>
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
                            <button type="button" class="btn btn-success" onclick="select(this.id, this.name)" name="computer_case" id="{{ $item->id }}">Sélectionner</button>
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
                            <button type="button" class="btn btn-success" onclick="select(this.id, this.name)" name="mother_board" id="{{ $item->id }}">Sélectionner</button>
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
                            <button type="button" class="btn btn-success" onclick="select(this.id, this.name)" name="cpu" id="{{ $item->id }}">Sélectionner</button>
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
                            <button type="button" class="btn btn-success" onclick="select(this.id, this.name)" name="graphic_card" id="{{ $item->id }}">Sélectionner</button>
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
                            <button type="button" class="btn btn-success" onclick="select(this.id, this.name)" name="ram" id="{{ $item->id }}">Sélectionner</button>
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
                            <button type="button" class="btn btn-success" onclick="select(this.id, this.name)" name="power_supply" id="{{ $item->id }}">Sélectionner</button>
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
                            <button type="button" class="btn btn-success" onclick="select(this.id, this.name)" name="hard_drive" id="{{ $item->id }}">Sélectionner</button>
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
                            <button type="button" class="btn btn-success" onclick="select(this.id, this.name)" name="fan" id="{{ $item->id }}">Sélectionner</button>
                            <a href="#" class="btn btn-default">Détails</a>
                        </div>
                    </div>
                </div>
            </div>            
        @endif
        @endforeach

      </div>
</section>
<br><br>
<form action="{{route('setup.post')}}" method="POST">
    @csrf
    <input type="hidden" name="selected_monitor" id="monitor"  value="">
    <input type="hidden" name="selected_computer_case" id="computer_case" value="">
    <input type="hidden" name="selected_mother_board" id="mother_board" value="">
    <input type="hidden" name="selected_cpu" id="cpu" value="">
    <input type="hidden" name="selected_graphic_card" id="graphic_card" value="">
    <input type="hidden" name="selected_ram" id="ram" value="">
    <input type="hidden" name="selected_power_supply" id="power_supply" value="">
    <input type="hidden" name="selected_hard_drive" id="hard_drive" value="">
    <input type="hidden" name="selected_fan" id="fan" value="">
    <input class="btn btn-primary btn-lg btn-block" type="submit" id="submit" value="Valider" disabled="true">
</form>

</div>

<script>
    
    function select(id, name){
        var elements = document.getElementsByName(name);
        console.log(document.getElementById(id).innerHTML);
        if(document.getElementById(id).innerHTML != "Annuler"){
            elements.forEach(element => {
                if(element.getAttribute(id) == id){
                    element.setAttribute("disabled", false); 

                }else{
                    element.setAttribute("disabled", true);
                }
            });
            
            document.getElementById(id).disabled = false;
            document.getElementById(id).class = "btn btn-warning";
            document.getElementById(id).innerHTML = "Annuler";
            
            document.getElementById(name).setAttribute("value", id);
            console.log(document.getElementById(name).value);

        }else{
            elements.forEach(element => {
                element.removeAttribute("disabled");
            });
            
            document.getElementById(id).class = "btn btn-success";
            document.getElementById(id).innerHTML = "Sélectionner";
            document.getElementById(name).removeAttribute("value");
        }

        if ($('#monitor').val() != '' && $('#computer_case').val() != '' && $('#mother_board').val() != '' && $('#cpu').val() != '' && $('#graphic_card').val() != '' && $('#ram').val() != '' && $('#power_supply').val() != '' && $('#hard_drive').val() != '' && $('#fan').val() != '' ) {
            $('#submit').attr('disabled', false);
        } else {
            $('#submit').attr('disabled', true);
        }
    }

</script>
@endsection