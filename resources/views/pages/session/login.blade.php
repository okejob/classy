@extends('layouts.guest')

@section('content')
<section class="bg-clean vh-100 d-flex align-items-center">
    <form method="post" action="/login">
        @csrf
        <div class="mb-3">
            <div class="px-2 mb-1 d-flex justify-content-between align-items-center form-container">
                <input class="form-control" type="text" placeholder="Username" name="username">
            </div>
            @error('username')
                <div class="alert alert-danger" style="padding: 0.5rem 1.15rem;">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <div class="ps-2 mb-1 d-flex justify-content-between align-items-center form-container">
                <input class="form-control px-2" type="password" name="password" placeholder="Password">
                <button class="btn h-100"><i class="fas fa-eye-slash"></i></button>
            </div>
            @error('password')
                <div class="alert alert-danger" style="padding: 0.5rem 1.15rem;">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <div class="form-container mb-1 px-2">
                <select class="px-2 form-control" style="border-bottom: none;" name="cabang">
                    <option value="" hidden selected disabled class="px-2">Cabang</option>
                    @foreach ($cabangs as $cabang)
                        <option value="{{ $cabang->id }}">{{ $cabang->nama }}</option>
                    @endforeach
                </select>
            </div>
            @error('cabang')
                <div class="alert alert-danger" style="padding: 0.5rem 1.15rem;">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-primary d-block w-100" type="submit">Log In</button>
        </div>
    </form>
</section>
<script>
    $(document).ready(function() {
        document.cookie = "";
    });
</script>
@endsection
