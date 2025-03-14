<!DOCTYPE html>
<html>
<head>
    <title>Follow-Up Notification</title>
</head>
<body>
    <h1>Follow-Up Notification</h1>
    <p>Dear {{ $data['name'] }},</p>
    <p>This is a reminder for a follow-up scheduled on {{ $data['follow_date'] }}.</p>
    <p>Reason: {{ $data['reason'] }}</p>
    <p>Comments: {{ $data['comments'] }}</p>
    <p>Thank you!</p>
</body>
</html>
