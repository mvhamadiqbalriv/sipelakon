@extends('layouts.back')
@section('title')
    Dashboard
@endsection
@section('content')
<br>
<div class="tt-custom-mobile-indent container">
    <div class="tt-categories-title">
        <div class="tt-title">Dashboard</div>
    </div>
    <div class="tt-categories-list">
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="tt-item">
                    <div class="tt-item-header">
                        <ul class="tt-list-badge">
                            <li><a href="{{url('cooperative')}}"><span class="tt-color07 tt-badge">Koperasi</span></a></li>
                        </ul>
                        <h6 class="tt-title"><a href="{{url('cooperative')}}">Data - {{$koperasi_count}}</a></h6>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="tt-item">
                    <div class="tt-item-header">
                        <ul class="tt-list-badge">
                            <li><a href="{{url('post')}}"><span class="tt-color07 tt-badge">Forum</span></a></li>
                        </ul>
                        <h6 class="tt-title"><a href="{{url('post')}}">Postingan - {{$post_count}}</a></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
