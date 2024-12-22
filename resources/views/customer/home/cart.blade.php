@extends('customer.layouts.master')

@section('content')
    <!-- Cart Page Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table" id="productTable">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>



                        @if (count($cart) != 0)
                            @foreach ($cart as $item)
                                <tr>
                                    <input type="hidden" value="{{ $item->product_id }}" class="productId">
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('productImages/' . $item->image) }}"
                                                class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                                alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4">{{ $item->name }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4 price">{{ $item->price }} mmk</p>
                                    </td>
                                    <td>
                                        <div class="input-group quantity mt-4" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text"
                                                class="form-control qty form-control-sm text-center border-0"
                                                value="{{ $item->qty }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4 total">{{ $item->price * $item->qty }} mmk</p>
                                    </td>
                                    <td>
                                        <input type="hidden" class="cartId" value="{{ $item->id }}">
                                        <button class="btn btn-md rounded-circle bg-light border mt-4 btn-remove">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <div class="m-auto">
                                <tr>
                                    <td colspan="6">
                                        <h5 class="text-muted text-center py-3">There is no product in the cart yet</h5>
                                    </td>
                                </tr>
                            </div>
                        @endif


                    </tbody>
                </table>
            </div>

            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal: </h5>
                                <p class="mb-0" id="subtotal">{{ $totalPrice }} mmk</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Delivery </h5>
                                <div class="">
                                    <p class="mb-0"> 5000 mmk </p>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4 " id="finalTotal">{{ $totalPrice + 5000 }} mmk</p>
                        </div>
                        <input type="hidden" value="{{ Auth::user()->id }}" class="userId">

                        <button id="btn-checkout"
                            class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                            type="button">Proceed Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->
@endsection

@section('js-script')
    <script>
        $(document).ready(function() {
            $('.btn-minus').click(function() {
                priceOnChange(this);
                totalCalculation();
            })
            $('.btn-plus').click(function() {
                priceOnChange(this);
                totalCalculation();
            })

            function priceOnChange(event) {
                parentNode = $(event).parents("tr");
                qty = parentNode.find('.qty').val();
                price = parentNode.find('.price').text().replace("mmk", "");
                subTotal = price * qty;

                parentNode.find('.total').text(subTotal + " mmk")
            }

            function totalCalculation() {
                total = 0;

                $('#productTable tbody tr').each(function(index, item) {
                    total += Number($(item).find(".total").text().replace("mmk", ""));

                    $('#subtotal').text(total + " mmk");
                    $('#finalTotal').text(total + 5000 + " mmk");
                })
            }

            $('.btn-remove').click(function() {
                parentNode = $(this).parents("tr");
                cartId = parentNode.find('.cartId').val();

                $.ajax({
                    type: 'GET',
                    url: '/user/cart/delete',
                    data: {
                        'cartId': cartId
                    },
                    dataType: 'json',
                    success: function(res) {
                        res.status == 'success' ? location.reload() : ''
                    }
                })
            })

            $('#btn-checkout').click(function() {
                orderList = [];
                orderCode = 'OC-POS-' + Math.floor(Math.random() * 10000000);
                userId = $('.userId').val();

                $('#productTable tbody tr').each(function(index, row) {

                    orderList.push({
                        'product_id': $(row).find('.productId').val(),
                        'user_id': userId,
                        'count': $(row).find('.qty').val(),
                        'status': 0,
                        'order_code': orderCode,
                        'totalAmt': $('#finalTotal').text().replace('mmk', '')
                    });
                });

                $.ajax({
                    type: 'GET',
                    url: '/user/order/tempStorage',
                    data: {
                        'tempOrder': JSON.stringify(orderList)
                    },
                    dataType: 'json',
                    success: function(res) {
                        res.status == 'success' ? location.href =
                            '/user/order/paymentPage' : location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        console.log('Response Text:', xhr
                            .responseText);
                    }
                })

            })

        });
    </script>
@endsection
