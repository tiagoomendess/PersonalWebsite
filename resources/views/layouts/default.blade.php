@extends('layouts.base')

@section('base-head')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ mix('/css/all.css') }}">
    @yield('default-head')
@endsection

@section('base-body')
    @yield('default-body')
    <script src="{{ mix('/js/all.js') }}"></script>
@endsection
