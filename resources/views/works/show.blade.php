@extends('layouts.app')

@section('title')
    {{ $work->name }}
@stop

<x-work.work-og :work="$work"></x-work.work-og>

@section('content')
<x-header.header></x-header.header>
<div class="container mx-auto px-6">
    <x-work.work-back :work="$work"></x-work.work-back>
    <x-work.work-header :work="$work"></x-work.work-header>
    <x-work.work-content :work="$work"></x-work.work-content>
</div>
<x-footer.footer></x-footer.footer>

@endsection
