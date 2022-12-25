<hr>
<div class="card">
    <div class="card-header">
        <h5 class="text-center">{{ $access_number }}</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <th>Borrower's Name</th>
                <th>Course/Year</th>
            </thead>
            <tbody>
                @forelse ($reservations as $reservation)
                    @if ($reservation->user->role == 2)
                        <tr>
                            <td>{{ $reservation->user->studentDetail->fname }}
                                {{ $reservation->user->studentDetail->lname }}</td>
                            <td>{{ $reservation->user->studentDetail->course }}/{{ $reservation->user->studentDetail->level }}
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td>{{ $reservation->user->facultyDetail->fname }}
                                {{ $reservation->user->facultyDetail->lname }}</td>
                            <td>N/A</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="2">
                            <div class="alert alert-warning text-center">
                                No data
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
