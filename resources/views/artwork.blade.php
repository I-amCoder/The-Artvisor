@extends('layouts.app')
@section('content')
    @include('layouts.navbar')
    <div class="row profile-section mx-5 mt-2 ">
        <div class="col-md-5 py-4 text-center">
            <img class="artwork-img" src="{{ asset('assets/img/hero_img.jpg') }}" alt="   ">
        </div>
        <div class="col-md-5 ">
            <div class="artwork-details">
                <h1>det</h1>

            </div>
        </div>
    </div>
@endsection
