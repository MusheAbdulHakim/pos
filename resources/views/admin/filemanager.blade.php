@extends('layouts.app')

@push('page-css')
<link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endpush

@section('content')
<div style="height: 600px;">
    <div id="fm"></div>
</div>
@endsection

@push('page-js')
<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@endpush