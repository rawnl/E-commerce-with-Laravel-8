@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4 login">
            <form class="row g-3" method="POST" action="login">
                @csrf
                @if(session('error'))
                    <div class="alert alert-error" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="col-12">
                  <label for="inputEmail4" class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" id="inputEmail4">
                </div>
                <div class="12">
                  <label for="inputPassword4" class="form-label">Mot de passe</label>
                  <input type="password" name="password" class="form-control" id="inputPassword4">
                </div>
                <div class="col-12">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Garder ma session
                    </label>
                  </div>
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>
              </form>            
        </div>
    </div>
</div>
@endsection
