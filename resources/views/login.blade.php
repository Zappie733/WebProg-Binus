<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="/style/login.css">
</head>
<body>
  <div class="div-form"> 
    <div class="left">
      
    </div>
    <div class="right">
      <form action="{{ Route('login') }}" method="POST">
        @if(session('pesanRegister'))
          <div class="successText">{{ session('pesanRegister') }}</div>
        @endif

        @csrf
        <div class="item">
          <div class="div-input">
            <div class="div-label">
              <label for="email">Email: </label>
            </div>
            <input type="text" name="email" id="email" value="{{ old('email') }}">
          </div>
          <div class="div-error">
            @error('email')
              <div>{{$message}}</div>
            @enderror
          </div>
        </div>
        <div class="item">
          <div class="div-input">
            <div class="div-label">
              <label for="password">Password: </label>
            </div>
            <input type="password" name="password" id="password" value="{{ old('password') }}">
          </div>
          <div class="div-error">
            @error('password')
              <div>{{$message}}</div>
            @enderror
          </div>
        </div>

        <button type="submit">Login</button>
        
        @if(session('pesan'))
          <div class="text-danger">{{ session('pesan') }}</div>
        @endif
        <div class="div-register">
          <span>Don't have an account? <a href="/register">Register</a> here</span>
        </div>
      </form>
    </div>
  </div>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>