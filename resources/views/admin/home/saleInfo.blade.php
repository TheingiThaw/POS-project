@extends('admin.layouts.master')

@section('content')
    <div class="container " style="margin-top: 40px">
        <div class="row">
            <table class="table table-hover shadow-sm ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Date</th>
                        <th>Cus Name</th>
                        <th>Order Code</th>
                        <th>Total Amount</th>
                        <th>Pay Cheque</th>
                    </tr>
                </thead>
                <tbody>

                    @if (count($saleData) != 0)
                        @foreach ($saleData as $sale)
                            <tr>
                                <td class="col-2">{{ $sale->created_at->format('j-F-Y') }}</td>
                                <td class="col-2">{{ $sale->user_name }}</td>
                                <td class="col-2">
                                    {{ $sale->order_code }}
                                </td>
                                <td class="col-2">{{ $sale->total_amt }}</td>
                                <td class="col-2"><img src="{{ asset('payslipImage/' . $sale->payslip_image) }}"
                                        class="img-thumbnail w-25" alt=""></td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
@endsection
