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
      @foreach($characters as $character)
      <tr>
        <td>
          <a href="{{route("character_view", compact('character'))}}">
            <img src="{{$character->getImageHead()}}">
          </a>
        </td>
        <td>{{$character->name}}</td>
        <td>
          <a class="btn btn-success" href="{{ url("/char/activate/".$character->id) }}"><i class="glyphicon glyphicon-pushpin"></i> Aktivieren</a>
        </td>
        <td>
          <form action="{{ url('char/delete/'.$character->id) }}" method="POST">
            {!! csrf_field() !!}
            {!! method_field('DELETE') !!}
            <button type="submit" id="delete-task-{{ $character->id }}" class="btn btn-danger">
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