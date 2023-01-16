<x-mail::message>
    # Email Verification

    Thank you for signing up.
    Your six-digit code is {{$token}}

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>