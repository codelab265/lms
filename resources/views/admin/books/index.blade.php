@extends('layout')
@section('title', 'Books')
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h1 class="mb-sm-0 font-size-25">Books</h1>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                    <li class="breadcrumb-item active">Books</li>
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
                            <button type="button" class="btn btn-primary waves-effect btn-label waves-light" data-bs-toggle="modal" data-bs-target="#add"><i class="bx bx-plus-circle label-icon"></i>Add Book</button>
                        </div>
                        @include('admin.books.create')
            </div>
            <div class="card-body">

                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>

                            <th>Copy Right</th>
                            <th>ISBN NO.</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Edition</th>
                            <th>Quantity</th>
                            <th>Price</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($books as $book)
                    @php
                        $id = $book->id;
                        $page = "book";
                    @endphp
                    <tr>


                        <td>{{ $book->copyright }}</td>
                        <td>{{ $book->isbn_no }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->edition }}</td>
                        <td>{{ $book->quantity }}</td>
                        <td>{{$book->price}}</td>

                        <td>

                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">

                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit{{ $id }}"><i class="bx bx-edit label-icon"></i>Edit</button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $id }}"><i class="bx bx-trash label-icon"></i>Delete</button>
                            </div>
                        </td>
                    </tr>
                    @include('admin.books.edit')
                    @include('admin.delete')
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection
@push('script')
<script type="text/javascript">


    function onScanSuccess(qrCodeMessage) {
        $(':input:focus').val(qrCodeMessage);
    }
    function onScanError(errorMessage) {
      //handle scan error
    }
    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess, onScanError);
    </script>
@endpush
