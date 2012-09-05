{include file="findInclude:common/templates/header.tpl"}
<div class="focal">
<p id="first_name" data-mercury="simple">{$first_name}</p>
</div>
<img src="{$head_shot['src']}" id="head_shot" data-mercury="image"/>
<p class="smallprint" id="last_name" data-mercury="simple">{$last_name}</p>

<span class="smallprint" id="address[city]" data-mercury="simple">{$address['city']}</span>
<span class="smallprint" id="address[state]" data-mercury="simple">{$address['state']}</span>
<span class="smallprint" id="address[zip_code]" data-mercury="simple">{$address['zip_code']}</span>

<div id="bio" data-mercury="simple">
{$bio}
</div>

<a id="edit_page" data-save-url="{$saveUrl}" href="#" onclick="javascript:toggleMercury($(this));return false;">Edit Page</a>

{include file="findInclude:common/templates/footer.tpl"}