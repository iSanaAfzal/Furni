@extends('Admin.master')

@section('content')
    <div class="container pt-5 ml-5 ms-5">
        <table id="users-table" class="table table-warning table-bordered mt-5">
            <thead class="thead-lite">
                <tr class="text-dark">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->hasRole('buyer'))
                                Buyer
                            @else
                                Seller
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
