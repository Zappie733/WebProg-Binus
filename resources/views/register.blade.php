<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="/style/register.css">
</head>
<body>
  <div class="div-form">
    <div class="left">
      
    </div>
    <div class="right">
      <form action="{{ Route('register') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="item">
          <div class="div-input">
            <div class="div-label">
              <label for="username">Username: </label>
            </div>
            <input type="text" name="username" id="username" value="{{ old('username') }}">
          </div>
          <div class="div-error">
            @error('username')
              <div>{{$message}}</div>
            @enderror   
          </div>
        </div>
        
        <div class="item">
          <div class="div-input">
            <div class="div-label">
              <label for="dob">Date of Birth: </label>
            </div>
            <input type="date" name="dob" id="dob" value="{{ old('dob') }}">
          </div>
          <div class="div-error">
            @error('dob')
              <div>{{ $message }}</div>
            @enderror
          </div>
        </div>
      
       <div class="item">
        <div class="div-input">
          <div class="div-label">
            <label for="gender">Gender: </label>
          </div>
          <select name="gender" id="gender">
            <option value="" {{ old('gender') == '' ? 'selected' : '' }}>Select Gender</option>
            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
          </select>
        </div>
        <div class="div-error">
          @error('gender')
            <div>{{ $message }}</div>
          @enderror
        </div>
       </div>

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
        
        <div class="item">
          <div class="div-input">
            <div class="div-label">
              <label for="password_confirmation">Confirm Password: </label>
            </div>
            <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}">
          </div>
          <div class="div-error">
            @error('password_confirmation')
              <div>{{$message}}</div>
            @enderror
          </div>
        </div>
    
        <button type="submit" class="btn btn-primary">Register</button>

        <div class="div-login">
          <span>Already have an account? <a href="/">Login</a> here</span>
        </div>
      </form>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>