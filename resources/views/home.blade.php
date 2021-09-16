@extends('layouts.app')
@section('title', __('home.title'))

@section('content')

@include('components.header.header')

{{-- @include('components.notification_bar') --}}

<div class="container mx-auto px-6">
    <x-intro :text="trans('home.perex')"/>

    <div class="mt-10 md:mt-32 md:grid grid-cols-2 gap-10">
        <div class="h-56 md:h-80">
            {{-- <img src="{{ asset('images/clock.svg') }}" alt="clock" class="mb-5"> --}}
            <div class="mb-3 md:mb-5 h-36 md:h-64">
                <Clock />
            </div>

            <x-link-arrow url="http://cezaar.tv/" target="_blank">
                Odovzdávanie ceny za architektúru C&nbsp;E&nbsp;ZA&nbsp;AR 2021
                <br class="hidden md:block" />
                07.10.2021&nbsp;20:00
            </x-link-arrow>
        </div>
        @foreach ($tiles as $tile)
            <x-tile
            :title="$tile->title"
            :url="$tile->url"
        />
        @endforeach
    </div>

    <div class="lg:flex">
        <div class="flex-1 md:mr-14">
            <filter-listing-tenders
                :options="{{ json_encode($contestFilterOptions) }}"
            />
        </div>
        <div class="flex-1 md:mr-14">
            <filter-listing-posts />
        </div>
        <div class="flex-1">
            <x-section-videos
                title="Videá"
                :videos="$videos"
                linkUrl="https://www.youtube.com/channel/UCxQENQWdqg7ug0dz8lEk-uQ"
                :linkTitle="trans('home.more_video')"
            />
            <x-section-publications
                title="Publikácie"
                :publications="$publications"
                linkUrl="https://issuu.com/institutska"
                :linkTitle="trans('home.read_on_issuu')"
            />
        </div>
    </div>

    <x-section-map
        worksUrl="{{ route('works') }}"
    />
</div>

<x-footer.footer></x-footer.footer>

@endsection
