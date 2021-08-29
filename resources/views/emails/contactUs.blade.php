{{--@component('mail::message')--}}

<body style="margin: 15px;background: #ffffff ; font-family: 'Roboto', sans-serif;">

    <br />

    <div style="width: 85%; background: #fff; color: #0a0807;text-align: left;   margin: auto; padding: 20px">
        <h1> A customer is trying contact you:</h1>


        <p>Name: {{ $data['name'] }} </p><br />

        <p>Email: {{ $data['email'] }} </p><br />

        <p>Subject: {{ $data['subject'] }} </p><br />

        <p>Message: {{ $data['message'] }} </p><br />

        Thank you,<br>

    </div>
</body>


{{--@endcomponent--}}
