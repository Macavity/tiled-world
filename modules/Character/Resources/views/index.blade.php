@extends('character::layouts.master')

@section('module_content')

  <a href="{{ url('char/create') }}">Neuen Charakter erstellen</a>

  <h1>{{ trans('character.switch-character') }}</h1>
  <p>{{ trans('character.switch-description') }}}</p>

  @if(count($characters) > 0)
  <table class="table table-striped">
    <thead>
    <tr>
      <th>#</th>
      <th>Name</th>

    </tr>
    </thead>
    <tbody>
      @foreach($characters as $char)
      <tr>
        <td><img src="{{$char->image}}"></td>
        <td>{{$char->name}}</td>
        <td>
          <a class="btn btn-success" href="{{ url("/char/activate/".$char->id) }}"><i class="glyphicon glyphicon-pushpin"></i> Aktivieren</a>
          <a class="btn btn-danger" href="{{ url("/char/delete/".$char->id) }}"><i class="glyphicon glyphicon-trash"></i> Löschen</a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif
@stop