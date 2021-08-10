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
    <x-architect.architect-back :architect="$architect"></x-architect.architect-back>
    <x-architect.architect-header :architect="$architect"></x-architect.architect-header>
    <x-architect.architect-content :architect="$architect"></x-architect.architect-content>

    <architect-works architect-id="{{ $architect->id }}"></architect-works>
</div>

<x-footer.footer></x-footer.footer>
@stop
