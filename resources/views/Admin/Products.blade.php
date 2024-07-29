@extends('Admin.master')

@section('content')
    <div class="container pt-5">
        <div class="row ">
            <div class="col-md-12">

                <h2 class="text-center mb-4 pt-5">Products</h2>
                @if (session('success'))
                    <div class="bg-success bg-opacity-50 rounded-lg border text-white-bold shadow-lg p-3 m-4">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- Add New Product button -->
                <div class="mb-3 ms-3">
                    @if (Auth::user()->hasrole('seller'))
                        <a href="{{ route('admin.productform') }}" class="btn btn-success">Add New Product</a>
                    @endif
                </div>
                <!-- Products table -->
                <div class="row ms-2">
                    <div class="col-md-12">
                        <div class="table-responsive ">
                            <table class="table table-bordered table-warning" style="background:B6C7AA;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Category_id</th>
                                        <th>Status</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td><img src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}" width="50"></td>
                                            <td>{{ $product->price }}</td>

                                            <td>{{ $product->category_id }}</td>
                                            <td>{{ $product->status }}</td>
                                            <td>
                                                @if (Auth::user()->hasRole('admin'))
                                                    {{-- Buttons for admin --}}
                                                    @if ($product->status == 'pending')
                                                        <a href="{{ route('admin.approve', $product->id) }}"
                                                            class="btn btn-success p-2 text-white font-bold">Approve</a>
                                                        <a href="{{ route('admin.reject', $product->id) }}"
                                                            class="btn btn-danger p-2 text-white font-bold">Reject</a>
                                                    @elseif($product->status == 'approve')
                                                        <span class="badge bg-success p-3">Approved</span>
                                                    @elseif($product->status == 'reject')
                                                        <span class="badge bg-danger p-3">Reject</span>
                                                    @endif
                                                @elseif (Auth::user()->hasRole('seller'))
                                                    {{-- Buttons for seller --}}


                                                    <a href="{{ route('admin.edit', $product->id) }}"
                                                        class="btn btn-success p-2 text-white font-bold">Edit</a>

                                                    <a href="{{ route('admin.delete', $product->id) }}" type="submit"
                                                        class="btn btn-danger p-2 btn-sm">Delete</a>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
