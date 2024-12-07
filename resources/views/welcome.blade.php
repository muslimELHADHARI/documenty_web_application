@extends('layout')
@section('title',"homepage")
@section('content')
@auth
@include('include.main')
@endauth
@endsection
