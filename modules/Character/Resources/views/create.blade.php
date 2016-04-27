@extends('character::layouts.master')

@section('module_content')
	<style>

    .hair-style {
      position: relative;
      width: 60px;
      height: 80px;
    }

    .hair-style__input {
      position: absolute;
      top: 40px;
      width: 100%;
      text-align: center;
      left:-2px;
    }

  </style>
	<h1>Neuen Character erstellen</h1>

  @include('errors.common')

	<form id="create-char-form" action="{{ url('char') }}" method="POST" class="form-horizontal">
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
      <label for="name" class="col-sm-2 control-label">Name</label>
      <div class="col-sm-10">
        <input id="name" name="name" type="text" class="form-control" placeholder="Charaktername">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Geschlecht</label>
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
      <label for="job" class="col-sm-2 control-label">Klasse</label>
      <div class="col-sm-10">
        <select id="job" name="job">
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
      <label class="col-sm-2 control-label">Frisur</label>
      <div class="col-sm-10 hair-styles">
        <div id="hair-styles--male">
          @foreach($maleHairStyles as $i)
            <div class="col-sm-1 hair-style">
              <img src="/modules/character/hairstyles/m/{{$i}}_00000.png">
              <input type="radio" name="hair-style" class="hair-style__input" value="{{$i}}">
            </div>
          @endforeach
        </div>
        <div id="hair-styles--female">
          @foreach($femaleHairStyles as $i)
            <div class="col-sm-1 hair-style">
              <img src="/modules/character/hairstyles/f/{{$i}}_00000.png">
              <input type="radio" name="hair-style" class="hair-style__input" value="{{$i}}">
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Haarfarbe</label>
      <div class="col-sm-10">
        <select id="hair-color" name="hair-color">
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
        <input id="create-submit" class="btn btn-default" type="submit" value="Erstellen">
      </div>
    </div>

  </form>


  <script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
      var createForm = $("#create-char-form");
      var checkMale = createForm.find("#gender-male");
      var checkFemale = createForm.find("#gender-female");
      var maleStyles = createForm.find("#hair-styles--male");
      var femaleStyles = createForm.find("#hair-styles--female");

      var onChangeGender = function(event){
        var gender = createForm.find('[name="gender"]:checked').val();

        console.log("change gender to",gender);

        if(gender === "male"){
          maleStyles.show();
          femaleStyles.hide();
        }
        else if(gender === "female"){
          femaleStyles.show();
          maleStyles.hide();
        }
        else {
          femaleStyles.hide();
          maleStyles.hide();
        }
      };

      var validate = function(event){

        var submitButton = createForm.find("#create-submit");

        var name = createForm.find("#name").val();
        var job = createForm.find("#job").val();

        var hairColor = createForm.find("#hair-color").val();

        var hairStyle = createForm.find('[name="hair-style"]:checked').val();

        if(name.length && hairColor.length && hairStyle.length && job.length){
          submitButton.prop("disabled", false);
          return true;
        }
        else{
          submitButton.prop("disabled", true);
          event.preventDefault();
          return false;
        }
      };

      // Event Bindings
      checkFemale.on("change", onChangeGender);
      checkMale.on("change", onChangeGender);

      createForm.on("submit", validate);
      createForm.on("change", "input,select", validate);

      // Execute once for initialization
      onChangeGender();
      validate();

    });
  </script>

@stop