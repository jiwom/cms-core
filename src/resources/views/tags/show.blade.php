@extends('layouts.master')

@section('body', '')

@push('styles')
@endpush

@section('title')
    {{ $slug }} | @parent
@stop

@section('page-title')
    {{ $slug }}
@stop

@section('content')
    <h1>Articles for tag: {{ $slug }}</h1>

    @each('category.partials.articles', $articles, 'article', 'category.partials.no-articles')

    {!! $articles->render() !!}
@stop
