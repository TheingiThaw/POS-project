@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <a href="{{ route('order#list') }}" class=" text-black m-3"> <i class="fa-solid fa-arrow-left-long"></i> Back</a>

        <!-- DataTales Example -->


        <div class="row">
            <div class="card col-5 shadow-sm m-4 col">
                <div class="card-header bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">Customer Information</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-5">Name :</div>
                        <div class="col-7">{{ $orders[0]->user_name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Phone :</div>
                        <div class="col-7">
                            {{ $orders[0]->phone }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Addr :</div>
                        <div class="col-7">
                            {{ $paymentHistory->address }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Order Code :</div>
                        <div class="col-7" id="orderCode">{{ $orders[0]->order_code }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Order Date :</div>
                        <div class="col-7">{{ $orders[0]->created_at->format('j-F-Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Total Price :</div>
                        <div class="col-7">
                            {{ $paymentHistory->total_amt }} mmk<br>
                            <small class=" text-danger ms-1">( Contain Delivery Charges )</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card col-5 shadow-sm m-4 col">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Purchase Information</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-5">Contact Phone :</div>
                        <div class="col-7">{{ $paymentHistory->phone }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Payment Method :</div>
                        <div class="col-7">{{ $paymentHistory->payment_method }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Purchase Date :</div>
                        <div class="col-7">{{ $paymentHistory->created_at->format('j-F-Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <img style="width: 150px" src="{{ asset('payslipImage/' . $paymentHistory->payslip_image) }}"
                            class=" img-thumbnail">
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-white">Order Board</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover shadow-sm " id="productTable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="col-2">Image</th>
                                <th>Name</th>
                                <th>Order Count</th>
                                <th>Available Stock</th>
                                <th>Product Price (each)</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($orders as $order)
                                <tr>
                                    <input type="hidden" class="productId" value="{{ $order->id }}">
                                    <input type="hidden" class="productOrderCount" value="{{ $order->order_count }}">
                                    <input type="hidden" class="userId" value="{{ $order->user_id }}">

                                    <td>
                                        <img src="{{ asset('productImages/' . $order->image) }}"
                                            class=" w-50 img-thumbnail">
                                    </td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->order_count }}
                                        @if ($order->order_count > $order->stock)
                                            <small class="text-danger">(out of stock)</small>
                                        @endif
                                    </td>
                                    <td><span class="productStock">{{ $order->stock }}</span></td>
                                    <td>{{ $order->price }} mmk</td>
                                    <td>{{ $order->price * $order->stock }} mmk</td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <div class="">
                    @if ($stockValidation)
                        <input type="button" id="btn-order-confirm" class="btn btn-success rounded shadow-sm"
                            value="Confirm">
                    @endif
                    <input type="button" id="btn-order-reject" class="btn btn-danger rounded shadow-sm" value="Reject">
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('js-script')
    <script>
        $('#btn-order-reject').click(function() {
            orderCode = $('#orderCode').text();
            $.ajax({
                type: 'GET',
                url: '/admin/order/reject',
                data: {
                    'orderCode': orderCode
                },
                success: function(res) {
                    res.status == 'success' ? location.href = '/admin/order/list' : location.reload();
                }
            });
        });

        $('#btn-order-confirm').click(function() {
            orderCode = $('#orderCode').text();
            productId = $('.productId').val();
            productOrderCount = $('.productOrderCount').val();
            productStock = $('.productStock').text();
            userId = $('.userId').val();

            data = {
                'orderCode': orderCode,
                'productId': productId,
                'productOrderCount': productOrderCount,
                'productStock': productStock
            };

            $.ajax({
                type: 'GET',
                url: '/admin/order/confirm',
                data: data,
                success: function(res) {
                    if (res.status === 'success') {
                        location.href = '/admin/order/list'; // Redirect on success
                    }
                }
            })

        });
    </script>
@endsection
