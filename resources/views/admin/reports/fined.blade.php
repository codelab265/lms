@extends('layout')
@section('title', 'Fined students')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-25">{{ $period }} Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">
                            Fined Students
                        </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-start gap-2">
                        <div class="btn-group">
                            <a href="{{ route('admin.report.fined', 'weekly') }}"
                                class="btn btn-success waves-effect btn-label waves-light">
                                <i class="fa fa-calendar label-icon"></i>
                                Weekly
                            </a>
                            <a href="{{ route('admin.report.fined', 'monthly') }}"
                                class="btn btn-warning waves-effect btn-label waves-light">
                                Monthly
                            </a>
                            <a href="{{ route('admin.report.fined', 'semester') }}"
                                class="btn btn-danger waves-effect btn-label waves-light">
                                Semester
                            </a>
                            <form action="{{ route('admin.report.fined', ['period' => 'date']) }}" method="GET"
                                id="date_range_form">
                                <input class="form-control" type="date" id="date_range" style="width: 150px"
                                    name="date">
                            </form>
                        </div>
                    </div>
                    <a name="" onclick="Print();" class="btn btn-secondary float-end" href="#" role="button">
                        <i class="fa fa-print"></i>
                        Print
                    </a>

                </div>
                <div class="card-body" id="printableArea">
                    <h4 class="mb-sm-0 font-size-25">{{ $period }} Report</h4>
                    <hr>

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Access Number</th>
                                <th>Call Number</th>
                                <th>Title</th>
                                <th>Issuer's Name</th>
                                <th>Course</th>
                                <th>Status</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                <tr>

                                    <td>{{ $reservation->access_number }}</td>
                                    <td>{{ $reservation->book->call_number }}</td>
                                    <td>{{ $reservation->book->title }}</td>

                                    <td>
                                        @if ($reservation->user->role == 2)
                                            {{ $reservation->user->studentDetail->fname }}
                                            {{ $reservation->user->studentDetail->lname }}
                                        @else
                                            {{ $reservation->user->facultyDetail->fname }}
                                            {{ $reservation->user->facultyDetail->lname }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($reservation->user->role == 3)
                                            <span class="text-warning">N/A</span>
                                        @else
                                            {{ $reservation->user->studentDetail->course }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($reservation->fines_payment)
                                            <span class="text-success">
                                                PAID
                                            </span>
                                        @else
                                            <span>
                                                <span class="text-danger">
                                                    NOT PAID
                                                </span>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ number_format($reservation->fine, 1) }}
                                    </td>

                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="6" style="text-align: right; font-weight:bolder">
                                    <span>TOTAL</span>
                                </td>
                                <th>
                                    {{ number_format($reservations->sum('fine'), 1) }}
                                </th>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
@push('script')
    <script>
        $('body').on('change', '#date_range', function() {
            var date = $(this).val();
            $('#date_range_form').submit();
        });
    </script>
@endpush
