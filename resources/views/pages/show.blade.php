@extends('layouts.app')
@section('title', $page->title)

<x-page.page-og :page="$page"></x-page.page-og>

@section('content')

<x-header.header></x-header.header>

<div class="container mx-auto px-6">

    <div id="nav-submenu" class="md:flex">
        @foreach ($page->breadcrumbs as $i => $breadcrumb)
            <div class="md:mr-16 lg:mr-24">
                <x-header.header-navigation-list :items="$breadcrumb->children" />
            </div>
        @endforeach
    </div>

    <x-intro
        :title="$page->title"
        text="“{{ __('app.intro') }}”"
    />
    <x-page.page-header :page="$page"></x-page.page-header>
    <x-page.page-content :page="$page"></x-page.page-content>
</div>

<x-footer.footer></x-footer.footer>

@stop

{{--
<div class="container">
    <div class="row">
        <div class="col-12 py-4">

            <nav aria-label="breadcrumb" class="d-none d-lg-block">
              <ol class="breadcrumb bg-transparent p-0 justify-content-start">
                @foreach ($page->breadcrumbs as $breadcrumb)
                    @if ($breadcrumb->url)
                        <li class="breadcrumb-item text-capitalize"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                    @else
                        <li class="breadcrumb-item text-capitalize active" aria-current="page">{{ $breadcrumb->title }}</li>
                    @endif
                @endforeach
              </ol>
            </nav>

            <h1>{{ $page->title }}</h1>

            <div class="text-grey-darker text-sm pb-6 border-b text-grey">
                {{ $page->published_at }} | {{ $page->author }}
            </div>

            <div class="pt-4 page-content">
                {!! $page->text !!}
            </div>

            <div class="pt-4">
                @include('components.tags', ['tags' => $page->tags])
            </div>
        </div>
    </div>
</div>
@endsection
 --}}