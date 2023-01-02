<x-mail::message>
# Successfully registered.

Verify Yourself Using the Button.

<a href="{{ url('api/user/verify', $token) }}">Verify Mail</a>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
