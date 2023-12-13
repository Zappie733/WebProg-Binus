@extends('layout.masterPage')
@section('title', 'Home Page')
@section('content')
<link rel="stylesheet" href="/style/user.css">
<div class="div-title">
  <p>All Admins</p>
</div>
<div class="div-table">
  <table>
    <th>Id</th>
    <th>PhotoProfile</th>
    <th>Username</th>
    <th>Email</th>
    <th>Dob</th>
    <th>Gender</th>
    <th>CreatedAt</th>
    <th>UpdatedAt</th>

    @forelse ($admins as $admin)
    <tr>
      <td>{{$admin->id}}</td>
      <td><img src={{ $admin->profilePhoto ? '/image/ProfilePhotos/' . $admin->profilePhoto : '/image/ProfilePhotos/default.jpg' }} alt="profile-photo"></td>
      <td>{{$admin->username}}</td>
      <td>{{$admin->email}}</td>
      <td>{{$admin->dob}}</td>
      <td>{{$admin->gender}}</td>
      <td>{{$admin->created_at}}</td>
      <td>{{$admin->updated_at}}</td>
    </tr>
    @empty
      <tr>
        <td colspan="8"><p>No admins</p></td>
      </tr>
    @endforelse
  </table>
</div>

<div class="pagination">
  {{ $admins->links() }}
</div>

<div class="div-title">
  <p>All Users</p>
</div>

<div class="div-table">
  <table>
    <th>Id</th>
    <th>PhotoProfile</th>
    <th>Username</th>
    <th>Email</th>
    <th>Dob</th>
    <th>Gender</th>
    <th>CreatedAt</th>
    <th>UpdatedAt</th>

    @forelse ($users as $user)
    <tr>
      <td>{{$user->id}}</td>
      <td><img src={{ $user->profilePhoto ? '/image/ProfilePhotos/' . $user->profilePhoto : '/image/ProfilePhotos/default.jpg' }} alt="profile-photo"></td>
      <td>{{$user->username}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->dob}}</td>
      <td>{{$user->gender}}</td>
      <td>{{$user->created_at}}</td>
      <td>{{$user->updated_at}}</td>
    </tr>
    @empty
    <tr>
      <td colspan="8"><p>No users</p></td>
    </tr>
    @endforelse
  </table>
</div>

<div class="pagination">
  {{ $users->links() }}
</div>
@endsection