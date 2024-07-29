@extends('Admin.master')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center pt-5">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header text-center text-white"style="background:#3b5d50;">
                        <h4 class="p-2">Add New Product</h4>
                    </div>
                    <div
                        class="card-body p-4 "style="background:white;color:black;
                                                                                                                                                                            font-weight:600;">
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Product Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <!-- Product Image -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" id="image" name="image" class="form-control">
                            </div>
                            <!-- Product Price -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" id="price" name="price" class="form-control" step="0.01"
                                    required>
                            </div>
                            <!-- Product Category -->
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select id="category_id" name="category_id" class="form-select" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach()

                                </select>
                            </div>
                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-danger text-white text-bold">Add Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
