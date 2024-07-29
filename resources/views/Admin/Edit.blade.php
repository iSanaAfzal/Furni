@extends('Admin.master')

@section('content')
    <div class="container pt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (session('success'))
                    <div class="bg-success bg-opacity-50 rounded-lg border text-white-bold shadow-lg p-3 m-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Update Product Form -->
                <div class="card shadow-lg border-0 mt-5">
                    <div class="card-header text-center p-4" style="background:#3b5d50;">
                        <h4>Update Product</h4>
                    </div>

                    <div class="card-body p-3"style="background:white;color:black;font-weight:bold;">
                        <form action="{{ route('admin.productupdate', ['id' => $product->id]) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="productName" class="form-label ">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="name"
                                    value="{{ $product->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="productImage" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="productImage" name="image">
                                <img src="{{ $product->image }}" alt="" width="100" class="mt-2">
                            </div>
                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Product Price</label>
                                <input type="number" class="form-control" id="productPrice" name="price"
                                    value="{{ $product->price }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Product Category</label>
                                <select class="form-control" id="productCategory" name="category_id" required>
                                    @foreach ($category as $categoryItem)
                                        <option value="{{ $categoryItem->id }}">{{ $categoryItem->name }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-success">Update Product</button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
