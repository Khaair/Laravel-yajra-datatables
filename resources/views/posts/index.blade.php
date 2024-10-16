@extends('layout')

@section('content')
<div>
    <button class="btn btn-success" id="createNewPost">Create New Post</button>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Body</th>
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Include Modal -->
@include('posts.partials.modal')

<!-- Pass the route URL to JavaScript -->
<script>
    var postsIndexRoute = "{{ route('posts.index') }}";
    var postsStoreRoute = "{{ route('posts.store') }}";
</script>

<!-- Include JavaScript File -->
<script src="{{ asset('js/posts.js') }}"></script>

@endsection
