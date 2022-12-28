@extends('layout')
@section('title', 'User Profile')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-25">{{ $period }} Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">
                            User Profile
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
                            <a href="{{ route('admin.report.profile', 'weekly') }}"
                                class="btn btn-success waves-effect btn-label waves-light">
                                <i class="fa fa-calendar label-icon"></i>
                                Weekly
                            </a>
                            <a href="{{ route('admin.report.profile', 'monthly') }}"
                                class="btn btn-warning waves-effect btn-label waves-light">
                                Monthly
                            </a>
                            <a href="{{ route('admin.report.profile', 'semester') }}"
                                class="btn btn-danger waves-effect btn-label waves-light">
                                Semester
                            </a>
                            <form action="{{ route('admin.report.profile', ['period' => 'date']) }}" method="GET"
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
                                <th>Name</th>
                                <th>Course/Year</th>
                                <th>Fully Registered</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        @if ($user->role == 1)
                                            {{ $user->name }}
                                        @elseif ($user->role == 2)
                                            {{ $user->studentDetail->fname }} {{ $user->studentDetail->lname }}
                                        @else
                                            {{ $user->facultyDetail->fname }} {{ $user->facultyDetail->lname }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->role == 2)
                                            {{ $user->studentDetail->course }}/{{ $user->studentDetail->level }}
                                        @else
                                            <span class="text-warning">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->role == 2)
                                            @if ($user->is_verified == 1)
                                                <span class="text-success">Yes</span>
                                            @else
                                                <span class="text-danger">No</span>
                                            @endif
                                        @else
                                            <span class="text-warning">N/A</span>
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
