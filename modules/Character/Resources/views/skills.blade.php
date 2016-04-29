@extends('character::layouts.master')

@section('module_content')
  <form action="{U_FORM}#title" method="post">
    <input type="hidden" name="phase" value="{PHASE}">
    <input type="hidden" name="post_sql" value="{POST_SQL}">
    <a name="title"></a>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="forumline">
      <tr>

        <td width="52%"><table width="100%" border="0" cellpadding="2" cellspacing="1">
            <tr>
              <th class="thHead"><strong>{{trans('game.PLAYER')}} {NAME}</strong></th>
            </tr>
            <tr>
              <td height="1" class="spaceRow"><img src="templates/subSilver/images/spacer.gif" width="1" height="1" /></td>
            </tr>
            <tr class="genmed">
              <td class="row1">{{trans('game.LVL')}} : {LEVEL} , {CLASS}</td>
            </tr>
            {{trans('game.REBIRTH')}}
            <tr class="genmed">
              <td class="row1">{INFO}</td>
            </tr>
            <tr class="genmed">
              <td class="row1">{{trans('game.SKPOINTS')}} {SKP}</td>
            </tr>
            <tr class="genmed">
              <td class="row1">&nbsp;</td>
            </tr>
            <tr class="genmed">
              <td class="row1"> <table border="0" cellpadding="2" cellspacing="1">
                  <tr class="genmed">
                    <td colspan="4"><b>{{trans('game.SKILLS')}}</b></td>
                  </tr>
                  {SKILLS} </table></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>{DEBUG}
  </form>


@stop