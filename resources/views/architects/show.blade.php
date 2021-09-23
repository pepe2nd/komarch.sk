@extends('layouts.app')

@section('title')
    {{ $architect->full_name }}
@stop

<x-og :title="$architect->full_name"
      :description="$architect->short_description"
      :url="$architect->url"
></x-og>

@section('content')
<x-header.header></x-header.header>
<div class="container mx-auto px-6">
    <x-title-with-back :title="__('architects.title')" :back_title="__('architects.navigate_back')" :back_url="route('architects')"></x-title-with-back>
    <x-architect.architect-header :architect="$architect"></x-architect.architect-header>
    <x-architect.architect-content :architect="$architect"></x-architect.architect-content>

    <architect-works architect-id="{{ $architect->id }}"></architect-works>
</div>

<x-footer.footer></x-footer.footer>
@stop
