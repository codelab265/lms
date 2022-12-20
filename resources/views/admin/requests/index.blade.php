@extends('layout')
@section('title', 'Request')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-25">Request</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Request</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Book Name</th>
                                <th>Access Number</th>
                                <th>Returning Date</th>
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
                                    <td>
                                        @if ($reservation->user->role == 2)
                                            {{ $reservation->user->studentDetail->fname }}
                                            {{ $reservation->user->studentDetail->mname }}
                                            {{ $reservation->user->studentDetail->lname }}
                                        @else
                                            {{ $reservation->user->facultyDetail->fname }}
                                            {{ $reservation->user->facultyDetail->mname }}
                                            {{ $reservation->user->facultyDetail->lname }}
                                        @endif

                                    </td>
                                    <td>{{ $reservation->book->title }}</td>
                                    <td>{{$reservation->access_number}}</td>
                                    <td>
                                       @if ($reservation->user->role == 3)
                                            <span class="text-warning">N/A</span>
                                        @else
                                        {{ date('d-F-Y', strtotime($reservation->return_date)) }}
                                        @endif
                                    <td>
                                        @if ($reservation->status == 0)
                                            <span class="text-warning">Pending</span>
                                        @elseif ($reservation->status == 1)
                                            <span class="text-success">Ready to Get (Released)</span>
                                        @elseif ($reservation->status == 2)
                                            <span class="text-danger">Rejected</span>
                                        @elseif ($reservation->status == 3)
                                            <span class="text-primary">Released</span>
                                        @else
                                            <span class="text-info">Returned</span>
                                        @endif

                                        @php
                                            $to = \Carbon\Carbon::createFromFormat('Y-m-d', '2015-5-5');
                                            $from = \Carbon\Carbon::createFromFormat('Y-m-d', '2015-5-1');
                                            $diff_in_days = $to->diffInDays($from);
                                        @endphp

                                    </td>
                                    {{-- <td>
                                        @php
                                            if ($reservation->status == 3) {
                                                $status = 'disabled';
                                            } else {
                                                $status = '';
                                            }
                                        @endphp
                                        <div class="btn-group">
                                            <a class="btn btn-success btn-sm {{ $status }}" data-bs-toggle="modal"
                                                data-bs-target="#status{{ $id }}">
                                                Status
                                            </a>

                                        </div>
                                    </td> --}}
                                    <td>
                                        @php
                                            if ($reservation->status == 3) {
                                                $status = 'disabled';
                                            } else {
                                                $status = '';
                                            }
                                        @endphp
                                        <div class="btn-group">
                                            <a class="btn btn-success btn-sm btn-action {{ $status }}" id="{{ $id }}" data-bs-toggle="modal">
                                                Release
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                                @include('admin.requests.status')
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
        $(document).ready(function(){
            $('body').on('change', '#category_id', function() {
                var category_id = $(this).val();
                $.ajax({
                    type: "get",
                    url: "{{ route('get_book') }}",
                    data: {
                        id: category_id
                    },
                    success: function(response) {
                        var data = [];
                        $.each(response, function(index, value) {
                            data += '<option value="' + value.id + '">' + value.title + '</option>'
                        });

                        $('#book_id').html(data)
                    }
                });
            });
            $(document).on('click', '.btn-action', function(){
                let id = $(this).attr('id');
                Swal.fire({
                    title: "Question",
                    text: "Would you like to Release?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes",
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                           url: "{{ route('admin.requests.status') }}",
                           method: "POST",
                           dataType: "JSON",
                           data: {
                            "_token": $('meta[name="_token"]').attr("content"),
                            "id": id
                           },
                           success:function(data){
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: data.success.message,
                                    showConfirmButton: false,
                                    timer: 2000,
                                });
                                location.reload();
                           }
                        });
                    }
                });
            });

        });

    </script>
@endpush
