@extends('layout')
@section('title', 'Borrowed Books')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-25">Borrowed Books</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Borrowed Books</li>
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

                                <th>Book Name</th>
                                <th>Access number</th>
                                <th>Return date</th>
                                <th>Status</th>


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
                                    <td>{{ $reservation->access_number }}</td>
                                    <td>
                                        @if ($reservation->user->role == 3)
                                            <span class="text-warning">N/A</span>
                                        @else
                                        {{ date('d-F-Y', strtotime($reservation->return_date)) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($reservation->status == 0)
                                            <span class="text-warning">Pending</span>
                                        @elseif(App\Models\ReturnedBook::where('reservation_id', $reservation->id)->exists())
                                            <span class="text-info">Returned</span>
                                        @elseif ($reservation->status == 3)
                                            <span class="text-success">Accepted</span>
                                        @elseif ($reservation->status == 2)
                                            <span class="text-danger">Rejected</span>

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
        })
    </script>
@endpush
