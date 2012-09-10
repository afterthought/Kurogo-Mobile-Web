{$defaultTemplateFile="findInclude:modules/home/templates/fastnav.tpl"}
{$listItemTemplateFile=$listItemTemplateFile|default:$defaultTemplateFile}
{if $navListHeading}
<div class="nonfocal">
  <h3>{$navListHeading}</h3>
</div>
{/if}
<ul id="fastnavs">
  {foreach $navlistItems as $item}
    {if $hideImages}{$item['img']=null}{/if}
    {if !isset($item['separator'])}
      <li{if $item['img']||$item['listclass']} class="{$item['listclass']}{if $item['img']} icon{/if}"{/if}>{include file="$listItemTemplateFile" subTitleNewline=$subTitleNewline|default:false}</li>
    {/if}
  {/foreach}
</ul>
