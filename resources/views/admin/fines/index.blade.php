@extends('layout')
@section('title', 'Fines payments')
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
                <div class="card-header">

                    <div class="row">
                        <div class="col-md-2">
                            <div class="btn-group">
                                <a class="btn btn-primary" data-bs-toggle="modal" href="#add">
                                    <i class="fa fa-plus"></i>
                                    Add
                                </a>
                                <a class="btn btn-outline-primary" onclick="Print()">
                                    <i class="fa fa-print"></i>
                                    Print
                                </a>

                            </div>
                        </div>
                        <div class="col-md-10">
                            <form action="{{ route('admin.fines-payment.filter') }}" method="GET" id="date_range_form">
                                <input class="form-control" type="date" id="date_range" style="width: 150px"
                                    name="date">
                            </form>
                        </div>
                    </div>

                    @include('admin.fines.create')
                </div>
                <div class="card-body" id="printableArea">

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Course/Year</th>
                                <th>Book title</th>
                                <th>Access Number</th>
                                <th>Amount Paid</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fines_payments as $fines_payment)
                                @php
                                    $id = $fines_payment->id;
                                @endphp
                                <tr>
                                    <td>
                                        @if ($fines_payment->user->role == 2)
                                            {{ $fines_payment->user->studentDetail->fname }}
                                            {{ $fines_payment->user->studentDetail->mname }}
                                            {{ $fines_payment->user->studentDetail->lname }}
                                        @else
                                            {{ $fines_payment->user->facultyDetail->fname }}
                                            {{ $fines_payment->user->facultyDetail->mname }}
                                            {{ $fines_payment->user->facultyDetail->lname }}
                                        @endif
                                    </td>
                                    <td>{{ $fines_payment->course }}</td>
                                    <td>{{ $fines_payment->book_title }}</td>
                                    <td>{{ $fines_payment->access_number }}</td>

                                    <td>

                                        ${{ $fines_payment->amount_paid }}

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
@push('script')
    <script>
        $('body').on('change', '#user_id', function() {
            var user_id = $(this).val();
            if (user_id == "") {
                return false
            } else {
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.fines.reservation') }}",
                    data: {
                        id: user_id
                    },

                    success: function(response) {
                        $('#reservation_id').html(response.html)
                    }
                });

            }

        })

        $('body').on('change', '#date_range', function() {
            var date = $(this).val();
            if (date != "") {
                $('#date_range_form').submit();
            }
        })

        $('body').on('change', '#reservation_id', function() {
            var id = $(this).val();
            if (id != "") {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.fines.reservation.details') }}",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        $("#book_title").val(response.book);
                        $("#course").val(response.course + "/" + response.year);
                        $("#access_number").val(response.access_number);
                        $("#amount_to_pay").val(response.amount_to_pay);
                    }
                });
            } else {
                return false
            }
        });
    </script>
@endpush
