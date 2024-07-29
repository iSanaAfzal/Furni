@extends('Admin.master')
@section('content')
    <div class="container pt-5 ml-5 ms-5">
        <table id="users-table" class="table table-warning table-bordered mt-5">
            <thead class="thead-lite">
                <tr class="text-dark">
                    <th scope="col">id</th>
                    <th scope="col">Order_id</th>
                    <th scope="col">Product_id</th>
                    <th scope="col">Quantity</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($orderdetails as $orderdetail)
                    <tr>
                        <td>{{ $orderdetail->id }}</td>
                        <td>{{ $orderdetail->order_id }}</td>
                        <td>{{ $orderdetail->product_id }}</td>
                        <td>{{ $orderdetail->Quantity }}</td>
                    </tr>
                @endforeach()

            </tbody>
        </table>
    </div>
@endsection()
