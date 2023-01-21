@extends('layouts.default')

@section('styles')
    {{ $styles ??= '' }}
@endsection

@section('content')
<!--begin::Entry-->
    {{ $content }}
<!--end::Entry-->
@endsection

{{-- Scripts Section --}}
@section('scripts')
    {{ $scripts ??= '' }}
@endsection