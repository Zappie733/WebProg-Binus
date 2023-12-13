@extends('layout.masterPage')
@section('title', 'Profile Page')
@section('content')
<link rel="stylesheet" href="/style/profile.css">
<div class="div-form-container">
  <form class="userForm" action="{{ Route('profileUpdate') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="left">
        <div class="div-image">
          <img id="uploadedImage" src="{{ Auth::user()->profilePhoto ? '/image/ProfilePhotos/' . Auth::user()->profilePhoto : '/image/ProfilePhotos/default.jpg' }}" alt="profile photo">
        </div>
        <div class="div-upload">
          <input type="file" id="profilePhoto" name="profilePhoto" accept="image/*" style="display: none;" onchange="previewImage(event)"/>
          
          <label for="profilePhoto" class="image-button">Upload Image</label>
        </div>
    </div>
    <div class="right">
      @if(session('passwordNotMatch'))
        <div class="failedText">{{ session('passwordNotMatch') }}</div>
      @endif
      @if(session('berhasil'))
        <div class="successText">{{ session('berhasil') }}</div>
      @endif
      
      <div class="div-form">
        <div class="item">
          <div class="div-input">
            <div class="div-label">
              <label for="username">Username: </label>
            </div>
            <input type="text" name="username" id="username" value="{{ old('username') ?? Auth::User()->username}}">
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
            <input type="date" name="dob" id="dob" value="{{ old('dob') ?? Auth::User()->dob }}">
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
            <option value="male" {{ (old('gender') === 'male') || (!old('gender') && Auth::User()->gender === 'male') ? 'selected' : '' }}>Male</option>
            <option value="female" {{ (old('gender') === 'female') || (!old('gender') && Auth::User()->gender === 'female') ? 'selected' : '' }}>Female</option>
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
            <input type="text" name="email" id="email" value="{{ old('email') ?? Auth::User()->email }}">
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
      
    
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </div>
  </form>

  <div class="div-logout">
    <form id="logoutForm" class="logoutForm" action="{{ Route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
  </div>
</div>


<script src="/script/profile.js"></script>

@endsection