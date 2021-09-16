@extends('layouts.app')
@section('title',  __('contests.title'))

<x-og :title="__('contests.title')"
      :description="__('contests.perex')"
      :url="route('contests')"
></x-og>

@section('content')

@include('components.header.header')

<div class="container mx-auto px-6">
    <x-intro
        :title="trans('contests.title')"
        :text="trans('contests.perex')"
    />
    <contests-overview />
</div>

<x-footer.footer></x-footer.footer>

@endsection
