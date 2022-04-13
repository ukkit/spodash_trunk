@component('mail::message')

# Build Update Triggered

*Build Update* has been triggered for {{ $instance }} (Instance ID {{ $instance_id }}) by **{{ $username }}** at {{ $at_time }} (IST).

This will upgrade build from {{ $current_build }} to **{{ $latest_build }}**.

{{-- If wish you cancel build update, please get in touch with {{ $username }} ASAP. --}}

@component('mail::subcopy')
    Don't reply to this automated email.
@endcomponent

@endcomponent