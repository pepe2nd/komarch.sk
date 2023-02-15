@extends('layouts.app')
@section('title', __('documents.title'))

<x-og :title="__('documents.title')"
      :description="__('documents.perex')"
      :url="route('documents')"
></x-og>

@section('content')

@include('components.header.header')

<div class="container mx-auto px-6">
    <x-nav-submenu :page="$page"></x-nav-submenu>
    <x-intro
        :title="trans('documents.title')"
        :text="trans('documents.perex')"
    />
    <documents-overview />
</div>

<x-footer.footer></x-footer.footer>

@endsection
