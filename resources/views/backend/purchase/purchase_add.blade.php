@extends('layouts.admin')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Purchase Page </h4><br><br>

                            <div class="row">
                                
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label class="col-form-label">Date</label>
                                        <input class="form-control example-date-input" type="date" name="date" id="date">
                                    </div>
                                </div> <!-- end div -->

                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label class="col-form-label">Purchase No.</label>
                                        <input class="form-control example-date-input" type="text" name="purchase_no" id="purchase_no">
                                    </div>
                                </div> <!-- end div -->

                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label class="col-form-label">Supplier</label>
                                        <select name="supplier_id" class="form-select" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                            @foreach ($supplier as $item)
                                                <option value="{{ $item->id }}">{{ $item->supplier_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> <!-- end div -->

                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label class="col-form-label">Category</label>
                                        <select id="category_id" name="category_id" class="form-select" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                        </select>
                                    </div>
                                </div> <!-- end div -->

                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label class="col-form-label">Brand</label>
                                        <select id="brand_id" name="brand_id" class="form-select" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                        </select>
                                    </div>
                                </div> <!-- end div -->

                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label class="col-form-label">Product Name</label>
                                        <select id="product_id" name="product_id" class="form-select" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                        </select>
                                    </div>
                                </div> <!-- end div --> 

                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label class="col-form-label"></label>
                                        <input type="submit" class="btn btn-dark btn-rounded btn-fw" style="margin-top: 40px" value="Add More">
                                    </div>
                                </div> <!-- end div -->

                            </div> <!-- end row -->

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>


@endsection
