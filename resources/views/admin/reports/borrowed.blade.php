@extends('layout')
@section('title', 'Frequent Borrowing Department')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-25">{{ $period }} Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">
                            Frequent Borrowing Department
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
                            <a href="{{ route('admin.report.borrowing', 'weekly') }}"
                                class="btn btn-success waves-effect btn-label waves-light">
                                <i class="fa fa-calendar label-icon"></i>
                                Weekly
                            </a>
                            <a href="{{ route('admin.report.borrowing', 'monthly') }}"
                                class="btn btn-warning waves-effect btn-label waves-light">
                                Monthly
                            </a>
                            <a href="{{ route('admin.report.borrowing', 'semester') }}"
                                class="btn btn-danger waves-effect btn-label waves-light">
                                Semester
                            </a>
                        </div>
                        <a name="" onclick="Print();" class="btn btn-secondary float-right" href="#"
                            role="button">
                            <i class="fa fa-print"></i>
                            Print
                        </a>
                    </div>

                </div>
                <div class="card-body" id="printableArea">
                    <h4 class="mb-sm-0 font-size-25">{{ $period }} Report</h4>
                    <hr>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="card bg-warning">
                                <div class="card-body">
                                    <h3>TOP STUDENT</h3>
                                    <p>Mike</p>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info">
                                <div class="card-body">
                                    <h3>TOP FACULTY</h3>
                                    <p>Mike</p>

                                </div>
                            </div>
                        </div>
                    </div>

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Course</th>
                                <th>Times borrowed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                @if ($reservation->user->role == 2)
                                    <tr>

                                        <td>{{ $reservation->user->studentDetail->fname }}
                                            {{ $reservation->user->studentDetail->lname }}</td>
                                        <td>{{ $reservation->user->studentDetail->course }}</td>
                                        <td>{{ $reservation->total }}</td>

                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
