@extends('layout')
@section('title', 'Lost Books')
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

                    <div class="btn-group">
                        <a class="btn btn-primary" data-bs-toggle="modal" href="#add">
                            <i class="fa fa-plus"></i>
                            Add
                        </a>
                    </div>

                    @include('admin.lost.create')
                </div>
                <div class="card-body">

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Course/Year</th>
                                <th>Book title</th>
                                <th>Access Number</th>
                                <th>Lost Date</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lost_books as $lost_book)
                                @php
                                    $id = $lost_book->id;
                                @endphp
                                <tr>
                                    <td>
                                        @if ($lost_book->user->role == 2)
                                            {{ $lost_book->user->studentDetail->fname }}
                                            {{ $lost_book->user->studentDetail->mname }}
                                            {{ $lost_book->user->studentDetail->lname }}
                                        @else
                                            {{ $lost_book->user->facultyDetail->fname }}
                                            {{ $lost_book->user->facultyDetail->mname }}
                                            {{ $lost_book->user->facultyDetail->lname }}
                                        @endif
                                    </td>
                                    <td>{{ $lost_book->course }}</td>
                                    <td>{{ $lost_book->book_title }}</td>
                                    <td>{{ $lost_book->access_number }}</td>

                                    <td>

                                        {{ date('d-F-Y', strtotime($lost_book->lost_date)) }}

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
