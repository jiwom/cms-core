@extends('admin::layouts.master')

@push('styles')
<style>
    .select2-search__field {
        border: none !important;
    }
</style>
@endpush

@section('title')
    {{trans('profile.edit.title')}} | @parent
@stop

@section('page-title')
    @pageHeader('profile.edit.page-title', 'profile.edit.page-desc', 'fa fa-user')
@stop

@section('content')
    {!! form()->model(currentUser(), ['files'  => true]) !!}
    @include('administrator.profile.partials.info')
    {!! form()->close() !!}
@stop

