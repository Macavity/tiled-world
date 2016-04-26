<?php

/*
 $navi['L_ACTIVE_CHARA'][] = array('L_CHARPAGE','rpg_char.php','char','nav_icon05.gif');
$navi['L_ACTIVE_CHARA'][] = array('L_SKILLS','rpg_charskills.php','skills','nav_icon04.gif');
$navi['L_ACTIVE_CHARA'][] = array('L_EQUIPMENT','rpg_equip.php','equip','nav_icon09.gif');
$navi['L_ACTIVE_CHARA'][] = array('L_INVENTORY','rpg_inventory.php','inventory','nav_icon13.gif');
$navi['L_ACTIVE_CHARA'][] = array('L_CHARAS','rpg_charselect.php','charselect','nav_icon02.gif');
$navi['L_ACTIVE_CHARA'][] = array('Prizelimit (PL)','rpg_pl.php','pl','nav_icon25.gif');
$navi['L_ACTIVE_CHARA'][] = array('-');
$navi['L_ACTIVE_CHARA'][] = array('L_MAP','rpg_map.php','map','nav_icon19.gif');
$navi['L_ACTIVE_CHARA'][] = array('L_CAULDRON','headquarters.php?action=CAULDRON','cauldron','nav_icon10.gif');
$navi['L_ACTIVE_CHARA'][] = array('L_INN','headquarters.php?action=INN','inn','nav_icon14.gif');
$navi['L_ACTIVE_CHARA'][] = array('Zelt aufschlagen','rpg_break.php','break','nav_icon01.gif');
//$navi['L_ACTIVE_CHARA'][] = array('Schmiede','rpg_smithery.php','smithery','nav_icon01.gif','Schmiede');
$navi['L_ACTIVE_CHARA'][] = array('-');
$navi['L_ACTIVE_CHARA'][] = array('Gilden','rpg_guild.php','guilds','nav_icon11.gif');
$navi['L_ACTIVE_CHARA'][] = array('L_MARKETPLACE','shop.php','marketplace','nav_icon17.gif');
//$navi['L_ACTIVE_CHARA'][] = array('L_EVENTSHOP',append_sid('rpg_sp_shop.php'),'','nav_icon17.gif');
$navi['L_ACTIVE_CHARA'][] = array('L_QUEST','rpg_quest.php','quest','nav_icon24.gif');
//$navi['L_ACTIVE_CHARA'][] = array('L_JOBQUEST','rpg_jobquest.php','jobquest','nav_icon12.gif');
$navi['L_ACTIVE_CHARA'][] = array('-');
$navi['L_ACTIVE_CHARA'][] = array('L_RANKING',append_sid('rpg_ranking.php?highlight='.$char->id.'#'.$char->id),'','nav_icon22.gif');
$navi['L_ACTIVE_CHARA'][] = array('L_FIGHTS',append_sid('rpg_list_battles.php?chara=self'),'','nav_icon07.gif');
*/

/*
$navi['L_RPG_SUPPORT_FORUM'][] = array('L_RPG_FORUM',append_sid('viewforum.php?f=33'),'','nav_icon01.gif');
$navi['L_RPG_SUPPORT_FORUM'][] = array('L_RPG_QUESTIONS',append_sid('viewtopic.php?t=656'),'','nav_icon08.gif');
$navi['L_RPG_SUPPORT_FORUM'][] = array('L_RPG_BUGS',append_sid('viewtopic.php?t=246'),'','nav_icon21.gif');
$navi['L_RPG_SUPPORT_FORUM'][] = array('Letzte &Auml;nderung<br>('.$last_change_date.')', append_sid('http://www.last-anixile.de/forum/viewtopic.php?p='.$last_change_id.'#'.$last_change_id),'','nav_icon20.gif');
if($rpg_tech){
  $navi['L_RPG_SUPPORT_FORUM'][] = array('L_RPG_TECH',append_sid('viewforum.php?f=37'),'','nav_icon01.gif');
}

$navi['L_RPG_SUPPORT_WIKI'][] = array('L_RPG_WIKI', 'http://www.last-anixile.de/wiki/index.php?title=LAX-Wiki:Portal','','nav_icon01.gif');
$navi['L_RPG_SUPPORT_WIKI'][] = array('L_RPG_TUTORIAL', 'http://www.last-anixile.de/wiki/index.php?title=RPG:Tutorial','','nav_icon23.gif');
$navi['L_RPG_SUPPORT_WIKI'][] = array('FAQ',   'http://www.last-anixile.de/wiki/index.php?title=RPG:FAQ','','nav_icon18.gif');
$navi['L_RPG_SUPPORT_WIKI'][] = array('L_RPG_MAP', 'http://www.last-anixile.de/wiki/index.php?title=RPG:Karte','','nav_icon15.gif');
$navi['L_RPG_SUPPORT_WIKI'][] = array('Karte in Farbe',   'http://www.last-anixile.de/wiki/index.php?title=RPG:Weltkarte','','nav_icon15.gif');

// Council Link
$sql = "SELECT * FROM " . USER_GROUP_TABLE . " WHERE user_id = '{$userdata['user_id']}' AND group_id = 778";
if ( !($result = $db->sql_query($sql)) ){
  message_die(GENERAL_ERROR, 'Error getting group information', '', __LINE__, __FILE__, $sql);
}
if( $db->sql_numrows($result) > 0 ){
  $sql1 = "SELECT * FROM {$table_prefix}trades WHERE id > 1176 AND (state = 'ready' OR state = 'gift')";
  if( !($result1 = $db->sql_query($sql1)) ){
    message_die(GENERAL_ERROR, 'SQL Fehler!', '', __LINE__, __FILE__, $sql1);
  }
  $to_council = $db->sql_numrows($result1);

  $navi['L_TOOLS'][] = array('Council ('.$to_council.')',append_sid('rpg_council_trade.php'),'','nav_icon01.gif');
}
$navi['L_TOOLS'][] = array('Item DB','rpg_item_list.php','items','nav_icon01.gif');
if($rpg_tech){
  $navi['L_TOOLS'][] = array('Adm Item DB','adm_enlist_items.php','adm_items','nav_icon01.gif');
}
// 104 = Macavity, 75 = shizo, 54 = Morpheusz, 57 = Kadaj, 713 = Santana, 639 = Deval
if( $rpg_tech || $user713 ){
  $navi['L_TOOLS'][] = array('Map Editor','adm_new_map_v2.1.php','','nav_icon01.gif');
}
  $navi['L_TOOLS'][] = array('KS v3.1','rpg_fight_v3_1.php','','nav_icon01.gif');

$navi['L_TOOLS'][] = array('Inventar v2.0','rpg_inventory.php','inventory2','nav_icon01.gif');
*/


?>

<div class="map-sidebar">
  <div class="list-group">
    <h3>RPG</h3>
    <a class="list-group-item" href="{{ url('/map') }}">Map</a>
    <a class="list-group-item" href="{{ url('/char') }}">Character</a>
    <a class="list-group-item" href="{{ url('/char/skills') }}">Skills</a>
    <a class="list-group-item" href="{{ url('/char/equipment') }}">Equipment</a>
    <a class="list-group-item" href="{{ url('/char/inventory') }}">Inventory</a>
    <a class="list-group-item" href="{{ url('/char/select') }}">Change Character</a>
    <a class="list-group-item" href="{{ url('/char/pl') }}">Prizelimit</a>
    <a class="list-group-item" href="{{ url('/char') }}">Cauldron</a>
    <a class="list-group-item" href="{{ url('/guild') }}">Guild</a>
    <a class="list-group-item" href="{{ url('/marketplace') }}">Marketplace</a>
    <a class="list-group-item" href="{{ url('/event/shop') }}">Event Shop</a>
    <a class="list-group-item" href="{{ url('/char/quest') }}">Quest</a>
    <a class="list-group-item" href="{{ url('/char/jobquest') }}">Jobquest</a>
    <a class="list-group-item" href="{{ url('/stats/ranking') }}">Ranking</a>
    <a class="list-group-item" href="{{ url('/stats/fight-history') }}">Fight History</a>
  </div>
</div>