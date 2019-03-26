@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-capitalize text-center mt-3">{!! $page->title !!}</h1>
    <div class="bg-white p-3 page-body">
        {!! $page->body !!}
    </div>
</div>


@endsection