@extends('character::layouts.master')

@section('module_content')

  <table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr>
    <th colspan="4">{TITLE}</th>
  </tr>
  <tr>
    <td colspan="4" height="1" class="spaceRow"><img src="templates/subSilver/images/spacer.gif" width="1" height="1" /></td>
  </tr>
  <tr class="genmed">
    <td colspan="4" height="1" class="spaceRow">{INFO}</td>
  </tr>
  <!-- BEGIN characters -->
  <tr class="genmed">
    <td class="{characters.ROW_STYLE}" colspan="1" align="middle" valign="middle">
      {characters.IMG_CHARA}</td>
    <td class="{characters.ROW_STYLE}" colspan="1" align="left">
      {characters.D_CHARA}</td>
    <td class="{characters.ROW_STYLE}" colspan="1" align="right" valign="bottom">
      {characters.B_CHANGE_CHARA}{characters.B_DEL_CHARA}</td>
    <td class="{characters.ROW_STYLE}" colspan="1" align="right">
      {characters.S_CHARA}</td>
  </tr>
  <!-- END characters -->
  <tr class="genmed">
    <td colspan="4" height="1" class="spaceRow" align="right">{NEW_CHARA}</td>
  </tr>
  <tr class="genmed">
    <td colspan="4" height="1" class="spaceRow">{DEBUG}</td>
  </tr>
</table>
@stop