@extends('layouts.app')
@section('title', 'správy')

@section('content')

@include('components.header.header')

{{-- @include('components.notification_bar') --}}

<div class="container mx-auto px-6">
    <x-intro :text="trans('home.intro')"/>

    <div class="mt-10 md:mt-32 md:grid grid-cols-2 gap-10">
        <div class="flex" style="height: 300px">
            <span class="m-auto">
                <img src="{{ asset('images/clock.svg') }}" alt="clock">
            </span>
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
            <filter-listing-tenders />
        </div>
        <div class="flex-1 md:mr-14">
            <filter-listing-posts />
        </div>
        <div class="flex-1">
            <x-section-videos
                title="Videá"
                embedUrl="https://www.youtube.com/embed/NL1XKbI3x68"
                linkUrl="#"
                :linkTitle="trans('home.more_video')"
            />
            <x-section-publications
                title="Publikácie"
                :publications="$publications"
                linkUrl="#"
                :linkTitle="trans('home.read_on_issuu')"
            />
        </div>
    </div>

    <x-section-map
        worksUrl="{{ route('works') }}"
        mapUrl="#"
    />
</div>

<x-footer.footer></x-footer.footer>

@endsection
