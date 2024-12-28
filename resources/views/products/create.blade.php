@extends('layout')

@section('content')


<div class="card pb-5">
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h1 class="mb-4">Create Category</h1>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <input type="hidden" name="my_id" id="my_id">
        <!-- Main container for dynamic sections -->
        <div id="dynamic-sections">
            <!-- First title and body section -->
            <div class="section">
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="title" name="title[]"
                            placeholder="Enter Title" maxlength="50" required="">
                        <span class="text-danger" id="titleError"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Body</label>
                    <div class="col-sm-12">
                        <textarea id="body" name="body[]" required="" placeholder="Enter Body"
                            class="form-control"></textarea>
                        <span class="text-danger" id="bodyError"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="category_id">Category:</label>
                    <div class="col-sm-12">
                        <select name="category_id[]" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="category_idError"></span>
                    </div>
                </div>

            </div>
        </div>
        <!-- Add More button -->
        <div class="form-group">
            <div class="col-sm-12 text-right">
                <button type="button" id="addMoreBtn" class="btn btn-success">Add More</button>
            </div>
        </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
</div>


@endsection