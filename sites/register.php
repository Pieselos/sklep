<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="/script/register.php">
        <input placeholder="email" name="email" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$" require>
        <input placeholder="login" name="login" maxlength="20" require>
        <input type="password" placeholder="password" name="password" require>
        
        <input type="submit">
    </form>
</body>
</html>