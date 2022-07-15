@extends('layouts.app')
@section('title',  __('contests.title'))

<x-og :title="__('contests.title')"
      :description="__('contests.perex')"
      :url="route('contests')"
></x-og>

@section('content')

@include('components.header.header')

<div class="container mx-auto px-6">
    <div id="nav-submenu" class="md:flex">
        @foreach ($page->breadcrumbs as $i => $breadcrumb)
            <div class="md:mr-16 lg:mr-24 mb-7 md:mb-0 pl-{{$i * 4}} md:pl-0">
                <x-header.page-navigation-list :items="$breadcrumb->children" :activeItem="$page" />
            </div>
        @endforeach
    </div>

    <x-intro
        :title="trans('contests.title')"
        :text="trans('contests.perex')"
    />
    <contests-overview />
</div>

<x-footer.footer></x-footer.footer>

@endsection
