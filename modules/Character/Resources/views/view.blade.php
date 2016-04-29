@extends('character::layouts.master')

@section('module_content')
	
	<h1>{{trans("character::view.title")}}</h1>
	
	<div>
		<form action="{{route("character_update")}}" method="post">
			<input type="hidden" name="phase" value="{PHASE}">
			<input type="hidden" name="post_sql" value="{POST_SQL}">
			<a name="title"></a>
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="forumline">
				<tr>
					<th colspan="5" class="thHead"><strong>{{$name}}</strong></th>
				</tr>
				<tr>
					<td colspan="5" height="1" class="spaceRow"><img src="templates/subSilver/images/spacer.gif" width="1" height="1" /></td>
				</tr>
				<tr class="genmed">
					<td colspan="5" class="row1">{L_LVL} : {LEVEL} , {CLASS}</td>
				</tr>
				{L_REBIRTH}
				<tr class="genmed">
					<td colspan="5" class="row1">&nbsp;{INFO}</td>
				</tr>
				<tr>
					<td colspan="4" class="row1" valign="top">{LVLUP}{CLASSUP}{STATUS} </td>
					<td align="right" class="row1" valign="top"><img src="rpg/images/notiz.gif" alt="{INF_DEBUG}" title="{INF_DEBUG}" width="15" height="14"></td>
				</tr>
				<tr class="genmed">
					<td class="row1">Name:</td>
					<td colspan="2" class="row2">{NAME2}</td>
					<td colspan="2" class="row1">&nbsp;</td>
				</tr>
				<tr class="genmed">
					<td class="row1">Gildenzugeh&ouml;rigkeit:</td>
					<td colspan="2" class="row2">{GUILD_INFO}</td>
					<td colspan="2" class="row1">&nbsp;</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{L_STR}</td>
					<td class="row2"> {STR}</td>
					<td class="row2">{STATUP_STR}</td>
					<td class="row1">{L_HP}</td>
					<td class="row2">{HP}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{L_CON}</td>
					<td class="row2">{CON} </td>
					<td class="row2">{STATUP_CON}</td>
					<td class="row1">{L_SP}</td>
					<td class="row2">{SP}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{L_INT}</td>
					<td class="row2">{INT} </td>
					<td class="row2">{STATUP_INT}</td>
					<td class="row1">{L_ATK}</td>
					<td class="row2">{ATK}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{L_DEX}</td>
					<td class="row2">{DEX} </td>
					<td class="row2">{STATUP_DEX}</td>
					<td class="row1">{L_DEF}</td>
					<td class="row2">{DEF}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{L_AGI}</td>
					<td class="row2"> {AGI}</td>
					<td class="row2">{STATUP_AGI}</td>
					<td class="row1">{L_DAM}</td>
					<td class="row2">{DAM}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{L_LUK}</td>
					<td class="row2"> {LUK}</td>
					<td class="row2">{STATUP_LUK}</td>
					<td class="row1">{L_MATK}</td>
					<td class="row2">{MATK}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{L_SPEED}</td>
					<td class="row2">{SPEED}</td>
					<td class="row2">&nbsp; </td>
					<td class="row1">{L_MDEF}</td>
					<td class="row2">{MDEF}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{L_HIT}</td>
					<td class="row2">{HIT}</td>
					<td class="row2">&nbsp;</td>
					<td class="row1">{L_CAST}</td>
					<td class="row2">{CAST}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{L_FLEE}</td>
					<td class="row2">{FLEE}</td>
					<td class="row2">&nbsp;</td>
					<td class="row1">{L_CRIT}</td>
					<td class="row2">{CRIT}</td>
				</tr>
				<tr class="genmed">
					<td colspan="5" class="row1">&nbsp;</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{L_STPOINTS}</td>
					<td class="row2">{STP}</td>
					<td class="row2">&nbsp;</td>
					<td class="row1">{L_EXP}</td>
					<td class="row2">{EXP}</td>
				</tr>
				<tr class="genmed">
					<td class="row1">{L_SKPOINTS}</td>
					<td class="row2">{SKP}</td>
					<td class="row2">&nbsp;</td>
					<td class="row1">{L_JEXP}</td>
					<td class="row2">{JEXP}</td>
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
					<td valign="top" class="row1">{IMAGE}</td>
				</tr>
				<tr class="genmed">
					<td colspan="5" class="row2"> <div align="left">{DEBUG} </div></td>
				</tr>
				<tr>
					<td colspan="5" height="1" class="spaceRow"><img src="templates/subSilver/images/spacer.gif" width="1" height="1" /></td>
				</tr>
			</table>
			<!--/td>
       </tr>
       <tr>
         <td></td>
       </tr>
      </table-->
		</form>
		<script language="JavaScript" type="text/javascript">
			// <!--
			//if (document.images) animation()
			if (document.images) setImages()
			// -->
		</script>


	</div>

@stop