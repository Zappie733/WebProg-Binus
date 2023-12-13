@extends('layout.masterPage')
@section('title', 'Pets Page')
@section('content')
<link rel="stylesheet" href="/style/pets.css">

<div class="div-logo">
  <img src="/image/logo2.png" alt="Pawsome">
</div>

<div class="div-filter">
  <form id="petsForm" action="{{ route('filterPets') }}" method="POST">
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
          <input type="text" id="name" name="name" placeholder="Enter pet name" value="{{$nameInput}}">
      </div>
      <div class="div-button">
          <button type="submit"><i class="fa fa-search"></i></button>
      </div>
    </div>
  </form>

  @if (Auth::User()->isAdmin)
  <div class="div-create">
    <a href="{{route('addNewPetPage')}}">Add New Pet</a>
  </div>
  @endif
</div>

<div class="div-pets">
  @foreach($pets as $pet)
    <div class="petCard">
      <div class="div-image">
        <img src={{$pet->petImage? "/image/PetImages/". $pet->petImage : "/image/noImageDefault.jpg"}}  alt="pet image">
      </div>
      <div class="div-title">
        <p>{{$pet->name}}</p>

        <div class="div-view">
          <i class="fa fa-eye" style="font-size:24px"></i>
          <p>{{ $pet->totalView }}</p>
        </div>
      </div>
      <div class="div-description">
        <p>{{ \Illuminate\Support\Str::limit($pet->description, 100) }}</p>
      </div>
      <div class="div-button">
        <a href="{{ route('petDetail', $pet)}}">Detail</a>
      </div>
    </div>
  @endforeach
</div>

@if (empty($nameInput) && empty($categoryInput))
  <div class="pagination">
    {{ $pets->links() }}
  </div>
@endif


<script src="/script/pets.js"></script>

@endsection