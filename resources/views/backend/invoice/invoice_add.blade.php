@extends('layouts.admin')
@section('admin')
    @php
        $random = Illuminate\Support\Str::random(5);
    @endphp
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Walk-in Invoice Page </h4><br><br>

                            <div class="row">


                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Invoice No.</label>
                                        <input class="form-control example-date-input" name="invoice_no" type="text"
                                            value="{{ $invoice_no }}" id="invoice_no" readonly
                                            style="background-color:#ddd">
                                    </div>
                                </div> <!-- end div -->

                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label class="col-form-label">Date</label>
                                        <input class="form-control example-date-input" type="date"
                                            value="{{ $date }}" name="date" id="date">
                                    </div>
                                </div> <!-- end div -->




                                <div class="col-md-3">
                                    <div class="md-3">
                                        <label class="col-form-label">Category</label>
                                        <select id="category_id" name="category_id" class="form-select select2"
                                            aria-label="Default select example">
                                            <option selected="">Select Category</option>
                                            @foreach ($category as $item)
                                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> <!-- end div -->

                                <div class="col-md-3">
                                    <div class="md-3">
                                        <label class="col-form-label">Brand</label>
                                        <select id="brand_id" name="brand_id" class="form-select select2"
                                            aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                        </select>
                                    </div>
                                </div> <!-- end div -->

                                <div class="col-md-3">
                                    <div class="md-3">
                                        <label class="col-form-label">Product Name</label>
                                        <select id="product_id" name="product_id" class="form-select select2"
                                            aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                        </select>
                                    </div>
                                </div> <!-- end div -->

                                <div class="col-md-1">
                                    <div class="md-3">
                                        <label class="col-form-label">Stock</label>
                                        <input class="form-control example-date-input" type="text" readonly
                                            name="current_stock_qty" id="current_stock_qty">
                                    </div>
                                </div> <!-- end div -->

                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label class="col-form-label"></label>
                                        <i class="btn btn-dark btn-rounded btn-fw fas fa-plus-circle addeventmore"
                                            style="margin-top: 40px"> Add More</i>
                                    </div>
                                </div> <!-- end div -->

                            </div> <!-- end row -->

                        </div>

                        <div class="card-body">

                            <form action="{{ route('invoice.store') }}" method="post">
                                @csrf
                                <table class="table-sm table-bordered" width="100%" style="border-color: #ddd">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Product Name</th>
                                            <th width="7%">Quantity</th>
                                            <th width="10%">Unit Price</th>
                                            <th width="15%">Total Price</th>
                                            <th width="7%">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody id="addRow" class="addRow">

                                    </tbody>

                                    <tbody>

                                        <tr>
                                            <td colspan="5"> Discount </td>
                                            <td>
                                                <input type="text" name="discount_amount" placeholder="Discount Amount"
                                                    id="discount_amount" class="form-control discount_amount">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="5">Grand Total</td>
                                            <td>
                                                <input type="text" name="estimated_amount" value="0"
                                                    id="estimated_amount" class="form-control estimated_amount" readonly
                                                    style="background-color: #ddd;">
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>

                                </table> <br>

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="">Payment Status</label>
                                        <select name="paid_status" id="paid_status" class="form-select">
                                            <option value="" disabled>Select Status</option>
                                            <option value="full_payment">Full Payment</option>
                                            <option value="full_due">Full Due</option>
                                            <option value="partial_payment">Partial Payment</option>
                                        </select>
                                        <br>
                                        <input type="text" name="paid_amount" class="form-control paid_amount"
                                            placeholder="Enter Payment" style="display: none">
                                    </div>

                                    <div class="form-group col-md-9">
                                        <label for="">Customer Name</label>
                                        <select name="customer_id" id="customer_id" class="form-select">
                                            <option value="">Select Customer</option>
                                            @foreach ($customer as $item)
                                                <option value="{{ $item->id }}">{{ $item->customer_name }} -
                                                    {{ $item->customer_phone }}</option>
                                            @endforeach
                                            <option value="0">New Customer</option>
                                        </select>
                                    </div>

                                </div><br>

                                <div class="row new_customer" style="display: none">
                                    <div class="form-group col-md-4">
                                        <input type="text" name="customer_name" id="customer_name"
                                            class="form-control" placeholder="Customer Name">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="customer_phone" id="customer_phone"
                                            class="form-control" placeholder="Customer Phone">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="email" name="customer_email" id="customer_email"
                                            class="form-control" placeholder="Customer Email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-info" id="storeButton">Add Invoice</button>
                                </div>

                            </form>

                        </div>

                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>

    <script id="document-template" type="text/x-handlebars-template">

        <tr class="delete_add_more_item text-center" id="delete_add_more_item">
            <input type="hidden" name="date" value="@{{date}}">
            <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
            

            <td>
                <input type="hidden" name="category_id[]" value="@{{category_id}}">
                @{{ category_name }}
            </td>

            <td>
                <input type="hidden" name="brand_id[]" value="@{{brand_id}}">
                @{{ brand_name }}
            </td>

            <td>
                <input type="hidden" name="product_id[]" value="@{{product_id}}">
                @{{ product_name }}
            </td>

            <td>
                <input type="number" min="1" class="form-control selling_qty text-right" name="selling_qty[]" value="">
            </td>

            <td>
                <input type="text" class="form-control unit_price text-right" name="unit_price[]" value="">
            </td>

            <td>
                <input type="text" class="form-control price text-right" name="price[]" value="0" readonly>
            </td>

            <td>
                <i class="btn btn-danger btn-sm fas fa-window-close removeeventmore"></i>
            </td>

        </tr>

    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on("click", ".addeventmore", function() {
                var date = $('#date').val();
                var invoice_no = $('#invoice_no').val();
                var category_id = $('#category_id').val();
                var category_name = $('#category_id').find('option:selected').text();
                var brand_id = $('#brand_id').val();
                var brand_name = $('#brand_id').find('option:selected').text();
                var product_id = $('#product_id').val();
                var product_name = $('#product_id').find('option:selected').text();

                if (date == '') {
                    $.notify("Date is required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                if (category_id == '') {
                    $.notify("Category is required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                if (brand_id == '') {
                    $.notify("Brand is required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                if (product_id == '') {
                    $.notify("Product is required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }

                var source = $("#document-template").html();
                var template = Handlebars.compile(source);
                var data = {
                    date: date,
                    invoice_no: invoice_no,
                    category_id: category_id,
                    category_name: category_name,
                    brand_id: brand_id,
                    brand_name: brand_name,
                    product_id: product_id,
                    product_name: product_name

                };
                var html = template(data);
                $('#addRow').append(html);

            });

            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
            });

            $(document).on('keyup click', '.unit_price, .selling_qty', function() {
                var unit_price = $(this).closest("tr").find("input.unit_price").val();
                var qty = $(this).closest("tr").find("input.selling_qty").val();
                var total = unit_price * qty;
                $(this).closest("tr").find("input.price").val(total);
                $('#discount_amount').trigger('keyup');
            });

            $(document).on('keyup', '#discount_amount', function() {
                totalAmountPrice();
            });

            function totalAmountPrice() {
                var sum = 0;
                $(".price").each(function() {
                    var value = $(this).val();
                    if (!isNaN(value) && value.length != 0) {
                        sum += parseFloat(value);
                    }
                });

                var discount_amount = parseFloat($('#discount_amount').val());
                if (!isNaN(discount_amount) && discount_amount.length != 0) {
                    sum -= parseFloat(discount_amount);
                }

                $('#estimated_amount').val(sum);
            }

        });
    </script>


    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#category_id', function() {
                var category_id = $(this).val();
                $.ajax({
                    url: "{{ route('get-brand') }}",
                    type: "GET",
                    data: {
                        category_id: category_id
                    },
                    success: function(data) {
                        var html = '<option value="">Select Brand</option>';
                        $.each(data, function(key, v) {
                            html += '<option value=" ' + v.id + ' "> ' + v.brand_name +
                                '</option>';
                        });
                        $('#brand_id').html(html);
                    }
                })
            });
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#brand_id', function() {
                var brand_id = $(this).val();
                $.ajax({
                    url: "{{ route('get-product') }}",
                    type: "GET",
                    data: {
                        brand_id: brand_id
                    },
                    success: function(data) {
                        var html = '<option value="">Select Product</option>';
                        $.each(data, function(key, v) {
                            html += '<option value=" ' + v.id + ' "> ' + v
                                .product_name +
                                '</option>';
                        });
                        $('#product_id').html(html);
                    }
                })
            });
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#product_id', function() {
                var product_id = $(this).val();
                $.ajax({
                    url: "{{ route('check-product-stock') }}",
                    type: "GET",
                    data: {
                        product_id: product_id
                    },
                    success: function(data) {
                        $('#current_stock_qty').val(data);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).on('change', '#paid_status', function() {
            var paid_status = $(this).val();
            if (paid_status == 'partial_payment') {
                $('.paid_amount').show();
            } else {
                $('.paid_amount').hide();
            }
        });

        $(document).on('change', '#customer_id', function() {
            var customer_id = $(this).val();
            if (customer_id == '0') {
                $('.new_customer').show();
            } else {
                $('.new_customer').hide();
            }
        });
    </script>
@endsection
