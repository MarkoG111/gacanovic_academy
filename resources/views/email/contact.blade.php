@component('mail::message')
    <strong>Subject</strong>
    {{ $subject }}
    <br />

    <strong>Email</strong>
    {{ $email }}

    <strong>Message</strong>
    {{ $message }}
@endcomponent
