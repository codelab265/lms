@extends('layout')
@section('title', 'Books')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-25">Books</h4>

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

                    @include('admin.returned.create')
                </div>
                <div class="card-body">

                    <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>Member</th>
                                <th>Book</th>
                                <th>Access Number</th>
                                <th>Returned Date</th>
                                <th>Remaining Days</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservations as $reservation)
                                @php
                                    $id = $reservation->id;
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
                                    <td>{{ $reservation->access_number }}</td>

                                    <td>
                                        @if ($reservation->user->role == 3)
                                        <span class="text-warning">N/A</span>
                                        @else
                                        {{ date('d-F-Y', strtotime($reservation->returned_date)) }}
                                        @endif

                                    </td>


                                    <td>
                                        @if ($reservation->user->role == 3)
                                        <span class="text-warning">N/A</span>
                                        @else {{--ARI SUGOD CONDTIONS--}}
                                            @php
                                                $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $reservation->returned_date . ' 00:00:00');
                                                $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $reservation->return_date . ' 00:00:00');
                                                $diff_in_days = $to->diffInDays($from);
                                            @endphp
                                            @if (strtotime($reservation->returned_date) <= strtotime($reservation->return_date))
                                                {{ $diff_in_days }} {{ str_plural('day', $diff_in_days) }}
                                            @else
                                                @if ($reservation->is_fined == 0)
                                                    Overdue with {{ $diff_in_days }} {{ str_plural('day', $diff_in_days) }}
                                                    (No fine)
                                                @else
                                                    Overdue with {{ $diff_in_days }} {{ str_plural('day', $diff_in_days) }}
                                                    (fined: {{ $reservation->fine }})
                                                @endif
                                            @endif
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
    <script type="text/javascript">
        function onScanSuccess(qrCodeMessage) {
            $('#returnID').val(qrCodeMessage);
            $('#returnForm').submit();
        }

        function onScanError(errorMessage) {
            //handle scan error
        }
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: 250
            });
        html5QrcodeScanner.render(onScanSuccess, onScanError);
    </script>
@endpush
