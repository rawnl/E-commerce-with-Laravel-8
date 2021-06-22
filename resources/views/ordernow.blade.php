@extends('master')
@section('content')
<div class="product-class">
    <div class="col-sm-10">
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">Facture</div>
            <br>
            @if ($source == 'setup')
                <!--{{ $counter = 0 }}-->
                @foreach ($products as $item)
                    
                <div class="row">
                    <div class="col-sm-3">
                        <img class="catalogue-img" src="{{asset('storage/images/'.$item->image)}}" width="150px" height="100px" alt="...">
                    </div>  

                    <div class="col-sm-6">
                        <h3>Article : {{$item->name}}</h3>
                        <p>Qt : 1 </p>
                        <p>Prix : {{$item->sale_price}} </p>
                    </div>
                    <hr>
                </div>
                <br>
                @endforeach
            @endif
            <!-- Table -->
            <table class="table">
                <tbody>
                    <tr>
                        <td>Montant</td>
                        <td>{{$total}} DA</td>
                    </tr>
                    <tr>
                        <td>Frais de la livraison</td>
                        <td>500 DA</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>{{$total+500}} DA</td>
                    </tr>
                </tbody>
            </table>
          </div>
          
          <form class="row" action="{{route('confirm_order')}}" method="POST">
            @csrf
            <div class="form-group col-sm-12">
                <textarea class="form-control" name="address" id="address" placeholder="Votre adresse"></textarea>
            </div>
            <input type="hidden" name="total" value="{{$total+500}}" name="total">
            <div class="form-group col-sm-12">
                <label for="payment_method" class="form-label">Méthode de paiement</label><br>
                <input type="radio" value="en-ligne" name="payment_method"><span> Paiement en ligne</span><br>
                <input type="radio" value="a-la-livraison" name="payment_method"><span> Paiement à la livraison</span><br>
            </div>
            
            <div>
            <!--
                <input type="hidden" name="selected_monitor" id="monitor"  value="{{$products['monitor']->id}}">
                <input type="hidden" name="selected_computer_case" id="computer_case" value="{{$products['computer_case']->id}}">
                <input type="hidden" name="selected_mother_board" id="mother_board" value="{{$products['mother_board']->id}}">
                <input type="hidden" name="selected_cpu" id="cpu" value="{{$products['cpu']->id}}">
                <input type="hidden" name="selected_graphic_card" id="graphic_card" value="{{$products['graphic_card']->id}}">
                <input type="hidden" name="selected_ram" id="ram" value="{{$products['ram']->id}}">
                <input type="hidden" name="selected_power_supply" id="power_supply" value="{{$products['power_supply']->id}}">
                <input type="hidden" name="selected_hard_drive" id="hard_drive" value="{{$products['hard_drive']->id}}">
                <input type="hidden" name="selected_fan" id="fan" value="{{$products['fan']->id}}">
                <input type="hidden" name="source" id="source" value="setup">
            -->
            </div>
            
            <div class="form-group col-sm-12 text-right">
                <button type="submit" class="form-group col-sm-12 btn btn-primary">confirmer</button>
            </div>

            </form>

    </div>
</div>
@endsection
