@extends('layouts.app')

@php
    $title = 'general settings';
@endphp

@push('page-css')
    
@endpush

@section('content')
    @include('app_settings::_settings') 
@endsection

@push('page-js')
    
@endpush