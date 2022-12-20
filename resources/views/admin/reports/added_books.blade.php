@extends('layout')
@section('title', 'Added Books Reports')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-25">{{ $period }} Report</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Added books</li>
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
                            <a href="{{ route('admin.report.added_books', 'weekly') }}"
                                class="btn btn-success waves-effect btn-label waves-light">
                                <i class="fa fa-calendar label-icon"></i>
                                Weekly
                            </a>
                            <a href="{{ route('admin.report.added_books', 'monthly') }}"
                                class="btn btn-warning waves-effect btn-label waves-light">
                                Monthly
                            </a>
                            <a href="{{ route('admin.report.added_books', 'semester') }}"
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
                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>

                                <th>Call Number</th>
                                <th>Access Number</th>
                                <th>Copyright</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Publisher</th>
                                <th>Edition</th>
                                <th>Added date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                @php
                                    $id = $book->id;
                                    $page = 'book';
                                @endphp
                                <tr>

                                    <td>{{ $book->call_number }}</td>
                                    <td>
                                        @foreach ($book->accessNumber as $accessNumber)
                                            {{ $accessNumber->access_number }},
                                        @endforeach
                                    </td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->copyright }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->publisher }}</td>
                                    <td>{{ $book->edition }}</td>
                                    <td class="text-info">{{ date('d-F-Y', strtotime($book->created_at)) }}</td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
