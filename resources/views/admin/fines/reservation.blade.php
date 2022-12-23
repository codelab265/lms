@forelse ($reservations as $reservation)
    <option value="{{ $reservation->id }}">
        {{ $reservation->book->title }}: Borrowed on {{ date('d-F-Y', strtotime($reservation->created_at)) }}
    </option>
@empty
    <option value="">
        No reservations was fined
    </option>
@endforelse
