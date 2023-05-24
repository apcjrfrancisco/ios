@extends('layouts.admin')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-2">Stocks</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-info btn-rounded btn-fw" style="float:right"
                                href="{{ route('stock.report.pdf') }}" target="_blank"> <i class="fa fa-print"></i> Stock Print</a> <br>
                            <h4 class="card-title">All Stocks Data </h4>

                            <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="5%">Sl</th>
                                        <th>Supplier</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Unit</th>
                                        <th>Product Name</th>
                                        <th>Stock</th>

                                </thead>


                                <tbody>

                                    @foreach ($allData as $key => $item)
                                        <tr class="text-center">
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item['supplier']['supplier_name'] }} </td>
                                            <td> {{ $item['category']['category_name'] }} </td>
                                            <td> {{ $item['brand']['brand_name'] }} </td>
                                            <td> {{ $item['unit']['unit_name'] }} </td>
                                            <td> {{ $item->product_name }} </td>
                                            <td> {{ $item->quantity }} </td>
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
