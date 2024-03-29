<?php 
use App\Http\Controllers\ProductController;
$cartItems= 0;
if(Session::has('user')){
  $cartItems = ProductController::cartItems();
}
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{route('home')}}">E-COMM</a>
      </div>
  
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <!--<li class="active"><a href="#">Accueil</a></li>-->
          <!--<li><a href="#">Commandes</a></li>-->
          <!--<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li>-->
        </ul>
        <form action="/search" class="navbar-form navbar-left">
          <div class="form-group">
            <input type="text" name="query" class="form-control search-input" placeholder="Nom de produit">
          </div>
          <button type="submit" class="btn btn-default">Rechercher</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
          
          <li><a href="{{route('setup')}}" class="btn btn-info">Configurer un PC</a></li>
          
          @if(Session::has('user'))
            @if(session()->get('user')['type'] == "USR")
              <li><a href="{{route('cart')}}">Panier({{$cartItems}})</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Session::get('user')['prenom'] }} {{Session::get('user')['nom']}}<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Mon profile</a></li>
                  <li><a href="{{route('myorders')}}">Mes commandes</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="{{route('logout')}}">Déconnecter</a></li>
                </ul>
              </li>
            @else
              <li><a href="{{route('logout')}}">Déconnecter</a></li>
            @endif
            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Session::get('user')['prenom'] }} {{Session::get('user')['nom']}}<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Mon profile</a></li>
                <li><a href="{{route('myorders')}}">Mes commandes</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{route('logout')}}">Déconnecter</a></li>
              </ul>
            </li>-->
          @else
            <li><a href="{{route('login')}}">Se connecter </a></li>
            <li><a href="{{route('register')}}">S'inscrire </a></li>
          @endif
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>