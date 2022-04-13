@component('mail::message')

# SPO & PAI Build Update Triggered

*Build Update* has been triggered for {{ $instance }} (Instance ID {{ $instance_id }}) by **{{ $username }}** at {{ $at_time }} (IST).

This will upgrade SPO build from {{ $current_build_spo }} to **{{ $latest_build_spo }}** and PAI build from {{ $current_build_pai }} to **{{ $latest_build_pai }}**.

{{-- If wish you cancel build update, please get in touch with {{ $username }} ASAP. --}}

@component('mail::subcopy')
    Don't reply to this automated email.
@endcomponent

@endcomponent