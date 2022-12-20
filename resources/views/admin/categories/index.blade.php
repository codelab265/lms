@extends('layout')
@section('title', 'Categories')
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-25">Books Category Record</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                    <li class="breadcrumb-item active">Category</li>
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
                            <button type="button" class="btn btn-primary waves-effect btn-label waves-light" data-bs-toggle="modal" data-bs-target="#add"><i class="bx bx-plus-circle label-icon"></i>Add Category</button>
                        </div>
                        @include('admin.categories.create')
            </div>
            <div class="card-body">

                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Number of Books</th>
                            <th>Date Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                    @php
                        $id = $category->id;
                        $page = "category";
                    @endphp
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->book->sum('quantity') }}</td>
                        <td>{{ date('d-F-Y', strtotime($category->created_at)) }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit{{ $id }}"><i class="bx bx-edit label-icon"></i>Edit</button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $id }}"><i class="bx bx-trash label-icon"></i>Delete</button>
                            </div>
                        </td>
                    </tr>
                    @include('admin.categories.edit')
                    @include('admin.delete')
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div>
@endsection
