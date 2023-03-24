@component('mail::message')
    <x-mail::message>
        # Welcome to Ecommerce App!

        You can reset password from bellow link
        <a href="{{ route('password.reset.api', $token) }}">Reset Password</a>

        Thanks,<br>
        {{ config('app.name') }}
    </x-mail::message>
    @endcomponet
