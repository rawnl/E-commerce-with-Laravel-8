<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-comm</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<body>
    {{View::make('header')}}
    @if (session('success'))
        <div class="alert alert-success alert-block">	
            <button type="button" class="close" data-dismiss="alert">×</button>	        
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">	
            <button type="button" class="close" data-dismiss="alert">×</button>	        
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">	
            <button type="button" class="close" data-dismiss="alert">×</button>	        
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($message = Session::get('warning'))
        <div class="alert alert-warning alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>		
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($message = Session::get('info'))
        <div class="alert alert-info alert-block">	
            <button type="button" class="close" data-dismiss="alert">×</button>		
            <strong>{{ $message }}</strong>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">	
            <button type="button" class="close" data-dismiss="alert">×</button>		
            Please check the form below for errors
        </div>
    @endif

    @yield('content')
    {{View::make('footer')}}
</body>
<style>
    .login{
        height: 500px;
        padding-top: 100px
    }
    img.slider-image{
        height: 400px !important;
    }
    .product-class{
        height:600px;
    }
    .slider-text{
        color: #35443585 !important;
    }
    .catalogue-img{
        height: 200px !important;
    }
    .catalogue-wraper{
        margin:30px; 
    }
    .detail-image{
        height: 300px;
    }
    .search-input{
        width: 500px !important;
    }
    del{
        color: rgb(224, 43, 43) !important;
    }

/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
<!--<script>
    $(document).ready(function()
    {
        $("button").click(function () {
            alert("all set")
        })
    })
</script>
-->
</html>