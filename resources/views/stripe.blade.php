@extends('master')
@section('content')
<div class="container">
    <h1 class="text-center">Payment Par Stripe</h1>
    <div class="row">
       <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-default credit-card-box">
             <div class="panel-heading display-table" >
                <div class="row display-tr" >
                   <h3 class="panel-title display-td text-left" > Détails de Paiement </h3>
                   <div class="display-td" >                            
                    <!--  <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">-->
                   </div>
                </div>
             </div>
             <div class="panel-body">
                @if (Session::has('success'))
                <div class="alert alert-success text-center">
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                   <p>{{ Session::get('success') }}</p>
                </div>
                @endif
                <form
                   role="form"
                   action="{{ route('stripe.post') }}"
                   method="post"
                   class="require-validation"
                   data-cc-on-file="false"
                   data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                   id="payment-form">
                   @csrf
                   <input name="total" type='hidden' value="{{$request->total}}">
                   <input name="address" type='hidden' value="{{$request->address}}">
                   <input name="payment_method" type='hidden' value="{{$request->payment_method}}">
                   <div class='form-row row'>
                      <div class='col-xs-12 form-group required'>
                         <label class='control-label'>Nom (sur la carte)</label> 
                         <input name="card_name" class='form-control' size='4' type='text'>
                      </div>
                   </div>
                   <div class='form-row row'>
                      <div class='col-xs-12 form-group card required'>
                         <label class='control-label'>Numéro de la carte </label> 
                         <input name="card_number" autocomplete='off' class='form-control card-number' size='20' type='text'>
                      </div>
                   </div>
                   <div class='form-row row'>
                      <div class='col-xs-12 col-md-4 form-group cvc required'>
                         <label class='control-label'>CVC</label> 
                         <input name="cvs" autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                      </div>
                      <div class='col-xs-12 col-md-4 form-group expiration required'>
                         <label class='control-label'>Mois d'expiration</label> 
                         <input name="expiration_month" class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                      </div>
                      <div class='col-xs-12 col-md-4 form-group expiration required'>
                         <label class='control-label'>Expiration Year</label> 
                         <input name="expiration_year" class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                      </div>
                   </div>
                   <div class='form-row row'>
                      <div class='col-md-12 error form-group hide'>
                         <div class='alert-danger alert'>Veuillez corriger les erreurs et réessayer </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-xs-12">
                         <button class="btn btn-primary btn-lg btn-block" type="submit">Payez maintenant</button>
                      </div>
                   </div>
                </form>
             </div>
          </div>
       </div>
    </div>
 </div>
</body>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
 $(function() {
var $form = $(".require-validation");
$('form.require-validation').bind('submit', function(e) {
   var $form = $(".require-validation"),
       inputSelector = ['input[type=email]', 'input[type=password]',
           'input[type=text]', 'input[type=file]',
           'textarea'
       ].join(', '),
       $inputs = $form.find('.required').find(inputSelector),
       $errorMessage = $form.find('div.error'),
       valid = true;
   $errorMessage.addClass('hide');
   $('.has-error').removeClass('has-error');
   $inputs.each(function(i, el) {
       var $input = $(el);
       if ($input.val() === '') {
           $input.parent().addClass('has-error');
           $errorMessage.removeClass('hide');
           e.preventDefault();
       }
   });
   if (!$form.data('cc-on-file')) {
       e.preventDefault();
       Stripe.setPublishableKey($form.data('stripe-publishable-key'));
       //Stripe.setPublishableKey("pk_test_lwJehXKAnUfHn6EKuTcDhefV00XnLUVOAQ");

       Stripe.createToken({
           number: $('.card-number').val(),
           cvc: $('.card-cvc').val(),
           exp_month: $('.card-expiry-month').val(),
           exp_year: $('.card-expiry-year').val()
       }, stripeResponseHandler);
   }
});
function stripeResponseHandler(status, response) {
   if (response.error) {
       $('.error')
           .removeClass('hide')
           .find('.alert')
           .text(response.error.message);
   } else {
       /* token contains id, last4, and card type */
       var token = response['id'];
       $form.find('input[type=text]').empty();
       $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
       $form.get(0).submit();
   }
}
});
</script>
@endsection
