@extends('Admin.master')
@section('content')
    <div class="container pt-5 ml-5 ms-5">
        <table id="users-table" class="table table-warning table-bordered mt-5">
            <thead class="thead-lite">
                <tr class="text-dark">
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Total Bill</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->first_name }}</td>
                        <td>{{ $order->last_name }}</td>
                        <td>{{ $order->email_address }}</td>
                        <td>{{ $order->total_bill }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}"
                                class="btn btn-success text-white text-bold">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
