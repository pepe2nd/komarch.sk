@extends('layouts.app')
@section('title', __('documents.title'))

@section('content')

@include('components.header.header')

<div class="container mx-auto px-6">
    <x-intro
        :title="trans('documents.title')"
        :text="trans('documents.perex')"
    />
    <documents-overview />
</div>

<x-footer.footer></x-footer.footer>

@endsection
