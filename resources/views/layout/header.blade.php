<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>Document</title> -->
  <link rel="stylesheet" href="/style/header.css">
</head>
<body>
  <header>
    <div class="div-logoHeader">
      <img src="/image/logo.png" alt="Pawsome">
    </div>
    <nav>
      <div class="item">
        <a href="{{ Route('home') }}">Home</a>
      </div>
      <div class="item">
        <a href="{{ Route('petsPage') }}">Pets</a>
      </div>
      <div class="item">
        <a href="{{ Route('articlesPage') }}">Articles</a>
      </div>
      <div class="item">
        <a href="{{ Route('favoritesPage') }}">Favorites</a>
      </div>
      @if (Auth::User()->isAdmin)
        <div class="item">
          <a href="{{ Route('users') }}">Users</a>
        </div>          
      @endif
    </nav>
    <div class="div-profile">
      <a href="{{ Route('profilePage') }}">
        <div class="div-profilePhoto">
          <img src="{{ Auth::user()->profilePhoto ? '/image/ProfilePhotos/' . Auth::user()->profilePhoto : '/image/ProfilePhotos/default.jpg' }}" alt="profile photo">
        </div>
      </a>
    </div>
  </header>
</body>
</html>