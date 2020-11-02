@component('mail::message')
# Your Training Status has been confimed

Your status for the training {{ $detail->training->title }} has been {{ $action }}.

@if ($action === "denied")
@component('mail::panel')
## Possible Reasons for Denial

- The certificate for this training has not been uploaded.
- Evidence to your attendance could not be found.
@endcomponent
@endif

@component('mail::button', ['url' => ''])
Login
@endcomponent

Learning and Development,<br><br>Best Regards<br>
NCDMB
@endcomponent
