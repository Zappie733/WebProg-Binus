@extends('layout.masterPage')
@section('title', 'New Pet Page')
@section('content')
<link rel="stylesheet" href="/style/newPet.css">

<div class="div-form-container">
  <form action="{{ route('addNewPet') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="left">
      <div class="div-image">
        <img id="uploadedImage" src="/image/noImageDefault.jpg" alt="Pet Image">
      </div>
      <div class="div-upload">
        <input type="file" id="petPhoto" name="petPhoto" accept="image/*" style="display: none;" onchange="previewImage(event)"/>
        
        <label for="petPhoto" class="image-button">Upload Image</label>
      </div>
    </div>

    <div class="right">
      @if(session('berhasil'))
        <div class="successText">{{ session('berhasil') }}</div>
      @endif
      
      <div class="div-form">
        <div class="item">
          <div class="div-input">
            <div class="div-label">
              <label for="name">Pet Name: </label>
            </div>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
          </div>
          <div class="div-error">
            @error('name')
              <div>{{$message}}</div>
            @enderror   
          </div>
        </div>
  
        <div class="item">
          <div class="div-input">
            <div class="div-label">
              <label for="category">Category: </label>
            </div>
            <select name="category" id="category">
              <option value="" {{ (old('category') == '' ? 'selected' : '') }}>Select Pet Category</option>
              <option value="Cat" {{ (old('category') == 'Cat' ? 'selected' : '') }}>Cat</option>
              <option value="Dog"  {{ (old('category') == 'Dog' ? 'selected' : '') }}>Dog</option>
              <option value="Fish"  {{ (old('category') == 'Fish' ? 'selected' : '') }}>Fish</option>
            </select>
            
          </div>
          <div class="div-error">
            @error('category')
              <div>{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="item">
          <div class="div-input-description">
            <div class="div-label">
              <label for="description">Description: </label>
            </div>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
          </div>

          <div class="div-error">
            @error('description')
              <div>{{ $message }}</div>
            @enderror
          </div>
        </div>
      
    
        <button type="submit" class="btn btn-primary">Insert</button>
      </div>
    </div>
  </form>
</div>

<script src="/script/newPet.js"></script>
@endsection