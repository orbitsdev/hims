<x-mail::message>


## Announcement from SKSU-HIMS

Hi {{ $user->name }},

This is an announcement regarding:

**{{ $title }}**

{{ $body }}

Best regards,

The SKSU-HIMS Team

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>a
