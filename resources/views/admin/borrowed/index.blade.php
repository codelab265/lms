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
                                <th>Member</th>
                                <th>Book Name</th>
                                <th>Access Number</th>
                                <th>Returning date</th>
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
                                    <td>{{ $reservation->book->title }} </td>
                                    <td>{{ $reservation->access_number }} </td>

                                    <td>
                                        @if ($reservation->user->role == 3)
                                        <span class="text-warning">N/A</span>
                                        @else
                                        {{ date('d-F-Y', strtotime($reservation->return_date)) }}
                                        @endif
                                    </td>


                                    <td>
                                        @if ($reservation->user->role == 3)
                                        <span class="text-warning">N/A</span>
                                        @else
                                          @if ($reservation->returned_date == NULL)
                                           <h5 style="color:red">
                                                PENDING
                                           </h5>

                                        @elseif ($reservation->status == 3)
                                            <h5 style="color:green">
                                                RETURNED
                                            </h5>
                                        @endif
                                            {{-- @php
                                                $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', date('Y-m-d') . ' 00:00:00');
                                                $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $reservation->return_date . ' 00:00:00');
                                                $diff_in_days = $to->diffInDays($from);
                                            @endphp
                                            @if (strtotime(date('Y-m-d')) < strtotime($reservation->return_date))
                                                {{ $diff_in_days }} {{ str_plural('day', $diff_in_days) }}
                                            @elseif (strtotime(date('Y-m-d')) == strtotime($reservation->return_date))
                                                Return Day
                                            @else
                                                Overdue with {{ $diff_in_days }} {{ str_plural('day', $diff_in_days) }}
                                            @endif --}}
                                        @endif

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
