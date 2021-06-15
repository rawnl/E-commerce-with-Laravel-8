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
                Nouveau Produit
              </button>
            </p> 

            <p>
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCategoryModalScrollable">
                Nouvelle Catégorie
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
                {{$count = 0 }}
                    @foreach ($products as $item)
                    <tr>
                        
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>
                          
                          <div class="col-sm-4">
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#updateModal" onclick="update(this.id)" id="{{ $count }}">
                              Modifier
                            </button>
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
                    {{$count++ }}
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
      
      <form action="{{route('addProduct')}}" method="POST" enctype="multipart/form-data">
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
                  <label for="updateSalePrice" class="form-label">Prix de vente</label>
                  <input type="text" class="form-control" name="updateSalePrice" id="updateSalePrice" placeholder="">
                </div>

                <br>
                <div class="col-12 dropdown">
                 <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categorie<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      @foreach ($categories as $category)
                        <li>
                          <input type="radio" id="{{$category['name']}}" value="{{$category['id']}}" name="category"><span> {{$category['name']}}</span><br>
                        </li>
                        <li role="separator" class="divider"></li>
                      @endforeach
                  </ul>
                </div>
                <br>

                <div class="col-12">
                    <label for="inputEmail4" class="form-label">Quantité</label>
                    <input type="text" class="form-control" name='quantity' id="quantity" placeholder="">
                </div>
                
                <div class="col-12">
                  <label for="shortDescription" class="form-label">Petite description</label>
                  <input type="text" class="form-control" name="shortDescription" id="shortDescription" placeholder="">
                </div>

                <div class="col-12">
                    <label for="password" class="form-label">Description</label>
                    <textarea type="password" class="form-control" name="description" id="description" placeholder=""></textarea>
                </div>

                <div class="col-12">
                  <label for="inputEmail4" class="form-label">Image</label>
                  <input type="file" class="form-control-file" name='image' id="image" placeholder="">
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

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Modification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form action="{{route('editProduct')}}" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          @csrf
                <div class="col-12">
                    <input type="hidden" class="form-control" name="updateId" id="updateId" placeholder="">
                </div>
                <div class="col-12">
                    <label for="updateName" class="form-label">Nom de produit</label>
                    <input type="text" class="form-control" name="updateName" id="updateName" placeholder="">
                </div>

                <div class="col-12">
                    <label for="updatePrice" class="form-label">Prix</label>
                    <input type="text" class="form-control" name="updatePrice" id="updatePrice" placeholder="">
                </div>

                <div class="col-12">
                  <label for="updateSalePrice" class="form-label">Prix de vente</label>
                  <input type="text" class="form-control" name="updateSalePrice" id="updateSalePrice" placeholder="">
              </div>
                <br>
                <div class="col-12 dropdown">
                 <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categorie<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                      @foreach ($categories as $category)
                        <li>
                          <input type="radio" id="{{$category['name']}}" value="{{$category['id']}}" name="updateCategory"><span> {{$category['name']}}</span><br>
                        </li>
                        <li role="separator" class="divider"></li>
                      @endforeach
                  </ul>
                </div>
                <br>
                <div class="col-12">
                    <label for="updateQuantity" class="form-label">Quantité</label>
                    <input type="text" class="form-control" name='updateQuantity' id="updateQuantity" placeholder="">
                </div>
                
                <div class="col-12">
                  <label for="updateShortDescription" class="form-label">Petite description</label>
                  <input type="text" class="form-control" name="updateShortDescription" id="updateShortDescription" placeholder="">
                </div>

                <div class="col-12">
                    <label for="updateDescription" class="form-label">Description</label>
                    <textarea class="form-control" name="updateDescription" id="updateDescription" placeholder=""></textarea>
                </div>

                <div class="col-12">
                  <label for="updateImage" class="form-label">Image</label>
                  <input type="file" class="form-control-file" name='updateImage' id="updateImage" placeholder="">
                </div>
              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuuler</button>
          <button type="submit" class="btn btn-success">Modifier</button>
        </div>
      </form>

    </div>
  </div>
</div>

<!-- New Category Modal -->
<div class="modal fade" id="addCategoryModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Nouveau Produit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <form action="{{route('addCategory')}}" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          @csrf
              <div class="col-12">
                <label for="category" class="form-label">Nom de la catégorie</label>
                <input type="text" class="form-control" name="category" id="category" placeholder="">
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


<script>

  function passId(url){
    document.getElementById("deleteByID").setAttribute("href", url );
  }


  function update(id){
    
    var produits = {!! json_encode($products->toArray(), JSON_HEX_TAG) !!};
    var produit = produits[id] ;

    var categories = {!! json_encode($categories->toArray(), JSON_HEX_TAG) !!};
    var category = categories[produits[id].category_id];

    document.getElementById("updateId").setAttribute("value", produit.id );
    document.getElementById("updateName").setAttribute("value", produit.name);
    document.getElementById("updatePrice").setAttribute("value", produit.price );
    document.getElementById("updateSalePrice").setAttribute("value", produit.sale_price );
    document.getElementById("updateQuantity").setAttribute("value", produit.quantity );
    $('input[name=updateCategory][value="' + produit.category_id + '"]').prop('checked', true)   
    document.getElementById("updateShortDescription").setAttribute("value", produit.short_description);
    document.getElementById("updateDescription").innerHTML = produit.description;
    document.getElementById("updateImage").setAttribute("value", produit.image );

  }

</script>

@endsection