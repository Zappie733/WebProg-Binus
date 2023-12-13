@extends('layout.masterPage')
@section('title', 'Pet Detail Page')
@section('content')
<link rel="stylesheet" href="/style/petDetail.css">

<div class="div-detailContent">
  <div class="div-title">
    <p>{{ $pet->name }}</p>
  </div>

  <div class="div-view">
    <i class="fa fa-eye" style="font-size:24px"></i>
    <p>{{ $pet->totalView }}</p>
  </div>
  
  <div class="div-image">
    <img src={{$pet->petImage ? "/image/PetImages/". $pet->petImage : "/image/noImageDefault.jpg"}} alt="pet image">
  </div>

  <div class="div-favorite">
    <form action="{{ route('petFavorite', $pet) }}" method="POST">
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
    <p>{!! nl2br(e($pet->description)) !!}</p>
  </div>
</div>

<script src="/script/petDetail.js"></script>

@endsection