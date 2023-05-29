@extends('layouts.admin')
@section('admin')
    @php
        $random = Illuminate\Support\Str::random(10);
    @endphp
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
                                        <input class="form-control example-date-input" type="date" name="date"
                                            id="date">
                                    </div>
                                </div> <!-- end div -->

                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label class="col-form-label">Purchase No.</label>
                                        <input class="form-control example-date-input" type="text" readonly
                                            value="TM - {{ $random }}" name="purchase_no" id="purchase_no">
                                    </div>
                                </div> <!-- end div -->

                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label class="col-form-label">Supplier</label>
                                        <select id="supplier_id" name="supplier_id" class="form-select"
                                            aria-label="Default select example">
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
                                        <select id="category_id" name="category_id" class="form-select"
                                            aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                        </select>
                                    </div>
                                </div> <!-- end div -->

                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label class="col-form-label">Brand</label>
                                        <select id="brand_id" name="brand_id" class="form-select"
                                            aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                        </select>
                                    </div>
                                </div> <!-- end div -->

                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label class="col-form-label">Product Name</label>
                                        <select id="product_id" name="product_id" class="form-select"
                                            aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                        </select>
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

                            <form action="{{ route('purchase.store') }}" method="post">
                                @csrf

                                <table class="table-sm table-bordered" width="100%" style="border-color: #ddd">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th width="15%">Total Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody id="addRow" class="addRow">

                                    </tbody>

                                    <tbody>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td>
                                                <input type="text" name="estimated_amount" value="0"
                                                    id="estimated_amount" class="form-control estimated_amount" readonly
                                                    style="background-color: #ddd;">
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>

                                </table> <br>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-info" id="storeButton">Add Purchase</button>
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
            <input type="hidden" name="purchase_no" value="@{{purchase_no}}">
            <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">

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
                <input type="number" min="1" class="form-control buying_qty text-right" name="buying_qty[]" value="">
            </td>

            <td>
                <input type="text" class="form-control unit_price text-right" name="unit_price[]" value="">
            </td>

            <td>
                <input type="text" class="form-control buying_price text-right" name="buying_price[]" value="0" readonly>
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
                var purchase_no = $('#purchase_no').val();
                var supplier_id = $('#supplier_id').val();
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
                if (purchase_no == '') {
                    $.notify("Date is required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                if (supplier_id == '') {
                    $.notify("Supplier is required", {
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
                    purchase_no: purchase_no,
                    supplier_id: supplier_id,
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

            $(document).on('keyup click', '.unit_price, .buying_qty', function() {
                var unit_price = $(this).closest("tr").find("input.unit_price").val();
                var qty = $(this).closest("tr").find("input.buying_qty").val();
                var total = unit_price * qty;
                $(this).closest("tr").find("input.buying_price").val(total);
                totalAmountPrice();
            });

            function totalAmountPrice() {
                var sum = 0;
                $(".buying_price").each(function() {
                    var value = $(this).val();
                    if (!isNaN(value) && value.length != 0) {
                        sum += parseFloat(value);
                    }
                });
                $('#estimated_amount').val(sum);
            }

        });
    </script>

    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#supplier_id', function() {
                var supplier_id = $(this).val();
                $.ajax({
                    url: "{{ route('get-category') }}",
                    type: "GET",
                    data: {
                        supplier_id: supplier_id
                    },
                    success: function(data) {
                        var html = '<option value="">Select Category</option>';
                        $.each(data, function(key, v) {
                            html += '<option value=" ' + v.category_id + ' "> ' + v
                                .category.category_name +
                                '</option>';
                        });
                        $('#category_id').html(html);
                    }
                })
            });
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
@endsection
