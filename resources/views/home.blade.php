@extends('layouts.app')
@section('title', __('home.title'))

<x-og :title="__('home.title')"
      :description="__('home.perex')"
      :url="route('home')"
></x-og>

@section('content')

@include('components.header.header')

{{-- @include('components.notification_bar') --}}

<div class="container mx-auto px-6">
    <x-intro :text="trans('home.perex')"/>

    <div class="mt-10 md:mt-32 md:grid grid-cols-2 gap-10 mb-20 md:mb-0">
        <div class="h-56 md:h-80 my-16 md:my-0 text-center md:text-left">
            <div class="mb-5 h-36 md:h-64">
                <Clock />
            </div>

            @if ($deadline)
                <x-link-arrow :url="$deadline->url">
                    {{ $deadline->deadline_at->diffForHumans() }}
                    {{ $deadline->title }}
                </x-link-arrow>
            @else
            <x-link-arrow url="https://www.cezaar.tv/" target="_blank">
                Odovzdávanie ceny za architektúru CE&nbsp;ZA&nbsp;AR 2021
                <br class="hidden md:block" />
                7.10.2021&nbsp;20:00
            </x-link-arrow>
            @endif
        </div>
        @foreach ($tiles as $tile)
            <x-tile
            :title="$tile->title"
            :url="$tile->url"
            class="{{ ($loop->last) ? 'border-b md:border-b-0' : '' }}"
        />
        @endforeach
    </div>

    <div class="lg:flex">
        <div class="flex-1 md:mr-14 md:order-2">
            <filter-listing-posts />
        </div>
        <div class="flex-1 md:mr-14 md:order-1">
            <filter-listing-tenders :options="{{ json_encode($contestFilterOptions) }}" />
        </div>
    </div>
    
    <div class="md:flex border-t border-b border-black">
        <x-section-publications class="md:w-2/3" title="Publikácie" :publications="$publications" linkUrl="https://issuu.com/institutska"
            :linkTitle="trans('home.read_on_issuu')" />
        <x-section-videos class="md:w-1/3" title="Videá" :videos="$videos"
            linkUrl="https://www.youtube.com/channel/UCxQENQWdqg7ug0dz8lEk-uQ" :linkTitle="trans('home.more_video')" />
    </div>

    <x-section-map
        worksUrl="{{ route('works') }}"
    />
</div>

<x-footer.footer></x-footer.footer>

@endsection
