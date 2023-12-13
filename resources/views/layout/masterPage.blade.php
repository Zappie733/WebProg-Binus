@include('layout.header')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="/style/masterPage.css">
</head>
<body>
  @yield('content')
</body>
</html>
@include('layout.footer')