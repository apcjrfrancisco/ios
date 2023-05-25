@extends('layouts.admin')
@section('admin')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="me-md-3 me-xl-5">
                        <h2>Welcome back, {{ Auth::user()->name }}</h2>
                    </div>
                    <div class="d-flex">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body dashboard-tabs p-0">
                    <ul class="nav nav-tabs px-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview"
                                role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                        </li>
                    </ul>
                    <div class="tab-content py-0 px-0">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel"
                            aria-labelledby="overview-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-currency-usd me-3 icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Sales</small>
                                        @php
                                            $total_amount = 0;
                                            $revenue = 0;
                                        @endphp
                                        @forelse ($orderComplete as $item)
                                            @php
                                                $orderItem = App\Models\OrderItem::where('order_id', $item->id)->sum('total_price');
                                                $orderItemId = App\Models\OrderItem::where('order_id', $item->id)->first();
                                                $purchase = App\Models\Purchase::where('status', '1')->sum('buying_price');
                                                $total_amount += $orderItemId->quantity * $orderItemId->price;
                                                $revenue = $total_amount - $purchase;
                                            @endphp
                                        @empty
                                        @endforelse
                                        <h5 class="me-2 mb-0">
                                            <span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                            {{ $total_amount }}
                                        </h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-eye me-3 icon-lg text-success"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Revenue</small>
                                        <h5 class="me-2 mb-0"><span
                                                style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                            {{ $revenue }}</h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-download me-3 icon-lg text-warning"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Orders Completed</small>
                                        <h5 class="me-2 mb-0">{{ $orderCompleteCount }}</h5>
                                    </div>
                                </div>
                                <div
                                    class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-flag me-3 icon-lg text-danger"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Orders</small>
                                        <h5 class="me-2 mb-0">{{ $orderCount }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Recent Orders</h4>
                    <br>
                    <table class="table table-bordered table-striped dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th>Tracking No.</th>
                                <th>Name</th>
                                <th>Payment Mode</th>
                                <th>Ordered Date</th>
                                <th>Amount</th>
                                <th>Status Message</th>
                                <th width="20%">Action</th>

                        </thead>

                        <tbody>



                            @forelse ($orders as $item)
                                @php
                                    $orderItem = App\Models\OrderItem::where('order_id', $item->id)->sum('total_price');
                                @endphp
                                <tr class="text-center">
                                    <td> {{ $item->tracking_no }} </td>
                                    <td> {{ $item->name }} </td>
                                    <td> {{ $item->payment_mode }} </td>
                                    <td> {{ $item->created_at->format('m/d/Y') }} </td>
                                    <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                        {{ $orderItem }} </td>
                                    <td> {{ $item->status_message }} </td>
                                    <td><a href="{{ url('admin/orders/' . $item->id) }}"
                                            class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">No Orders Available</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
