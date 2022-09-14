@extends('layouts.guest')

@section('content')
    <section class="bg-clean vh-100 d-flex align-items-center">
        <form method="post" action="login">
            @csrf
            <div class="illustration">
                <i class="icon ion-ios-navigate"></i>
            </div>
            <div class="px-2 mb-3 d-flex justify-content-between align-items-center form-container">
                <input class="form-control" type="text" placeholder="Username" name="username">
            </div>
            <div class="px-2 mb-3 d-flex justify-content-between align-items-center form-container">
                <input class="form-control px-2" type="password" name="password" placeholder="Password baru">
                <i class="fas fa-eye-slash"></i>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-block w-100" type="submit">Log In</button>
            </div>
        </form>
    </section>
@endsection
