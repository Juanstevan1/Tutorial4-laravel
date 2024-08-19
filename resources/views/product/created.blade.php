@extends('layouts.app')
@section("title", "Product Created")
@section('content')
<div class="container text-center">
  <h2>Product Created Successfully!</h2>
  <a href="{{ route('product.index') }}" class="btn btn-primary mt-4">Go to Products</a>
</div>
@endsection
