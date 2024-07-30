@extends('Admin.master')
@section('content')
    <div class="container pt-5 ml-5 ms-5">
        <table id="users-table" class="table table-warning table-bordered mt-5">
            <thead class="thead-lite">
                <tr class="text-dark">
                    <th scope="col">ID</th>
                    <th scope="col">Order_id</th>
                    <th scope="col"> Prdouct Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($orderdetail as $detail)
                    <tr>

                        <th>{{ $detail->id }}</th>
                        <th>{{ $detail->order_id }}</th>
                        <th>{{ $detail->products->name }}</th>
                        <th>{{ $detail->products->price }}</th>
                        <th>{{ $detail->Quantity }}</th>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection()
