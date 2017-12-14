@extends('layouts.app')

@section('content')
<div class="row" id="home">
  <ul class="collection">
    <li class="collection-item avatar item-product" v-for="value,index in product.data">
      <div class="row">
        <i class="material-icons circle" style="background-color: #ffbb33">store</i>
        <div class="col s7 m6">
          <span class="title"><strong>@{{ value.codigo }}</strong></span>    
          <p class="green-text">$ @{{ value.precio_venta }}</p>
          <p><small>@{{ value.tienda }}</small></p>
        </div>
        <div class="col s5 m3">
          <p>@{{ value.descripcion }}</p>
          <p class="red-text">$ @{{ value.precio_sugerido }}</p>
        </div>
        <div class="col s12 m3">
          <a href="#!" class="secondary-content">
            <a class="waves-effect waves-light btn" @click="updatePrice(value)"><i class="material-icons">check</i></a>
            <a class="waves-effect waves-light btn red" @click="changeState(value.id)"><i class="material-icons">close</i></a>
          </a>
        </div>
      </div>
    </li>
  </ul>
</div>
@endsection
@section('script')
<script src="{{ asset('js/home.js') }}"></script>
@endsection
