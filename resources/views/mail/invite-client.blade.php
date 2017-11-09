<html>
<head></head>
<body>
{{ Auth::user()->getName() }}  invites you to register on the site:
<p>{{$link}}</p>
</body>
</html>