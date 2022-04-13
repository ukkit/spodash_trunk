@component('mail::message')

# Shutdown AppServer Triggered

*Shutdown Application Server* has been triggered for {{ $instance }} (Instance ID {{ $instance_id }}) by **{{ $username }}** at {{ $at_time }} (IST).

{{-- If wish you cancel build update, please get in touch with {{ $username }} ASAP. --}}

@component('mail::subcopy')
    Don't reply to this automated email.
@endcomponent

@endcomponent