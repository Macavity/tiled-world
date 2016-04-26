@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				@include('map::sidebar')
			</div>
			<div class="col-md-10">
				@yield('module_content')
			</div>
		</div>
	</div>
@endsection
