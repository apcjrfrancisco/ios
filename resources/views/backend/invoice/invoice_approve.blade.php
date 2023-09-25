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
            @php
                $payment = App\Models\Payment::where('invoice_id', $invoice->id)->first();
            @endphp
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Invoice No: #{{ $invoice->invoice_no }} - {{ date('m-d-Y', strtotime($invoice->date)) }}
                            </h4>
                            <a class="btn btn-dark btn-rounded btn-fw" style="float:right"
                                href="{{ route('invoice.pending.list') }}"><i class="fa fa-list"></i> Pending Invoice
                                List</a>
                            <br>

                            <table class="table table-dark" width="100%">
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>Customer Info</p>
                                        </td>
                                        <td>
                                            <p>Name: <strong>{{ $payment['customer']['customer_name'] }}</strong></p>
                                        </td>
                                        <td>
                                            <p>Phone No.: <strong>{{ $payment['customer']['customer_phone'] }}</strong></p>
                                        </td>
                                        <td>
                                            <p>Email: <strong>{{ $payment['customer']['customer_email'] }}</strong></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>

                            <form action="{{ route('approval.store', $invoice->id) }}" method="post">
                                @csrf
                                <table border="1" class="table table-dark" width="100%">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Sl</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Product</th>
                                            <th style="background-color: #8B008B">Current Stock</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_sum = '0';
                                        @endphp
                                        @foreach ($invoice['invoice_details'] as $key => $details)
                                            <tr class="text-center">
                                                <input type="hidden" name="category_id[]" value="{{ $details->category_id }}">
                                                <input type="hidden" name="brand_id[]" value="{{ $details->brand_id }}">
                                                <input type="hidden" name="product_id[]" value="{{ $details->product_id }}">
                                                <input type="hidden" name="selling_qty[{{ $details->id }}]" value="{{ $details->selling_qty }}">
                                                
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $details['category']['category_name'] }}</td>
                                                <td>{{ $details['brand']['brand_name'] }}</td>
                                                <td>{{ $details['product']['product_name'] }}</td>
                                                <td style="background-color: #8B008B">{{ $details['product']['quantity'] }}
                                                </td>
                                                <td>{{ $details->selling_qty }}</td>
                                                <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                    {{ Str::currency($details->unit_price) }}</td>
                                                <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                    {{ Str::currency($details->price) }}</td>
                                            </tr>
                                            @php
                                                $total_sum += $details->price;
                                                $without_vat = $payment->total_amount - $payment->total_amount * 0.12;
                                                $vat = $payment->total_amount * 0.12;
                                                
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="7"><strong>Sub Total</strong></td>
                                            <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                {{ Str::currency($total_sum) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="7"><strong>Discount:</strong></td>
                                            <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                {{ Str::currency($payment->discount_amount) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="7"><strong>Paid Amount:</strong></td>
                                            <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                {{ Str::currency($payment->paid_amount) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="7"><strong>Due Amount:</strong></td>
                                            <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                {{ Str::currency($payment->due_amount) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="7"><strong>Without VAT:</strong></td>
                                            <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                {{ Str::currency($without_vat) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="7"><strong>VAT 12%:</strong></td>
                                            <td><span style="font-family: DejaVu Sans; sans-serif;">&#8369;</span>
                                                {{ Str::currency($vat) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="7"><strong style="font-size:20px">Total Amount:</strong></td>
                                            <td><span
                                                    style="font-family: DejaVu Sans; sans-serif;font-size:20px">&#8369;</span>
                                                <strong
                                                    style="font-size:20px">{{ Str::currency($payment->total_amount) }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <button type="submit" style="float: right" class="btn btn-info">Approve</button>

                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
@endsection
