@component('mail::message')
# Court Reminder

You have a schedule for a court date today.


| *                 | *                                         |
|:------------------|------------------------------------------:|
| Case              |   **{{ $judicial->docket_case }}**             |
| Defendant         |   **{{ $judicial->defendant }}**               |
| Date Received     |   **{{ $judicial->date_received }}**           |
| Parents           |   **{{ $judicial->parents }}**                |



---


Regards,<br>
{{ config('app.name') }}
@endcomponent
