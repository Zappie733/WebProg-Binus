@extends('layout.masterPage')
@section('title', 'Favorites Page')
@section('content')
<link rel="stylesheet" href="/style/favorite.css">
<div class="div-logo">
  <img src="/image/logo2.png" alt="Pawsome">
</div>

<div class="div-headTitle">
  <p>Favorite Pets</p>
</div>

<div class="div-pets">
  @forelse ($favoritePets as $data)
  <div class="petCard">
    <div class="div-image">
      <img src={{$data->pet->petImage? "/image/PetImages/". $data->pet->petImage : "/image/noImageDefault.jpg"}}  alt="pet image">
    </div>
    <div class="div-title">
      <p>{{$data->pet->name}}</p>

      <div class="div-view">
        <i class="fa fa-eye" style="font-size:24px"></i>
        <p>{{ $data->pet->totalView }}</p>
      </div>
    </div>
    <div class="div-description">
      <p>{{ \Illuminate\Support\Str::limit($data->pet->description, 100) }}</p>
    </div>
    <div class="div-button">
      <a href="{{ route('petDetail', $data->pet)}}">Detail</a>
    </div>
  </div>
  @empty
  <p>You haven't got any favorite pets yet</p>
  @endforelse
</div>
  
<div class="pagination">
  {{ $favoritePets->links() }}
</div>
  

<div class="div-headTitle">
  <p>Favorite Articles</p>
</div>

<div class="div-article">
  @forelse ($favoriteArticles as $data)
  <div class="card">
    <div class="div-left">
      <img src={{ $data->article->articleImage ? "/image/ArticleImages/". $data->article->articleImage : "/image/noImageDefault.jpg" }} alt="Article-Image">
    </div>
    <div class="div-right">
      <div class="div-title">
        <p>{{$data->article->title}}</p>
      </div>

      <div class="div-createdAtNView">
        <div class="div-created">
          <p>Created At: {{ $data->article->created_at->format('Y-m-d') }}</p>
        </div>
        <div class="div-view">
          <i class="fa fa-eye" style="font-size:24px"></i>
          <p>{{ $data->article->totalView }}</p>
        </div>
      </div>

      <div class="div-description">
        <p>{!! \Illuminate\Support\Str::limit(nl2br(e($data->article->description)),450) !!}<a href="{{ route('articleDetail', $data->article)}}">Read More</a></p>
      </div>

    </div>
  </div>
  @empty
  <p>You haven't got any favorite article yet</p>
  @endforelse
</div>

  
<div class="pagination">
  {{ $favoriteArticles->links() }}
</div>

@endsection