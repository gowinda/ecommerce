<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>
        <strong>Dear Admin,</strong>
    </p>
    <p>
        You have one new message from web. The information are as follow:
    </p>
    <p>
        <strong>Email Address: {{ $email_from }}</strong>
    </p>
    <p>
        <strong>Message: {{ $msg_data }}</strong>
    </p>
</body>
</html>
