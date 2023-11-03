@component('mail::message')
# Welcome to RTMS!

Hello {{ $_SESSION['name'] }},

This is your system login credentials:

@component('mail::panel')
<strong>Agency:</strong> {{ $_SESSION['agencyID'] }}
<br>
<strong>Role:</strong> {{ $_SESSION['role'] }}
<br>
<strong>Email:</strong> {{ $_SESSION['email'] }}
<br>
<strong>Password:</strong> {{ $_SESSION['password'] }}
@endcomponent


@component('mail::button', ['url' => 'https://example.com/welcome'])
Click here to get started
@endcomponent
@endcomponent