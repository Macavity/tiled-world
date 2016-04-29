@extends('character::layouts.master')

@section('module_content')
  <script type="text/javascript" src="/forum/includes/yui/yahoo/yahoo.js"></script>
  <script type="text/javascript" src="/forum/includes/yui/dom/dom.js"></script>
  <script type="text/javascript" src="/forum/includes/yui/event/event.js"></script>
  <script type="text/javascript" src="/forum/includes/yui/animation/animation.js"></script>
  <script type="text/javascript" src="/forum/includes/yui/dragdrop/dragdrop.js"></script>
  <script type="text/javascript" src="/forum/includes/yui/connection/connection.js"></script>
  <script type="text/javascript" src="/forum/includes/yui/container/container.js"></script>
  <link rel="stylesheet" type="text/css" href="/forum/includes/yui/container/assets/container.css" />
  <style type="text/css">
    .item{
      width: 50px;
      float:left;
      text-align:center;
      vertical-align:middle;
    }
  </style>
  <script type="text/javascript" language="javascript">
    iid = 0;

    var handleCancel = function(){
      this.hide();
    };

    var handleSell = function(){
      sellMe();
      this.hide();
    };

    var handleUse = function(){
      useMe();
      //this.hide();
    };

    var detailButtonsUse = [
      { text: "Schlie�en", handler: handleCancel, isDefault: true },
      { text: "Verkaufen", handler: handleSell },
      { text: "Benutzen", handler: handleUse }
    ];

    var detailButtons = [
      { text: "Schlie�en", handler: handleCancel, isDefault: true },
      { text: "Verkaufen", handler: handleSell }
    ];

    function init_details() {

      detailDialog = new YAHOO.widget.Dialog("div_detail", {
        modal:true,
        visible:false,
        width:"350px",
        fixedcenter:true,
        constraintoviewport:true,
        draggable:true
      });
      detailDialog.cfg.queueProperty("buttons", detailButtons);
      detailDialog.render();
    }

    function useMe(){
      window.location.href = "http://www.last-anixile.de/forum/rpg_useitem.php?itemid="+iid;
    }

    function sellMe(){
      amount = document.getElementById('dlg_item_sell').value;
      window.location.href = "http://www.last-anixile.de/forum/rpg_portal.php?s=bs&action=sell&item="+uid+"&amount="+amount;
    }

    function itemInfo(item_id, useritem_id, title, desc, count, value, use, flag, searchtext){
      iid = item_id;
      uid = useritem_id;
      detailDialog.setHeader(title);
      document.getElementById('dlg_item_desc').innerHTML = desc;
      document.getElementById('dlg_item_count').innerHTML = count;
      document.getElementById('dlg_item_sell').value = 1;
      document.getElementById('dlg_item_value').innerHTML = value;

      document.getElementById('dlg_item_href').href = "http://www.last-anixile.de/forum/rpg_portal.php?s=items&itemname="+searchtext;

      if(use == 1){
        detailDialog.cfg.queueProperty("buttons", detailButtonsUse);
        detailDialog.render();
      }
      else{
        detailDialog.cfg.queueProperty("buttons", detailButtons);
        detailDialog.render();
      }

      detailDialog.show();
    }

    YAHOO.util.Event.addListener(window, "load", init_details);
  </script>
  <!-- BEGIN CharaInfo -->
  <table width="99%" cellpadding="4" cellspacing="0" border="0" align="center" class="forumline">
    <tr>
      <th class="thHead" colspan="{SHOPTABLEROWS}">{L_CI_TITLE}</th>
    </tr>
    <tr>
      <td class="row1" align="center">{CI}</td>
    </tr>
  </table><br />
  <!-- END CharaInfo -->

  <table width="99%" cellpadding="4" cellspacing="0" border="0" align="center" class="forumline">
    <tr>
      <th class="thHead" colspan="{SHOPTABLEROWS}">{L_SHOP_TITLE}</th>
    </tr>

    <!-- BEGIN switch_useitems -->
    <tr class="row2">
      <td class="gen">Benutzbare Gegenst&auml;nde:</td>
    </tr>
    <tr class="row1">
      <td>
        <!-- END switch_useitems -->
        <!-- BEGIN use -->
        <div class="item"><a href="javascript:void(0);" {use.ON_CLICK} onMouseOver="return overlib('{use.INFO}', CAPTION, '{use.TITLE}', CENTER);" onMouseOut="nd();"><img src="http://www.last-anixile.de/forum/rpg/items/{use.ITEM_ID}.gif" width="24" height="24" border="0" alt="{use.TITLE}"></a><sub>{use.COUNT}</sub></div>{use.BR}
        <!-- END use -->
        <!-- BEGIN switch_useitems -->
      </td>
    </tr>
    <!-- END switch_useitems -->

    <!-- BEGIN switch_equipitems -->
    <tr class="row2">
      <td class="gen">Ausr&uuml;stbare Gegenst&auml;nde:
    </tr>
    <tr class="row1">
      <td>
        <!-- END switch_equipitems -->
        <!-- BEGIN equip -->
        <div class="item"><a href="javascript:void(0);" {equip.ON_CLICK} onMouseOver="return overlib('{equip.INFO}', CAPTION, '{equip.TITLE}', CENTER);" onMouseOut="nd();"><img src="http://www.last-anixile.de/forum/rpg/items/{equip.ITEM_ID}.gif" width="24" height="24" border="0" alt="{equip.TITLE}"></a><sub>{equip.COUNT}</sub></div>{equip.BR}
        <!-- END equip -->
        <!-- BEGIN switch_equipitems -->
      </td>
    </tr>
    <!-- END switch_equipitems -->

    <!-- BEGIN switch_otheritems -->
    <tr class="row2">
      <td class="gen">Andere Gegenst&auml;nde:
    </tr>
    <tr class="row1">
      <td class="gen">
        <!-- END switch_otheritems -->
        <!-- BEGIN other -->
        <div class="item"><a href="javascript:void(0);" {other.ON_CLICK} onMouseOver="return overlib('{other.INFO}', CAPTION, '{other.TITLE}', CENTER);" onMouseOut="nd();"><img src="http://www.last-anixile.de/forum/rpg/items/{other.ITEM_ID}.gif" width="24" height="24" border="0" alt="{other.TITLE}"></a><sub>{other.COUNT}</sub></div>{other.BR}
        <!-- END other -->
        <!-- BEGIN switch_otheritems -->
      </td>
    </tr>
    <!-- END switch_otheritems -->

    <!-- BEGIN switch_specialitems -->
    <tr class="row2">
      <td class="gen">Spezielle Gegenst&auml;nde:
    </tr>
    <tr class="row1">
      <td>
        <!-- END switch_specialitems -->
        <!-- BEGIN special -->
        <div class="item"><a href="javascript:void(0);" {special.ON_CLICK} onMouseOver="return overlib('{special.INFO}', CAPTION, '{special.TITLE}', CENTER);" onMouseOut="nd();"><img src="http://www.last-anixile.de/forum/rpg/items/{special.ITEM_ID}.gif" width="24" height="24" border="0" alt="{special.TITLE}"></a><sub>{special.COUNT}</sub></div>{special.BR}
        <!-- END special -->
        <!-- BEGIN switch_specialitems -->
      </td>
    </tr>
    <!-- END switch_specialitems -->
  </table>
  <br>
  <table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
    <tr>
      <th class="thHead" colspan="2">{PERSONAL_INFORMATION}</th>
    </tr>
    {SHOPPERSONAL}
  </table>
  <br>
  <table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
    <tr>
      <th class="thHead" colspan="2">Actions</th>
    </tr>
    {ACTIONS}

  </table>
  <table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
    <tr>
      <td width="100%" align="center" class="row1"><span class="gensmall">Copyright 2007 &copy; by Macavity</span></td>
    </tr>
  </table>
  <br	clear="all" />
  <div id="div_detail">
    <div class="hd">Detailansicht</div>
    <div class="bd">
      <table>
        <tr>
          <td valign="top">Beschreibung:</td>
          <td><span id="dlg_item_desc">&nbsp;</span></td>
        <tr>
        <tr>
          <td valign="top">Wert:</td>
          <td><span id="dlg_item_value">&nbsp;</span></td>
        <tr>
        <tr>
          <td valign="top">Im Besitz:</td>
          <td><span id="dlg_item_count">&nbsp;</span></td>
        <tr>
        <tr>
          <td valign="top">Verkaufen:</td>
          <td valign="middle"><input type="text" name="amount" id="dlg_item_sell" value="0" size="5"><img src="/forum/rpg/images/sell.gif" onClick="sellMe();" style="cursor:pointer;"></td>
        <tr>
        <tr>
          <td valign="top">Weitere Informationen:</td>
          <td><a id="dlg_item_href" href="http://www.last-anixile.de/forum/rpg_portal.php?s=items&itemname=">Link zur Item DB</a></td>
        <tr>
      </table>
    </div>
  </div>

@stop