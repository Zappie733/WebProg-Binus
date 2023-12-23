@extends('layout.masterPage')
@section('title', 'Articles Page')
@section('content')
<link rel="stylesheet" href="/style/article.css">

<div class="div-logo">
  <img src="/image/logo2.png" alt="Pawsome">
</div>

<div class="div-filter">
  <form id="articleForm" action="{{ route('filterArticles') }}" method="POST">
    @csrf
    <div class="div-category">
      <select name="category" id="category" onchange="submitForm()" >
        <option value="" {{$categoryInput == '' ? 'selected' : ''}}>All</option>
        <option value="cat" {{$categoryInput == 'cat' ? 'selected' : ''}}>Cat</option>
        <option value="dog" {{$categoryInput == 'dog' ? 'selected' : ''}}>Dog</option>
        <option value="fish" {{$categoryInput == 'fish' ? 'selected' : ''}}>Fish</option>
      </select>
    </div>
    <div class="div-searchBar">
      <div class="div-input">
          <input type="text" id="title" name="title" placeholder="Enter article title" value="{{$titleInput}}">
      </div>
      <div class="div-button">
          <button type="submit"><i class="fa fa-search"></i></button>
      </div>
    </div>
  </form>

  @if (Auth::User()->isAdmin)
  <div class="div-create">
    <a href="{{route('addNewArticlePage')}}">Add New Article</a>
  </div>
  @endif
</div>

<div class="div-article">
  @foreach ($articles as $article)
    <div class="card">
      <div class="div-left">
        <img src="{{ $article->articleImage? "/image/ArticleImages/". $article->articleImage : "/image/noImageDefault.jpg"}}" alt="Article-Image">
      </div>
      <div class="div-right">
        <div class="div-title">
          <p>{{$article->title}}</p>
        </div>

        <div class="div-createdAtNView">
          <div class="div-created">
            <p>Created At: {{ $article->created_at->format('Y-m-d') }}</p>
          </div>
          <div class="div-view">
            <i class="fa fa-eye" style="font-size:24px"></i>
            <p>{{ $article->totalView }}</p>
          </div>
        </div>

        <div class="div-description">
          <p>{!! \Illuminate\Support\Str::limit(nl2br(e($article->description)),450) !!}<a href="{{ route('articleDetail', $article)}}">Read More</a></p>
        </div>

      </div>
    </div>
  @endforeach
</div>

@if (empty($titleInput) && empty($categoryInput))
  <div class="pagination">
    {{ $articles->links() }}
  </div>
@endif

<script src="/script/article.js"></script>

@endsection