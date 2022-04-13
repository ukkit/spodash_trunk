@component('mail::message')

# {{ $type }} ID {{ $id_number }} is down !!

[{{ $type }} ID {{ $id_number }}]({{ $url }}) seems to be down, bring up the {{ $type }} or Mark it as **Not Active** via {{ $type }} Details page (to disable this check).

`Change frequrency of these emails by updating Check Fail Threshold from {{ $type }} Details page`

@component('mail::subcopy')
    Don't reply to this automated email.
@endcomponent

@endcomponent