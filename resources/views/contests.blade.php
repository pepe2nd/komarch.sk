@extends('layouts.app')
@section('title',  __('contests.title'))

@section('content')

@include('components.header.header')

<div class="container mx-auto px-6">
    <x-intro
        :title="trans('contests.title')"
        text="“Podporujeme rozvoj architektúry na Slovensku. Sme odbornou organizáciou, ktorá sa zameri ava na vzdelávanie a informovanie verejnosti o potrebách kvalitnej architektúry.“"
    />
    <contests-overview />
</div>

<x-footer.footer></x-footer.footer>

@endsection
