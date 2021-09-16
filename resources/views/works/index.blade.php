@extends('layouts.app')
@section('title', __('works.works_register') )

<x-og :title="__('works.works_register')"
      :description="__('works.perex')"
      :url="route('works')"
></x-og>

@section('content')

@include('components.header.header')

<div class="container mx-auto px-6">
    <x-intro
        :title="trans('works.works_register')"
        :text="trans('works.perex')"
    />
    <works-overview></works-overview>
</div>

<x-footer.footer></x-footer.footer>

@endsection
