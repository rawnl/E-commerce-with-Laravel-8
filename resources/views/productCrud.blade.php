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
        </div>
      </nav>

        
        <div class="table-responsive">
          <div class="col-sm-6">
            <h2>Produits</h2>  
            <p>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModalScrollable">
                Ajouter un nouveau produit
              </button>
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
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" onclick="passId(this.id)" id="deleteProduct/{{ $item->id }}">
                                Supprimer
                              </button>
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


<!-- Add Modal -->
<div class="modal fade" id="addModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
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


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Cette action irréversible. Voulez vous vraiment supprimer ce produit ? 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <a class="btn btn-danger" id="deleteByID" role="button">Oui</a>
      </div>
    </div>
  </div>
</div>

<script>

  function passId(url){
    document.getElementById("deleteByID").setAttribute("href", url );
  }

</script>

@endsection