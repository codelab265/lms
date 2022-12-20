@extends('layout')
@section('title', 'Books')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-25">Reservation</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Reservation</li>
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
                        <button type="button" class="btn btn-primary waves-effect btn-label waves-light"
                            data-bs-toggle="modal" data-bs-target="#add"><i class="bx bx-plus-circle label-icon"></i>Create
                            a request</button>
                    </div>
                    @include('members.books.create')
                </div>
                <div class="card-body">

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>

                                <th>Book Name</th>
                                <th>Return date</th>
                                <th>Status</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                @php
                                    $id = $reservation->id;
                                    $page = 'reservation';
                                @endphp
                                <tr>
                                    <td>{{ $reservation->book->title }}</td>

                                    <td>
                                        @if($reservation->user->role == 3)
                                        <span class="text-warning">N/A</span>
                                        @else
                                        {{ date('d-F-Y', strtotime($reservation->return_date)) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($reservation->status == 0)
                                            <span class="text-warning">Pending</span>
                                        @elseif ($reservation->status == 1)
                                            <span class="text-success">Ready to Get (Released)</span>
                                        @elseif ($reservation->status == 2)
                                            <span class="text-danger">Rejected</span>
                                        @else
                                            <span class="text-info">Returned</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($reservation->status == 0
                                            || $reservation->status == 2
                                            || $reservation->status == 1)
                                            <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $id }}">
                                                <i class="fa fa-trash"></i>
                                                Delete
                                            </a>
                                        @else
                                            <a class="btn btn-danger btn-sm disabled" aria-readonly="true">
                                                <i class="fa fa-trash"></i>
                                                Delete
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                                @include('admin.delete');
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
        var book;
        var author;
        $(document).ready(function(){

            @if($errors->any())
                @foreach ($errors->all() as $error)
                    Swal.fire({
                        title: "Error!",
                        text: '{{ $error }}',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2000,
                    });
                @endforeach
            @endif



            $(document).on('click', '#category_id', function(){
                $('#book_id').empty();
                $('#access_number').empty();
                $('#author').empty();
            })
            $('body').on('change', '#book_id', function() {
                var book_id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('get_access_number') }}",
                    data: {
                        id: book_id
                    },
                    success: function(response) {
                        var data = [];
                        $.each(response, function(index, value) {
                            data += '<option>' + value.access_number + '</option>'
                        });

                        $('#access_number').html(data)
                    }
                });
            })
            books = $('#book_id').select2({
                placeholder: 'Select a book name',
                dropdownParent: "#add",
                allowClear: true,
                ajax: {
                    url: "{{route('post_get_book')}}",
                    method: "POST",
                    data: function(term, page){
                        return {
                            q: term, // search term
                            author: $('#author').val(),
                            category_id: $('#category_id').val(),
                            "_token": $('meta[name="_token"]').attr("content"),
                        };
                    },
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (book) {
                                return {
                                    id: book.id,
                                    text: book.title
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
            author = $('#author').select2({
                placeholder: 'Select an author name',
                dropdownParent: "#add",
                allowClear: true,
                ajax: {
                    url: "{{route('post_get_author')}}",
                    method: "POST",
                    data: function(term, page){
                        return {
                            q: term, // search term
                            category_id: $('#category_id').val(),
                            book_id: $('#book_id').val(),
                            "_token": $('meta[name="_token"]').attr("content"),
                        };
                    },
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (book) {
                                return {
                                    id: book.author,
                                    text: book.author
                                }
                            })
                        };
                    },
                    cache: true
                }
            });


        })


    </script>
@endpush
