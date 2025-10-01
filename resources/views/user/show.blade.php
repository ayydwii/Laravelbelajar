@extends('layouts.app')

@section('title', 'Detail User')
@section('header-title', 'Detail User')

@section('content')
    <div class="card" style="width: 18rem;">
        @if($user->photo)
            <img src="{{ asset('photos/'.$user->photo) }}" class="card-img-top" alt="Foto">
        @else
            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Foto">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $user->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            {{-- <p class="card-text"><strong>Username:</strong> {{ $user->username }}</p> --}}
            <a href="{{ route('users.index') }}" class="btn btn-primary">Kembali</a>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
@endsection
