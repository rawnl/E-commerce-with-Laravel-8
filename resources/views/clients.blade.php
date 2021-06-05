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

        <h2>Clients</h2>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>ID </th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
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

@endsection