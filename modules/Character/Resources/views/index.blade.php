@extends('character::layouts.master')

@section('module_content')

  <h1>{{ trans('character::character.switch-character') }}</h1>
  <p>{{ trans('character::character.switch-description') }}</p>

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
        <td><img src="{{$char->getImageHead()}}"></td>
        <td>{{$char->name}}</td>
        <td>
          <a class="btn btn-success" href="{{ url("/char/activate/".$char->id) }}"><i class="glyphicon glyphicon-pushpin"></i> Aktivieren</a>
        </td>
        <td>
          <form action="{{ url('char/delete/'.$char->id) }}" method="POST">
            {!! csrf_field() !!}
            {!! method_field('DELETE') !!}
            <button type="submit" id="delete-task-{{ $char->id }}" class="btn btn-danger">
              <i class="fa fa-btn fa-trash"></i> Löschen
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif

  <a href="{{ url('char/create') }}" class="btn btn-default">Neuen Charakter erstellen</a>

@stop