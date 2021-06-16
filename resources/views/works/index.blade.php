@extends('layouts.app')
@section('title', __('works.works_register') )

@section('content')

@include('components.header.header')

<div class="container mx-auto px-6">
    <x-intro
        title="{{ __('works.works_register') }}"
        text="“{{ __('works.intro') }}”"
    />
    <works-overview></works-overview>
</div>

<x-footer.footer></x-footer.footer>

@endsection
