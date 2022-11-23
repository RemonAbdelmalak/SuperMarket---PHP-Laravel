@extends('product.layout')

@section('content')

<div class="container" style="padding-top: 12%">
    <div class="card" >
        <div class="card-body">
          <p class="card-text"><span> <a href="{{ route('products.index')}}">Back</a></span> Product Name: {{ $product->name }}</p>
        </div>
      </div>
</div>


<div class="container" style="padding-top: 2%">
  
    <form action="{{route('products.update',$product->id)}}" method="POST">
        @csrf
        @method('PUT')
          <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" name ="name" value="{{ $product->name }}" class="form-control" placeholder="product name">
          </div>
        
          <div class="form-group">
              <label for="exampleFormControlInput1">Price</label>
              <input type="text" name ="price" value="{{ $product->price }}" class="form-control" placeholder="product price">
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Bio</label>
            <textarea class="form-control" name="bio" rows="3">
                {!! $product->bio !!}
            </textarea>
          </div>

          <div class="form-group">
              <button type="submit" class="btn btn-primary">Update</button>
          </div>
    </form>
</div>

@endsection