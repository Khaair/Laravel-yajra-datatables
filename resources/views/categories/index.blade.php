@extends('layout')

@section('content')
<div>
   <div class="text-right mb-5">
   <button class="btn btn-success" id="createNew">Add New</button>
   </div>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Category Name</th>
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Include Modal -->
@include('categories.partials.modal')

<!-- Pass the route URL to JavaScript -->
<script>
    var categoriesIndexRoute = "{{ route('categories.index') }}";
    var categoriesStoreRoute = "{{ route('categories.store') }}";
</script>

<!-- Include JavaScript File -->
<script src="{{ asset('js/categories.js') }}"></script>

@endsection