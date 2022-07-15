@extends('layouts.app')
@section('title', $page->title)

<x-og :title="$page->title"
      :description="$page->short_description"
      :url="$page->url"
      :image="$page->cover_image"
></x-og>

@section('content')

<x-header.header></x-header.header>

<div class="container mx-auto px-6">
    <x-nav-submenu :page="$page"></x-nav-submenu>
    <x-intro
        :title="$page->title"
        :text="$page->perex"
    />
    <x-page.page-header :page="$page"></x-page.page-header>
    <x-page.page-content :page="$page"></x-page.page-content>
</div>

<x-footer.footer></x-footer.footer>

@stop
