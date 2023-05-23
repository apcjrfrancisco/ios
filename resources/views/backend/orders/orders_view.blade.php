@extends('layouts.admin')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-2">Order Details</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="shadow bg-white p-3">

                <h4 class="text-primary">
                    <i class="fa fa-shopping-cart text-dark"></i> Order Details
                    <a href="{{ route('orders') }}" class="btn btn-danger btn-sm float-end">Back</a>
                </h4>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h5>Order Details</h5>
                        <hr>
                        <h6>Order ID: {{ $order->id }}</h6>
                        <h6>Tracking No.: {{ $order->tracking_no }}</h6>
                        <h6>Order Created: {{ $order->created_at->format('m/d/Y') }}</h6>
                        <h6>Payment Mode: {{ $order->payment_mode }}</h6>
                        <h6 class="border p-2 text-success">
                            Order Status Message: <span class="text-uppercase">{{ $order->status_message }}</span>
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <h5>User Details</h5>
                        <hr>
                        <h6>Name: {{ $order->name }}</h6>
                        <h6>Email: {{ $order->email }}</h6>
                        <h6>Phone Number: {{ $order->phone }}</h6>
                        <h6>
                            Full Address: {{ $order->address1 }}, {{ $order->address2 }},
                            {{ $order->city }}, {{ $order->province }}
                        </h6>
                        <h6>Postal Code: {{ $order->zip_code }}</h6>

                    </div>
                </div>
                <br>
                <h5>Order Items</h5>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">

                        <thead>
                            <tr class="text-center">
                                <th width="8%">Item ID</th>
                                <th width="5%">Unit</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th width="10%">Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalAmount = 0;
                            @endphp
                            @foreach ($order->orderItems as $item)
                                <tr class="text-center">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->product->unit->unit_name }}</td>
                                    <td>
                                        @if ($item->product)
                                            <img src="{{ asset($item->product->product_image) }}" width="50px"
                                                alt="">
                                        @else
                                            <img src="{{ asset('upload/no_image.jpg') }}" class="w-100" alt="Img">
                                        @endif
                                    </td>
                                    <td>{{ $item->product->product_name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td class="fw-bold">{{ $item->total_price }}</td>
                                    @php
                                        $totalAmount += $item->total_price;
                                    @endphp
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" class="fw-bold">Total Amount: </td>
                                <td class="text-center fw-bold">{{ $totalAmount }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card shadow mt-3">
                <div class="card-body">
                    <h4>Order Process</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <form action="{{ url('admin/orders/'. $order->id) }}" method="post">
                                @csrf
                                @method('PUT')

                                <label for="">Update Status</label>
                                <div class="input-group">
                                    <select name="order_status" class="form-select" id="">
                                        <option value="" disabled>Select Order Status</option>
                                        <option value="in progress"
                                            {{ Request::get('status') == 'in progress' ? 'selected' : '' }}>In Progress
                                        </option>
                                        <option value="out for delivery"
                                            {{ Request::get('status') == 'out for delivery' ? 'selected' : '' }}>Out for
                                            Delivery</option>
                                        <option value="completed"
                                            {{ Request::get('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled"
                                            {{ Request::get('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary text-white">Update</button>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-7">
                            <br>
                            <h4 class="mt-3">Order Status: <span class="text-uppercase text-success">{{ $order->status_message }}</span></h4>
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>
@endsection
