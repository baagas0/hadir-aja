@extends('layouts.app')
@push('css')
<style>
    .pac-container {
        z-index: 99999;
    }
</style>
@endpush
@push('js')
    @include('presence-daily.js')
@endpush
@section('content')
    @include('presence-daily.table')
@endsection
