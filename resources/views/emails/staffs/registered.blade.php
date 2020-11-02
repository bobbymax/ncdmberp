@component('mail::message')
# Welcome to the Learning and Development Portal

This portal has been designed to assit you in keeping an up to date record of trainings you have done in the past and future trainings you might be nominated for. Below are your login credentials and a couple of things you need to do to get started.


@component('mail::panel')
## Details

- Username: Staff Number
- Password: Password1

## Todo List

- Login to your account
- Upload all trainings you have attended in the past
@endcomponent

@component('mail::button', ['url' => 'http://erp.ncdmb.gov.ng', 'color' => 'success'])
Login
@endcomponent

ICT Admin,<br>
NCDMB
@endcomponent
