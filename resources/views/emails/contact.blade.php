<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Réception d'un nouveau message</title>
    <style>
        body { font-family: Serif,; line-height: 1.6; color: #424244ff; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 0 auto; }
        .header { background-color: #644ba9; color: white; padding: 10px; text-align: center; }
        .content { background-color: #f9f9f9; padding: 20px; }
        .footer { text-align: center; margin-top: 20px; font-size: 0.8em; color: #a79db4ff; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Message venant du formulaire de contact AsthmaCare</h1>
        </div>
        
        <div class="content">
            <p><span class="label">De:</span> {{ $details['name'] }} ({{ $details['email'] }})</p>
            <p><span class="label">Date:</span> {{ now()->format('d/m/Y H:i') }}</p>
            
            <div class="message-box">
                <p><span class="label">Message:</span></p>
                <p>{{ nl2br(e($details['message'])) }}</p>
            </div>
        </div>
        
        <div class="footer">
            <p>Ce message a été envoyé depuis le formulaire de contact de {{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>