@extends('master')
@section('content')
  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="{{route('dashboard')}}">
                <span data-feather="home"></span>
                Dashboard <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('orders')}}">
                <span data-feather="file"></span>
                Commandes
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('products')}}">
                <span data-feather="shopping-cart"></span>
                Produits
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('clients')}}">
                <span data-feather="users"></span>
                Clients
              </a>
            </li>
          </ul>
        <!--
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Saved reports</span>
            <a class="d-flex align-items-center text-muted" href="#">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Current month
              </a>
            </li>
          </ul>
        -->
        </div>
      </nav>

      <!--<div class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button class="btn btn-sm btn-outline-secondary">Share</button>
              <button class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
              <span data-feather="calendar"></span>
              This week
            </button>
          </div>
        </div>
        -->
        
        
        
        <div class="table-responsive">
          <div class="col-sm-6">
            <h2>Produits</h2>  
            <p>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModalScrollable">
                Ajouter un nouveau produit
              </button>
              <!--<a href="" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" role="button">Ajouter un nouveau  produit</a>-->
            </p> 
          </div>

          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>ID Produit </th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Description</th>
                <th>Quantité</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @if ($products != null)
                    @foreach ($products as $item)
                    <tr>
                        
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>
                          
                          <div class="col-sm-4">
                            <p class="text-left">
                                <a href="editProduct/{{$item->id}}" class="btn btn-warning" role="button">Modifier</a>
                            </p>
                          </div>
    
                          <div class="col-sm-4">
                            <p class="text-left">
                                <a href="deleteProduct/{{$item->id}}" class="btn btn-danger" role="button">Supprimer</a>
                            </p>
                          </div>

                        </td>
                    </tr>  
                    @endforeach                
                @else
                    <p>Table vide</p>                
                @endif              
                </tbody>
          </table>

        </div>
      </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Nouveau Produit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form action="{{route('addProduct')}}" method="POST">
        <div class="modal-body">
          @csrf
                <div class="col-12">
                    <label for="nom" class="form-label">Nom de produit</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="">
                </div>

                <div class="col-12">
                    <label for="prenom" class="form-label">Prix</label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="">
                </div>

                <div class="col-12">
                  <label for="prenom" class="form-label">Catégorie</label>
                  <input type="text" class="form-control" name="category" id="category" placeholder="">
              </div>

                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Quantité</label>
                    <input type="text" class="form-control" name='quantity' id="quantity" placeholder="">
                </div>
                
                <div class="col-12">
                    <label for="password" class="form-label">Description</label>
                    <textarea type="password" class="form-control" name="description" id="description" placeholder=""></textarea>
                </div>

                <div class="col-12">
                  <label for="inputEmail4" class="form-label">Image URL</label>
                  <input type="text" class="form-control" name='image' id="image" placeholder="">
              </div>
              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuuler</button>
          <button type="submit" class="btn btn-primary">Valider</button>
        </div>
      </form>

    </div>
  </div>
</div>
@endsection