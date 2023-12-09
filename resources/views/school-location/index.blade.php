@extends('layouts.app')
@push('css')
<style>
    .pac-container {
        z-index: 99999;
    }
</style>
@endpush
@push('js')
    @include('school-location.js')
@endpush
@section('content')
    @include('school-location.table')
@endsection