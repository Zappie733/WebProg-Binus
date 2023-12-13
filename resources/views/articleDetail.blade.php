@extends('layout.masterPage')
@section('title', 'Article Detail Page')
@section('content')
<link rel="stylesheet" href="/style/articleDetail.css">

<div class="div-detailContent">
  <div class="div-title">
    <p>{{ $article->title }}</p>
  </div>

  <div class="div-view">
    <i class="fa fa-eye" style="font-size:24px"></i>
    <p>{{ $article->totalView }}</p>
  </div>
  
  <div class="div-image">
    <img src={{ $article->articleImage? "/image/ArticleImages/". $article->articleImage : "/image/noImageDefault.jpg" }}  alt="article image">
  </div>

  <div class="div-favorite">
    <form action="{{ route('articleFavorite', $article) }}" method="POST">
      @csrf
      @if($isFavorited)
          @method('DELETE')
      @endif
      <button type="submit">
          <i class="fa fa-heart {{ $isFavorited ? 'heart-red' : 'default' }}" id="heartIcon" onclick="toggleHeart(this)"></i>
      </button>
    </form>
    @if ($isFavorited)
      <p>Favorite By You and {{$totalFavorite - 1}} Other People</p>
    @else
      <p>Favorite By {{$totalFavorite}} People</p>
    @endif
    
  </div>
  
  
  <div class="div-description">
    <p>{!! nl2br(e($article->description)) !!}</p>
  </div>
</div>

<script src="/script/articleDetail.js"></script>

@endsection