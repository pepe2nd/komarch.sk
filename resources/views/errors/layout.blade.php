@extends('layouts.app')

@php
  $title = 'Error '.$error_number;
@endphp

@section('content')

<x-header.header></x-header.header>

<div class="container mx-auto text-center mt-20">
        <div class="text-xl tracking-tight md:text-2xl">
          ERROR<br>
          {{ $error_number }}
        </div>

        <div class="error_title my-4">
          @yield('title')
        </div>

        <x-link-arrow :url="route('home')">
            {{ __('app.return_home') }}
        </x-link-arrow>
</div>

<x-footer.footer></x-footer.footer>

@endsection