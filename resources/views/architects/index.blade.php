@extends('layouts.app')
@section('title',  __('architects.title'))

<x-og :title="__('architects.title')"
      :description="__('architects.perex')"
      :url="route('architects')"
></x-og>

@section('content')

@include('components.header.header')

<div class="container mx-auto px-6">
    <x-intro
        :title="trans('architects.title')"
        :text="trans('architects.perex')"
    />
    <architects-overview
        :authorization-labels="{{ json_encode( __('architects.authorizations')) }}"
    />
</div>

<x-footer.footer></x-footer.footer>

@endsection
