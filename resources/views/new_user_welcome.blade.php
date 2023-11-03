@component('mail::message')
# Welcome to RTMS!

Hello {{ $user->name }},

This is your system login credentials:

@component('mail::panel')
<strong>Agency:</strong> {{ $user->agencyID }}
<br>
<strong>Role:</strong> {{ $user->role }}
<br>
<strong>Email:</strong> {{ $user->email }}
<br>
<strong>Password:</strong> {{ $user->password }}
@endcomponent


<i>Note: Permissions within the system may vary depends on your system role</i>


@component('mail::button', ['url' => 'https://example.com/welcome'])
Click here to get started
@endcomponent
@endcomponent