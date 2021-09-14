<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="@yield('page_description', __('app.description'))">

    @yield('og')

    @if(App::environment('production') && config('services.google_analytics.tracking_id'))
      <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google_analytics.tracking_id' )}}"></script>
      <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', '{{ config('services.google_analytics.tracking_id') }}'); </script>
    @endif

    <title>
      @hasSection('title')
        @yield('title') | {{__('app.title')}}
      @else
        {{__('app.title')}}
      @endif
    </title>

    @include('components.favicons')
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    @stack('styles')
  </head>

  <body>
    <div id="app">
      <main role="main">
        @yield('content')
      </main>
    </div>

    <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
    @stack('scripts')
  </body>
</html>
