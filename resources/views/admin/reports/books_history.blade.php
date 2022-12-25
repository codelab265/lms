@extends('layout')
@section('title', 'Book History')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-25">{{ $period }} Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">
                            Book History
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
                            <a href="{{ route('admin.report.books_history', 'weekly') }}"
                                class="btn btn-success waves-effect btn-label waves-light">
                                <i class="fa fa-calendar label-icon"></i>
                                Weekly
                            </a>
                            <a href="{{ route('admin.report.books_history', 'monthly') }}"
                                class="btn btn-warning waves-effect btn-label waves-light">
                                Monthly
                            </a>
                            <a href="{{ route('admin.report.books_history', 'semester') }}"
                                class="btn btn-danger waves-effect btn-label waves-light">
                                Semester
                            </a>
                        </div>
                        <a name="" onclick="Print();" class="btn btn-secondary float-right" href="#"
                            role="button">
                            <i class="fa fa-print"></i>
                            Print
                        </a>
                        <a name="" class="btn btn-primary float-right" data-bs-toggle="modal" href="#filter">
                            <i class="fa fa-filter"></i>
                            Filter
                        </a>
                    </div>
                    @include('admin.reports.filter_history')
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
                                <th>Author</th>
                                <th>Borrower's Name</th>
                                <th>Course</th>
                                <th>Status</th>
                                <th>Date Issued</th>
                                <th>Date Returned ||</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>

                                    <td>{{ $book->access_number }}</td>
                                    <td>{{ $book->call_number }}</td>
                                    <td>{{ $book->book_title }}</td>
                                    <td>{{ $book->author }}</td>

                                    <td>
                                        @if ($book->role == 2)
                                            {{ $book->fname }}
                                            {{ $book->lname }}
                                        @else
                                            {{ $book->fname }}
                                            {{ $book->lname }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($book->role == 2)
                                            {{ $book->course }}
                                        @else
                                            {{ $book->course }}
                                            <span class="text-warning">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($book->returned_date == null)
                                            <span class="text-danger">
                                                Not Returned
                                            </span>
                                        @elseif ($book->status == 3)
                                            <span class="text-success">
                                                Returned
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($book->role == 3)
                                            {{ date('d-F-Y', strtotime($book->created_at)) }}
                                        @else
                                            {{ date('d-F-Y', strtotime($book->created_at)) }}
                                        @endif
                                    </td>
                                    <td>

                                        @if ($book->returned_date == null)
                                            <h2 style="color:yellow">Pending</h2>
                                        @elseif($book->status == 3)
                                            {{ date('d-F-Y', strtotime($book->returned_date)) }}
                                        @endif

                                    </td>
                                    {{-- <td class="text-info">
                                        @php
                                            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d') . ' 00:00:00');
                                            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $book->return_date . ' 00:00:00');
                                            $diff_in_days = $to->diffInDays($from);
                                        @endphp
                                        @if (strtotime(date('Y-m-d')) < strtotime($book->return_date))
                                            {{ $diff_in_days }} {{ str_plural('day', $diff_in_days) }}
                                        @elseif (strtotime(date('Y-m-d')) == strtotime($book->return_date))
                                            Return Day

                                        @endif
                                    </td> --}}

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
        $('body').on('click', '#filter_button', function() {
            var accessNumber = $('#access_number').val();
            if (accessNumber == "") {
                alert('Access number is required');
            } else {
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.filter.book.history') }}",
                    data: {
                        access_number: accessNumber
                    },

                    success: function(response) {
                        $('#results_container').html(response);
                    }
                });
            }
        });
    </script>
@endpush
