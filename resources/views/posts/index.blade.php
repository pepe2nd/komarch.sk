@extends('layouts.app')
@section('title',  __('posts.title'))

@section('content')

<x-og :title="__('posts.title')"
      :description="__('posts.perex')"
      :url="route('posts.index')"
></x-og>

@include('components.header.header')

<div class="container mx-auto px-6">
    <x-intro
    :title="trans('posts.title')"
    :text="trans('posts.perex')"
    />
    <posts-overview />
</div>

<x-footer.footer></x-footer.footer>

@endsection
