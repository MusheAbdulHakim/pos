@extends('layouts.plain')
@php
    $title = '404'
@endphp
@section('content')
<div class="text-center p-3">

    <div class="img">
        <img src="{{asset('assets/images/error-img.png')}}" class="img-fluid" alt="">
    </div>

    <h1 class="error-page mt-5"><span>404!</span></h1>
    <h4 class="mb-4 mt-5">Sorry, page not found</h4>
    <p class="mb-4 w-75 mx-auto">If you are seeing this page, it means you are trying to access a page that is not there. Check the url or contact developer</p>
    <a class="btn btn-primary mb-4 waves-effect waves-light" href="{{route('dashboard')}}"><i class="mdi mdi-home"></i> Back to Dashboard</a>
</div>
@endsection