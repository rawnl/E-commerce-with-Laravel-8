@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4 login">
            <form class="row g-3" action="{{route('register')}}" method="POST">
                @csrf
                <div class="col-12">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom" id="nom" placeholder="Votre nom">
                </div>

                <div class="col-12">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Votre prénom">
                </div>

                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" name='email' id="inputEmail4" placeholder="Votre adresse e-mail">
                </div>
                
                <div class="col-12">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="votre mot de passe">
                </div>
                <br>
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
