@extends('layouts.plain')


@section('content')
<div class="text-center p-3">

    <div class="img">
        <img src="{{asset('assets/images/error-img.png')}}" class="img-fluid" alt="">
    </div>

    <h1 class="error-page mt-5"><span>500!</span></h1>
    <h4 class="mb-4 mt-5">Sorry, Server error</h4>
    <p class="mb-4 w-75 mx-auto">It will be as simple as Occidental in fact, it will Occidental to an English person</p>
    <a class="btn btn-primary mb-4 waves-effect waves-light" href="{{route('dashboard')}}"><i class="mdi mdi-home"></i> Back to Dashboard</a>
</div>
@endsection