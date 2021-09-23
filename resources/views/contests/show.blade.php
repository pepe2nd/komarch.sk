@extends('layouts.app')

@section('title')
{{ $contest->title }}
@stop

<x-og :title="$contest->title"
      :description="$contest->perex"
      :url="$contest->url"
></x-og>

@section('content')
<x-header.header></x-header.header>
<div class="container mx-auto px-6">
    <x-title-with-back :title="__('contests.title')" :back_title="__('contests.navigate_back')" :back_url="route('contests')"></x-title-with-back>
    <x-contest.contest-header :contest="$contest"></x-contest.contest-header>
    <x-contest.contest-content :contest="$contest"></x-contest.contest-content>
</div>
<x-footer.footer></x-footer.footer>
@stop
