@extends('master')
@section('content')
<div class="product-class">
    <div class="col-sm-10">
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">Facture</div>
          
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
                <textarea class="form-control" name="address" id="adress" placeholder="Votre adresse"></textarea>
            </div>
            <input type="hidden" name="total" value="{{$total+500}}" name="total">
            <div class="form-group col-sm-12">
                <label for="payment_method" class="form-label">Méthode de paiement</label><br>
                <input type="radio" value="en-ligne" name="payment_method"><span> Paiement en ligne</span><br>
                <input type="radio" value="a-la-livraison" name="payment_method"><span> Paiement à la livraison</span><br>
            </div>
            
            <div class="form-group col-sm-12 text-right">
                <button type="submit" class="form-group col-sm-12 btn btn-primary">confirmer</button>
            </div>

            </form>

    </div>
</div>
@endsection
