@extends('character::layouts.master')

@section('module_content')
  <style type="text/css">
    <!--
    {CSS_ITEMS}
    -->
  </style>
  <script language="JavaScript" type="text/javascript">
    // <!--

    {FACE_ITEMS}

    function checkFace(){
      var f1 = document.getElementById("face1").value;
      var f2 = document.getElementById("face2").value;
      var f3 = document.getElementById("face3").value;

      f1 = face_items[f1];
      f2 = face_items[f2];
      f3 = face_items[f3];
      if(f1 == 'face123'){
        document.getElementById("face2").value = 0;
        document.getElementById("face3").value = 0;
      }
      else if(f1 == 'face12'){
        document.getElementById("face2").value = 0;
      }
      else if(f1 == 'face13'){
        document.getElementById("face3").value = 0;
      }

      if(f2 == 'face23'){
        document.getElementById("face3").value = 0;
      }

      // disable face2 if face1 == 12
      if(f1 == 'face12' || f1 == 'face123'){
        //document.getElementById("status").innerHTML = 'f2d,';
        document.getElementById("face2").disabled = 1;
      }
      else{
        //document.getElementById("status").innerHTML = 'f2,';
        document.getElementById("face2").disabled = 0;
      }

      // disable face3?
      if((f1 == 'face13' || f1 == 'face123' || f2 == 'face23') && (f1 != 'face12')){
        //document.getElementById("status").innerHTML += 'f3d,';
        document.getElementById("face3").disabled = 1;
      }
      else{
        //document.getElementById("status").innerHTML += 'f3,';
        document.getElementById("face3").disabled = 0;
      }
    }

    function equip_change(){
      document.getElementById("update").value = "update";
      document.getElementById("form").action = "rpg_portal.php?s=equip&action=update";
      document.getElementById('update_equip').style.display = "inline";
      checkFace();
    }
    function changeLists(){

      var v_nextAct = document.getElementById("nextAct").value;
      var v_item = document.getElementById("u_item").value;
      var v_skill = document.getElementById("u_skill").value;
      var v_dungeon = document.getElementById("battleground").value;
      var v_upd = document.getElementById("update").value

      if(v_nextAct == "item"){
        document.getElementById('u_item').style.display = 'inline';
        document.getElementById('u_skill').style.display = 'none';
      }
      if(v_nextAct == "skill"){
        document.getElementById('u_item').style.display = 'none';
        document.getElementById('u_skill').style.display = 'inline';
      }
      if(v_nextAct == "weapon"){
        document.getElementById('u_item').style.display = 'none';
        document.getElementById('u_skill').style.display = 'none';
      }
      if((v_nextAct != -1 && v_dungeon != -1) && (v_item != -1 || v_skill != -1 || v_nextAct == "weapon") && v_upd != "update"){
        document.getElementById('submitform').value = "Let me Fight!"
        document.getElementById('submitform').style.display = "inline"
        document.getElementById('update_equip').style.display = "none"
        document.getElementById('form').action = "rpg_fight.php"
      }
      if(v_dungeon == -1){
        document.getElementById('submitform').style.display = "none"
      }

    }
    checkFace();
    // -->
  </script>{PRELOAD}

  <form action="{U_FORM}" name="form" id="form" method="post">
    <input type="hidden" name="phase" value="selectStuff">
    <input name="round" type="hidden" id="round" value="0">
    <input name="mTime" type="hidden" id="mTime" value="0">
    <input name="pTime" type="hidden" id="pTime" value="0">
    <input name="update" type="hidden" id="update" value="0">
    <input name="command" type="hidden" id="command" value="{COMMAND}">
    {HIDDEN}
    <table width="100%" class="forumline" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td>
          <table width="100%" border="0" cellpadding="2" cellspacing="1" border="0">
            <tr>
              <th class="thHead" colspan="6"><strong>{{trans('game.TITLE')}}</strong></th>
            </tr>
            <tr>
              <td colspan="6" height="1" class="row1"><img src="templates/subSilver/images/spacer.gif" width="1" height="1" /></td>
            </tr>
            <tr>
              <td width="52%" class="row2">
                <table width="100%" border="0">
                  <tr class="genmed">
                    <td class="row1">{{trans('game.STR')}}:</td>
                    <td class="row2">{STR}</td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1">{{trans('game.CON')}}:</td>
                    <td class="row2">{CON}</td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1">{{trans('game.INT')}}: </td>
                    <td class="row2">{INT}</td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1">{{trans('game.DEX')}}: </td>
                    <td class="row2">{DEX}</td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1">{{trans('game.AGI')}}: </td>
                    <td class="row2">{AGI}</td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1">{{trans('game.LUK')}}:</td>
                    <td class="row2"> {LUK}</td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1"> {{trans('game.LEVEL')}} {LEVEL} {CLASS} </td>
                    <td class="row2"></td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1">{{trans('game.HP')}}</td>
                    <td class="row2"> {HP} </td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1">{{trans('game.SP')}}</td>
                    <td class="row2"> {SP} </td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1"> {{trans('game.LOCATION')}}: {LOC} </td>
                    <td class="row2">{LOC}</td>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <table width="110" border="0">
                        <tr>
                          <td width="110" height="105" valign="top" align="left"><div align="left">{IMAGE}</div></td>
                        </tr>
                      </table><p id="status"></p>
                    </td>
                  </tr>
                </table>
              </td>
              <td width="48%" align="right" valign="top" class="row1">
                <table align="right" width="100%" border="0" cellspacing="1">
                  <tr class="genmed">
                    <td class="row1">{{trans('game.HELMS')}}</td>
                    <td class="row2"><span class="genmed"><select name="face1" id="face1" onChange="equip_change();" class="item">
                          <option value="0" class="genmed">- None -</option>
                          {O_FACE1}
                        </select></span></td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1">{{trans('game.FACE')}}</td>
                    <td class="row2"><span class="genmed"><select name="face2" id="face2" onChange="equip_change();">
                          <option value="0" class="genmed">- None -</option>
                          {O_FACE2}
                        </select></span></td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1"></td>
                    <td class="row2"><span class="genmed"><select name="face3" id="face3" onChange="equip_change();">
                          <option value="0" class="genmed">- None -</option>
                          {O_FACE3}
                        </select></span></td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1">{{trans('game.BREAST')}}</td>
                    <td class="row2"><span class="genmed"><select name="armour" id="armour" onChange="equip_change();">
                          <option value="0" class="genmed">- None -</option>
                          {O_BREAST}
                        </select></span></td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1">{{trans('game.GARMENT')}}</td>
                    <td class="row2"><span class="genmed"><select name="garment" id="garment" onChange="equip_change();">
                          <option value="0" class="genmed">- None -</option>
                          {O_GARMENT}
                        </select></span></td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1">{{trans('game.SHOES')}}</td>
                    <td class="row2"><span class="genmed"><select name="shoes" id="shoes" onChange="equip_change();">
                          <option value="0" class="genmed">- None -</option>
                          {O_SHOES}
                        </select></span></td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1">{{trans('game.ACC')}}</td>
                    <td class="row2"><span class="genmed"><select name="acc1" id="acc1" onChange="equip_change();">
                          <option value="0" class="genmed">- None -</option>
                          {O_ACC1}
                        </select></span></td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1"></td>
                    <td class="row2"><span class="genmed"><select name="acc2" id="acc2" onChange="equip_change();">
                          <option value="0" class="genmed">- None -</option>
                          {O_ACC2}
                        </select></span></td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1">{{trans('game.RH')}}</td>
                    <td class="row2"><span class="genmed"><select name="r_hand" id="r_hand" onChange="equip_change();">
                          <option value="0" class="genmed">Bare Hands</option>
                          {O_WEAPONS}
                        </select></span></td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1">{{trans('game.LH')}}</td>
                    <td class="row2"><span class="genmed"><select name="l_hand" id="l_hand" onChange="equip_change();">
                          <option value="0" class="genmed">- None -</option>
                          {O_SHIELDS}
                        </select></span></td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1">&nbsp;</td>
                    <td class="row2">&nbsp; </td>
                  </tr>
                  <tr class="genmed">
                    <td class="row1">&nbsp;</td>
                    <td class="row2"> <input type="submit" id="update_equip" name="update_equip" style="display: none;" value="Aktualisieren!" class="mainoption">
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="6" height="1" class="row1">
                <img src="templates/subSilver/images/spacer.gif" width="1" height="1" />
              </td>
            </tr>
            <tr>
              <td colspan="6" height="1" class="row1">
                {QUICK_SLOTS}
              </td>
            </tr>
            <tr>
              <td colspan="6" height="1" class="row1">
                <img src="templates/subSilver/images/spacer.gif" width="1" height="1" />
              </td>
            </tr>
            <tr>
              <td colspan="2" class="row2"><div align="center">{{trans('game.COPYRIGHT')}}</div></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </form>
  {INF_DEBUG}
@stop