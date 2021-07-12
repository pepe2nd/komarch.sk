@extends('layouts.app')
@section('title',  __('posts.title'))

@section('content')

@include('components.header.header')

<div class="container mx-auto px-6">
    <x-intro
    :title="trans('posts.title')"
        text="“{{ __('app.intro') }}”"
    />
    <posts-overview />
</div>

<x-footer.footer></x-footer.footer>

@endsection
