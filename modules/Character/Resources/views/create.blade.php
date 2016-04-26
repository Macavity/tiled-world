@extends('character::layouts.master')

@section('module_content')
	
	<h1>Neuen Character erstellen</h1>

	<form action="{{ url('char') }}" method="POST" class="form-horizontal">
		{!! csrf_field() !!}

    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="panel-title">
          Allgemeiner Hinweis
        </div>
      </div>
      <div class="panel-body">
        Solltest du noch keine Erfahrung mit dem Spiel haben empfehlen wir
        das du dir unsere <a href="http://www.last-anixile.de/wiki/index.php/RPG:Tutorial">Anleitung für die ersten Schritte</a> ansiehst.
        Du kannst es jederzeit in der Navigation (links) wiederfinden.<br><br>
        Und bei Fragen oder Problemen melde dich einfach im <a href="http://www.last-anixile.de/forum/viewforum.php?f=33">LAX-RPG-Forum</a>
      </div>
    </div>

    <p>Bitte gib die gewünschten Daten des neuen Charakters an.</p>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
      <div class="col-sm-10">
        <input name="name" type="text" class="form-control" placeholder="Charaktername" onChange="checkCreateCharaForm();">
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Geschlecht</label>
      <div class="col-sm-10">
        <label class="radio-inline">
          <input type="radio" name="gender" id="gender-male" value="male"> Männlich
        </label>
        <label class="radio-inline">
          <input type="radio" name="gender" id="gender-female" value="female"> Weiblich
        </label>
      </div>
    </div>


    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Klasse</label>
      <div class="col-sm-10">
        <select id="new_job" name="new_job" onChange="checkCreateCharaForm();">
          <option value="arc">Bogensch&uuml;tze</option>
          <option value="thf">Dieb</option>
          <option value="mer">H&auml;ndler</option>
          <option value="mag">Magier</option>
          <option value="aco">Messdiener</option>
          <option value="swd">Schwertk&auml;mpfer</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Frisur</label>
      <div class="col-sm-10">
        <div id="hair-styles--male">
          @foreach($maleHairStyles as $i)
            <div class="col-sm-1">
              <img src="/modules/character/hairstyles/m/{{$i}}_00000.png">
              <input type="radio" name="hair_style" value="{{$i}}">
            </div>
          @endforeach
        </div>
        <div id="hair-styles-female">
          @foreach($femaleHairStyles as $i)
            <div class="col-sm-1">
              <img src="/modules/character/hairstyles/f/{{$i}}_00000.png">
              <input type="radio" name="hair_style" value="{{$i}}">
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Haarfarbe</label>
      <div class="col-sm-10">
        <select id="new_hcolor" name="new_hcolor" onChange="checkCreateCharaForm();">
          <option value="0">Standard</option>
          <option value="FF9900">Blond</option>
          <option value="CC0000">Rot</option>
          <option value="006600">Gr&uuml;n</option>
          <option value="0000CC">Blau</option>
          <option value="330099">Violett</option>
          <option value="663300">Braun</option>
          <option value="FFFFFF">Weiß</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
        <input class="btn btn-default" type="submit" value="Erstellen">
      </div>
    </div>


  </form>


  <script language="JavaScript" type="text/javascript">

    function checkCreateCharaForm(){
      var name = document.getElementById("new_name").value;
      var hcolor = document.getElementById("new_hcolor").value;
      var job = document.getElementById("new_job").value;

      var hair_sel = false;
      for(i = 1; i <= 17; i++){
        if( document.getElementById("new_hair_"+i) && document.getElementById("new_hair_"+i).checked){
          hair_sel = true;
        }
      }
      if(name != "" && hcolor != "" && hair_sel && job != ""){
        document.getElementById("new_submit").disabled = false;
      }
      else{
        document.getElementById("new_submit").disabled = true;
      }
    }
  </script>

@stop