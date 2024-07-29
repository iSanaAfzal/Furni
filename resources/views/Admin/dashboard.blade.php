@extends('Admin.master')
@section('content')
    <style>
        .card-icon {
            font-size: 2rem;
        }

        .card-body {
            text-align: center;
        }

        .card {
            margin: 1rem;
            max-width: 300px;
            margin-left: auto;
            margin-right: auto;
            transform: translateY(50px);
            opacity: 0;
            animation: fadeInUp 1s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .card:hover {
            transform: scale(1.05);
            transition: transform 0.3s ease-in-out;
        }
    </style>
    </head>

    <body>
        <div class="container mt-5">
            <div class="row" style="margin-top:9rem;">
                <!-- Total Products Card -->
                <div class="col-md-6 d-flex justify-content-center">
                    <div class="card w-75" style="background: #416859">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="card-icon">
                                    <!-- Bootstrap Icons for product -->
                                </div>
                            </div>
                            <h5 class="card-title mt-3">
                                <i class="fas fa-box me-3"></i>
                                <!-- Icon next to the title -->
                                Total Products
                            </h5>
                            <p class="card-text">{{ $products }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Users Card -->
                <div class="col-md-6 d-flex justify-content-center">
                    <div class="card w-75" style="background: #416859">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="card-icon">
                                    <i class="bi bi-person"></i> <!-- Bootstrap Icons for user -->
                                </div>
                            </div>
                            <h5 class="card-title mt-3">
                                <i class="fas fa-users me-3"></i>
                                <!-- Icon next to the title -->
                                Total Users
                            </h5>
                            <p class="card-text">{{ $user }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
