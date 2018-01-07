<?php
/**
    ===============================================================
    @author     : Mateusz 'Snake_' Ciećka;    
    @version    : 1.0 BETA;
    @mybb       : compatibility MyBB 1.8.x;
    @description: -
    @homepage   : http://polski-freeroam.pl 
    ===============================================================
 **/

if (!defined("IN_MYBB"))
{
    die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}

class postUrlActivator
{

    public static function activate()
    {
        global $db;

        $mainTemplateHTML = '<div class="float_right" style="vertical-align: top">
<strong><a href="#" class="open-modal-postUrl" data-selector="#postUrl-{$post[\'pid\']}" rel="modal:open">#{$post_number}</a></strong>
{$post[\'inlinecheck\']}
</div>
<div id="postUrl-{$post[\'pid\']}" style="display: none;">
    <table class="tborder" cellspacing="0" style="text-align: center;">
      <tr>
        <td class="thead">
          <strong>Post URL</strong>
        </td>
      </tr>
      <tr>
          <td class="trow1"><strong>Link:</strong><br /><input style="width: 90%" type="text" value="{$url}" onfocus="this.select();" readonly></td>
      </tr>
        <tr>
            <td class="trow1"><strong>BBCode Link:</strong><br /><input style="width: 90%" type="text" value="{$urlBBCode}" onfocus="this.select();" readonly></td>
      </tr>
        <tr>
            <td class="trow1"><strong>HTML Link:</strong><br /><input style="width: 90%" type="text" value="{$urlHTML}" onfocus="this.select();" readonly></td>
      </tr>
    </table>
</div>

<script type="text/javascript">
  $(\'a.open-modal-postUrl\').click(function(event) {
    var modalSelector = $(this).attr(\'data-selector\');
    event.preventDefault();
    $(modalSelector).modal({
      fadeDuration: 250,
      keepelement: true
    });
    return false;
  });
</script>';

        $mainTemplate = [
            'title' => 'postUrl_modal',
            'template' => $db->escape_string($mainTemplateHTML),
            'sid' => '-1',
            'version' => '',
            'dateline' => time()
        ];

        $db->insert_query('templates', $mainTemplate);

    }
    
    public static function deactivate()
    {
        global $db;
        $db->delete_query("templates", "title LIKE 'postUrl_%'");
    }
}