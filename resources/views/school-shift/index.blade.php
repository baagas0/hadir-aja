@extends('layouts.app')
@push('css')
<style>
    .pac-container {
        z-index: 99999;
    }
</style>
@endpush
@push('js')
    @include('school-shift.js')
@endpush
@section('content')
    @include('school-shift.table')
@endsection