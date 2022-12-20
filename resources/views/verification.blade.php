@component('mail::message')

<h1 style="text-align: center">VERIFY YOUR ACCOUNT</h1>
<hr>
Hi {{ $mailInfo['name'] }}, Your account creation is not complete yet please complete it by verify your account with the following code <h1 style="color: greenyellow">{{ $mailInfo['code'] }}</h1>

@component('mail::button', ['url' => 'http://127.0.0.1:8000/verify'])
 Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
