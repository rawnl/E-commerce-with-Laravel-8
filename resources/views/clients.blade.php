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

        <h2>Clients</h2>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>ID </th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Etat</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @if ($clients != null)
                    @foreach ($clients as $item)
                    <tr>
                        
                        <td>{{$item->id}}</td>
                        <td>{{$item->nom}}</td>
                        <td>{{$item->prenom}}</td>
                        <td>{{$item->email}}</td>
                        
                        @if ($item->etat == "AUTHORIZED")
                          <td>Autorisé</td>
                        @else
                          <td>Blocqué</td>
                        @endif
                
                        <td>
                          @if ($item->etat == "AUTHORIZED")
    
                            <div class="col-sm-4">
                              <p class="text-left">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#blockModal" onclick="blockUser(this.id)" id="blockUser/{{ $item->id }}">
                                  Bloquer
                                </button>
                              </p>
                            </div>
                            
                          @else
  
                          <div class="col-sm-4">
                            <p class="text-left">
                                <a href="unblockUser/{{$item->id}}" class="btn btn-info" role="button">Débloquer</a>
                            </p>
                          </div>    
                          
                          @endif
                                
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

<!-- Block Modal -->
<div class="modal fade" id="blockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Voulez vous vraiment bloquer ce clients ? 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <a class="btn btn-danger" id="blockByID" role="button">Oui</a>
      </div>
    </div>
  </div>
</div>


<script>

  function blockUser(url){
    document.getElementById("blockByID").setAttribute("href", url );
  }

</script>

@endsection