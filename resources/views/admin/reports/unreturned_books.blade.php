@extends('layout')
@section('title', 'Unreturned Books')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-25">{{ $period }} Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">
                            Unreturned Books
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
                            <a href="{{ route('admin.report.unreturned_books', 'weekly') }}"
                                class="btn btn-success waves-effect btn-label waves-light">
                                <i class="fa fa-calendar label-icon"></i>
                                Weekly
                            </a>
                            <a href="{{ route('admin.report.unreturned_books', 'monthly') }}"
                                class="btn btn-warning waves-effect btn-label waves-light">
                                Monthly
                            </a>
                            <a href="{{ route('admin.report.unreturned_books', 'semester') }}"
                                class="btn btn-danger waves-effect btn-label waves-light">
                                Semester
                            </a>
                            <form action="{{ route('admin.report.unreturned_books', ['period' => 'date']) }}" method="GET"
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
                                <th>Book Title</th>
                                <th>Borrower's Name</th>
                                <th>Course</th>
                                <th>Date Issued</th>
                                <th>Return Date</th>
                                <th>Remaining Days</th>
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
                                        @if ($reservation->user->role == 2)
                                            {{ $reservation->user->studentDetail->course }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ date('d-F-Y', strtotime($reservation->created_at)) }}
                                    </td>
                                    <td>
                                        @if ($reservation->user->role == 3)
                                            --
                                        @else
                                            {{ date('d-F-Y', strtotime($reservation->return_date)) }}
                                        @endif
                                    </td>
                                    <td class="text-info">
                                        @if ($reservation->user->role == 3)
                                            --
                                        @else
                                            @php
                                                $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d') . ' 00:00:00');
                                                $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $reservation->return_date . ' 00:00:00');
                                                $diff_in_days = $to->diffInDays($from);
                                            @endphp
                                            @if (strtotime(date('Y-m-d')) < strtotime($reservation->return_date))
                                                {{ $diff_in_days }} {{ str_plural('day', $diff_in_days) }}
                                            @elseif (strtotime(date('Y-m-d')) == strtotime($reservation->return_date))
                                                Return Day
                                            @else
                                                Overdue with {{ $diff_in_days }} {{ str_plural('day', $diff_in_days) }}
                                            @endif
                                        @endif

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
        $('body').on('change', '#date_range', function() {
            var date = $(this).val();
            $('#date_range_form').submit();
        });
    </script>
@endpush
