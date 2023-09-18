@extends('layouts.admin')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Customer </h4>

                            <form method="post" action="{{ route('customer.store') }}" id="myForm">
                                @csrf

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Customer Name</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="customer_name" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->
                                
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Customer Mobile No.</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="customer_phone" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Customer Email</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="customer_email" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Address Line 1</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="customer_address1" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Address Line 2</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="customer_address2" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">City</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="customer_city" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Province</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="customer_province" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Postal Code</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="customer_zipcode" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Customer">
                            </form>



                        </div>
                    </div>
                </div> <!-- end col -->
            </div>


        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    customer_name: {
                        required : true,
                    }, 
                    customer_phone: {
                        required : true,
                    }, 
                    customer_email: {
                        required : true,
                    }, 
                    customer_address1: {
                        required : true,
                    }, 
                    customer_city: {
                        required : true,
                    }, 
                    customer_province: {
                        required : true,
                    }, 
                    customer_zipcode: {
                        required : true,
                    }, 
                },
                messages :{
                    customer_name: {
                        required : 'Please Enter Customer Name',
                    },
                    customer_phone: {
                        required : 'Please Enter Customer Mobile No.',
                    },
                    customer_email: {
                        required : 'Please Enter Customer Email',
                    },
                    customer_address1: {
                        required : 'Please Enter Customer Address Line 1',
                    },
                    customer_city: {
                        required : 'Please Enter Customer City',
                    },
                    customer_province: {
                        required : 'Please Enter Customer Province',
                    },
                    customer_zipcode: {
                        required : 'Please Enter Customer Postal Code',
                    },
                },
                errorElement : 'span', 
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
        
    </script>


@endsection
