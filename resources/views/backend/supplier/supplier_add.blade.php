@extends('layouts.admin')
@section('admin')


    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Supplier </h4><br><br>


                            @if (count($errors))
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger alert-dismissible fade show"> {{ $error }} </p>
                                @endforeach
                            @endif


                            <form method="post" action="">
                                @csrf

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Name</label>
                                    <div class="col-sm-10">
                                        <input name="supplier_name" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->
                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Mobile No.</label>
                                    <div class="col-sm-10">
                                        <input name="supplier_phone" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Email</label>
                                    <div class="col-sm-10">
                                        <input name="supplier_email" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Address Line 1</label>
                                    <div class="col-sm-10">
                                        <input name="supplier_address1" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Address Line 2</label>
                                    <div class="col-sm-10">
                                        <input name="supplier_address2" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-10">
                                        <input name="supplier_city" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Province</label>
                                    <div class="col-sm-10">
                                        <input name="supplier_province" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Postal Code</label>
                                    <div class="col-sm-10">
                                        <input name="supplier_zipcode" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Supplier">
                            </form>



                        </div>
                    </div>
                </div> <!-- end col -->
            </div>


        </div>
    </div>



@endsection
