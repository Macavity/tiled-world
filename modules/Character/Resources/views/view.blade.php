@extends('character::layouts.master')

@section('module_content')
	<h1>{{trans("character::view.title")}}</h1>

  <h2>{{$character->name}}</h2>

	<div>
		<form action="{{route("character_update", compact('character'))}}" method="post">
			{!! csrf_field() !!}

      @if($baseLevelUp)
        <div class="alert alert-info" role="alert">
          {{trans('game.LEVELUP')}}
        </div>
      @endif

      @if($jobLevelUp)
        <div class="alert alert-info" role="alert">
          {{trans('game.LEVELUP')}}
        </div>
      @endif

			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="forumline">
				<tr class="genmed">
					<td colspan="5" class="row1">{{trans('game.LVL')}} : {{$character->base_level}}, {{$jobName}}</td>
				</tr>
				<tr class="genmed">
					<td colspan="5" class="row1">&nbsp;{{-- INFO --}}</td>
				</tr>
				<tr>
					<td colspan="5" class="row1" valign="top">
            @foreach($character->statusEffects as $statusEffect)
              <img src="{{$statusEffect->getIconSrc()}}" />&nbsp;
            @endforeach
          </td>
				</tr>
				<tr class="genmed">
					<td class="row1">Name:</td>
					<td colspan="2" class="row2"><strong>{{$character->name}}</strong></td>
					<td colspan="2" class="row1">&nbsp;</td>
				</tr>
				<tr class="genmed">
					<td class="row1">Gildenzugeh&ouml;rigkeit:</td>
					<td colspan="2" class="row2">{}</td>
					<td colspan="2" class="row1">&nbsp;</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{{trans('game.STR')}}</td>
					<td class="row2">{{$character->str}}</td>
					<td class="row2">{{$character->bonusStr}}</td>
					<td class="row1">{{trans('game.HP')}}</td>
					<td class="row2">{{$character->health_points}}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{{trans('game.CON')}}</td>
					<td class="row2">{{$character->con}} </td>
					<td class="row2">{{$character->bonusCon}}</td>
					<td class="row1">{{trans('game.SP')}}</td>
					<td class="row2">{{$character->special_points}}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{{trans('game.INT')}}</td>
					<td class="row2">{{$character->int}} </td>
					<td class="row2">{{$character->bonusInt}}</td>
					<td class="row1">{{trans('game.ATK')}}</td>
					<td class="row2">{{$character->attackPoints()}}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{{trans('game.DEX')}}</td>
					<td class="row2">{{$character->dex}} </td>
					<td class="row2">{{$character->bonusDex}}</td>
					<td class="row1">{{trans('game.DEF')}}</td>
					<td class="row2">{{$character->defensePoints()}}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{{trans('game.AGI')}}</td>
					<td class="row2">{{$character->agi}}</td>
					<td class="row2">{{$character->bonusAgi}}</td>
					<td class="row1">{{trans('game.DAM')}}</td>
					<td class="row2">{{$character->damagePoints()}}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{{trans('game.LUK')}}</td>
					<td class="row2">{{$character->luk}}</td>
					<td class="row2">{{$character->bonusLuk}}</td>
					<td class="row1">{{trans('game.MATK')}}</td>
					<td class="row2">{{$character->magicAttackPoints()['min']}}~{{$character->magicAttackPoints()['max']}}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{{trans('game.SPEED')}}</td>
					<td class="row2">{{$character->speed()}}</td>
					<td class="row2">&nbsp; </td>
					<td class="row1">{{trans('game.MDEF')}}</td>
					<td class="row2">{{$character->magicDefensePoints()}}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{{trans('game.HIT')}}</td>
					<td class="row2">{{$character->hit()}}</td>
					<td class="row2">&nbsp;</td>
					<td class="row1">{{trans('game.CAST')}}</td>
					<td class="row2">{{$character->cast()}}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{{trans('game.FLEE')}}</td>
					<td class="row2">{{$character->flee()}}</td>
					<td class="row2">&nbsp;</td>
					<td class="row1">{{trans('game.CRIT')}}</td>
					<td class="row2">{{$character->crit()}}</td>
				</tr>
				<tr class="genmed">
					<td colspan="5" class="row1">&nbsp;</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{{trans('game.STPOINTS')}}</td>
					<td class="row2">{{$character->statPoints()}}</td>
					<td class="row2">&nbsp;</td>
					<td class="row1">{{trans('game.EXP')}}</td>
					<td class="row2">
            @include('character::partials.bar', ['type' => 'success', 'percent' => $baseExpPercent])
          </td>
				</tr>
				<tr class="genmed">
					<td class="row1">{{trans('game.SKPOINTS')}}</td>
					<td class="row2">{{$character->skillPoints()}}</td>
					<td class="row2">&nbsp;</td>
					<td class="row1">{{trans('game.JEXP')}}</td>
					<td class="row2">
            @include('character::partials.bar', ['type' => 'success', 'percent' => $jobExpPercent])
          </td>
				</tr>
				<tr class="genmed">
					<td colspan="4" class="row1">&nbsp;</td>
					<td valign="top" class="row1">&nbsp;</td>
				</tr>
				<tr class="genmed">
					<td valign="top" class="row1">Beschreibung:</td>
					<td class="row2" colspan="3"><textarea name="bio" cols="80" rows="3" class="post">{BIO}</textarea>
						<input type="submit" id="upd_bio" name="upd_bio" value="Aktualisieren" class="liteoption">
					</td>
					<td valign="top" class="row1"><img src="{{$character->getImageFull()}}"/></td>
				</tr>
			</table>
		</form>
	</div>

@stop