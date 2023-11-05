@extends('layouts.admin')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-2">Walk-in Invoice All</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-info btn-rounded btn-fw" style="float:right"
                                href="{{ route('invoice.add') }}"><i class="fas fa-plus-circle"></i> Add Walk-in Invoice</a>
                            <br>
                            <h4 class="card-title">All Walk-in Invoices Data </h4>

                            {{-- <form action="{{ route('purchase.view') }}" target="_blank" method="get">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Select Purchase No.</label>
                                        <select name="purchase_no" class="form-select" id="purchase_no">
                                            <option value="" disabled>Select a Purchase No.</option>
                                            @foreach ($allData as $item)
                                                <option value="{{ $item->purchase_no }}">{{ $item->purchase_no }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                        <input type="submit" class="btn btn-info waves-effect waves-light" value="View">
                                    </div>
                                </div>
                            </form> <br> --}}

                            <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="5%">Sl</th>
                                        <th>Date</th>
                                        <th>Invoice No.</th>
                                        <th>Customer Name</th>
                                        <th>Status</th>
                                        <th width="10%">Amount</th>

                                </thead>


                                <tbody>
                                    @foreach ($allData as $key => $item)
                                        <tr class="text-center">
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item->date }} </td>
                                            <td> #{{ $item->invoice_no }} </td>
                                            <td> {{ $item['payments']['customer']['customer_name'] }} </td>
                                            @if ($item->status == '0')
                                                <td> <span class="btn btn-warning">Pending</span> </td>
                                            @elseif ($item->status == '1')
                                                <td> <span class="btn btn-success">Approved</span> </td>
                                            @endif
                                            <td> <span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                {{ Str::currency($item['payments']['total_amount']) }} </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
@endsection
