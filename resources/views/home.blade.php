@extends('layout.masterPage')
@section('title', 'Home Page')
@section('content')
  <link rel="stylesheet" href="/style/home.css">
  <div class="homeContainer">
    <div class="title">
      <p>Trending Articles</p>
    </div>

    <div class="trendingArticleSlider">
      <div class="slides">
        @foreach($trendingArticles as $index => $article)
        <div class="slide @if($index === 0) active @endif">
          <div class="div-img">
            <img src="{{ $article->articleImage? "/image/ArticleImages/". $article->articleImage : "/image/noImageDefault.jpg" }}" alt="Article {{ $index + 1 }}">
          </div>
          <div class="div-isi">
            <div class="item title">{{ $article->title }}</div>
            <div class="item timeNViews">
              <div class="createdAt">{{ $article->created_at->format('Y-m-d') }}</div>
              <div class="totalView">Total Views: {{ $article->totalView }}</div>
            </div>
            <div class="item description">{{ \Illuminate\Support\Str::limit($article->description, 300) }}</div>
            <div class="item divButton">
              <a href="">Read Detail</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="navigation-prev">
        <button class="prev" onclick="changeSlide(-1)"><</button>
      </div>
      <div class="navigation-next">
        <button class="next" onclick="changeSlide(1)">></button>
      </div>

    </div>

    <div class="title title2">
      <p>Most Search Pet</p>
    </div>

    <div class="mostSearchPetContainer">
      @foreach ($mostSearchPets as $pet)
          <div class="item">
            <div class="div-image">
              <img src="{{ $pet->petImage? "/image/PetImages/". $pet->petImage : "/image/noImageDefault.jpg" }}" alt="Pet-Image">
            </div>
            <div class="div-isi">
              <div class="div-name">
                <p>{{ $pet->name }}</p>
              </div>
              <div class="div-view">
                <i class="fa fa-eye" style="font-size:24px"></i>
                <p>{{ $pet->totalView }}</p>
              </div>
              <div class="div-button">
                <a href="{{ route('petDetail', $pet)}}">Check It</a>
              </div>
            </div>
          </div>
      @endforeach
    </div>
  </div>
  
  <script src="/script/home.js"></script>
@endsection