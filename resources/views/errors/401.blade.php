@extends('layouts.app')

@section('content')
  @include('errors.common', ['errors' => ['Unauthorized']])
@endsection
