@extends('layout')

@section('content')
<div>
   <div class="text-right mb-5">
   <button class="btn btn-success" id="createNew">Add New</button>
   <!-- <a href="{{ route('products.create') }}" class="btn btn-primary mb-4">Create</a> -->
   </div>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Body</th>
                <th>Category</th>
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Include Modal -->
@include('products.partials.modal')

<!-- Pass the route URL to JavaScript -->
<script>
    var productsIndexRoute = "{{ route('products.index') }}";
    var productsStoreRoute = "{{ route('products.store') }}";
</script>

<!-- Include JavaScript File -->
<script src="{{ asset('js/products.js') }}"></script>

@endsection
