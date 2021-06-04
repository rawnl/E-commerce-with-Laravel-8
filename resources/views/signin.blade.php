@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4 login">
            <form class="row g-3">
                
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4">
                </div>
                
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Mot dee passe</label>
                    <input type="password" class="form-control" id="inputPassword4">
                </div>
                
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>

                <div class="col-12">
                    <label for="inputAddress2" class="form-label">Address 2</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">S'inscrire</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
