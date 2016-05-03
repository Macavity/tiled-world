@extends('layouts.app')

@section('content')
  @include('errors.single', ['description' => 'Unauthorized'])
@endsection
