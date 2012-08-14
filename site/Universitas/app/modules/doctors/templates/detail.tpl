{include file="findInclude:common/templates/header.tpl"}
<div class="focal">
<p id="first_name" data-mercury="{$first_name['type']}">{$first_name['value']}</p>
</div>
<img src="{$head_shot['src']}" id="head_shot" data-mercury="image"/>
<p class="smallprint" id="last_name" data-mercury="{$last_name['type']}">{$last_name['value']}</p>

<div id="bio" data-mercury="{$bio['type']}">
{$bio['value']}
</div>

<a id="edit_page" data-save-url="{$saveUrl}" href="#" onclick="javascript:toggleMercury($(this));return false;">Edit Page</a>

{include file="findInclude:common/templates/footer.tpl"}