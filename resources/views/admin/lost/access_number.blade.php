<option value="">Select</option>

@foreach ($access_numbers as $access_number)
    <option>
        {{ $access_number->access_number }}
    </option>
@endforeach
