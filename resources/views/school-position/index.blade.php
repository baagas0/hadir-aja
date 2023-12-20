@extends('layouts.app')
@push('css')
<style>
    .pac-container {
        z-index: 99999;
    }
</style>
@endpush
@push('js')
    @include('school-position.js')
@endpush
@section('content')
    @include('school-position.table')
@endsection