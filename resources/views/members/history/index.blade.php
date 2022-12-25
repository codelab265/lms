@extends('layout')
@section('title', 'Payment History')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-25">
                    @yield('title')
                </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Books</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>

                                <th>Book title</th>
                                <th>Access Number</th>
                                <th>Amount Paid</th>
                                <th>Paid on</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fines_payments as $fines_payment)
                                @php
                                    $id = $fines_payment->id;
                                @endphp
                                <tr>

                                    <td>{{ $fines_payment->book_title }}</td>
                                    <td>{{ $fines_payment->access_number }}</td>

                                    <td>

                                        ${{ $fines_payment->amount_paid }}

                                    </td>
                                    <td>

                                        {{ date('d-F-Y', strtotime($fines_payment->created_at)) }}

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
