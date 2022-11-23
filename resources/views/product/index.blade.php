@extends('product.layout')


@section('content')

<div class="jumbotron container">
    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <a class="btn btn-primary btn-lg" href="{{route('products.create')}}" role="button">Create</a>
  </div>

  <div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-primary" role="alert">
      {{$message}}
    </div>
    @endif
  </div>

  <div class="container">
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @php
                $i=0
            @endphp
            @foreach ($product as $item)
            <tr>
                <th scope="row">{{++$i}}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->price}} EGP</td>
                <td>

                  <div class="row">
                    
                    <div class="col-sm">
                      
                      <a class="btn btn-primary" href="{{route('products.edit',$item->id)}}">Edit</a>
                    
                    </div>
                    <div class="col-sm">
                      
                      <a class="btn btn-success" href="{{route('products.show',$item->id)}}">Show</a>
                    
                    </div>
                    <div class="col-sm">
                      <form action="{{ route('products.destroy',$item->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>               
                     </div>
                  
                    </div>
                  
                </td>
              </tr>
            @endforeach
          
        </tbody>
      </table>
     {!! $product->links() !!}
  </div>
@endsection