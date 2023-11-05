@extends('layouts.admin')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-2">Expenses</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-info btn-rounded btn-fw" style="float:right" href="{{ route('expenses.add') }}">Add Expense</a> <br>
                            <h4 class="card-title">All Expenses Data </h4>

                            <table id="datatable" class="table table-bordered table-striped dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th width="10%">Sl</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th width="20%">Action</th>

                                </thead>


                                <tbody>

                                    @foreach ($expenses as $key => $item)
                                        <tr class="text-center">
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item->expense_name }} </td>
                                            <td> <span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span> {{ Str::currency($item->expense_amount) }} </td>
                                            <td> {{ $item->created_at }} </td>
                                            <td>
                                                <a href="{{ route('expenses.edit', $item->id) }}" class="btn btn-info sm" title="Edit Data"> <i
                                                        class="far fa-edit"></i>
                                                </a>

                                                <a href="{{ route('expenses.delete', $item->id) }}" class="btn btn-danger sm" title="Delete Data"
                                                    id="delete"> <i class="far fa-trash-alt"></i> </a>

                                            </td>

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
