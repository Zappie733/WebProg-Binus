@extends('layout.masterPage')
@section('title', 'New Pet Page')
@section('content')
<link rel="stylesheet" href="/style/newArticle.css">

<div class="div-form-container">
  <form action="{{ route('addNewArticle') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="left">
      <div class="div-image">
        <img id="uploadedImage" src="/image/noImageDefault.jpg" alt="Pet Image">
      </div>
      <div class="div-upload">
        <input type="file" id="articleImage" name="articleImage" accept="image/*" style="display: none;" onchange="previewImage(event)"/>
        
        <label for="articleImage" class="image-button">Upload Image</label>
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
              <label for="title">Article Title: </label>
            </div>
            <input type="text" name="title" id="title" value="{{ old('title') }}">
          </div>
          <div class="div-error">
            @error('title')
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
              <label for="description">Content: </label>
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

<script src="/script/newArticle.js"></script>
@endsection