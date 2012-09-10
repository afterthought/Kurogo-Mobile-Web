{$defaultTemplateFile="findInclude:modules/home/templates/heartbutton.tpl"}
{$listItemTemplateFile=$listItemTemplateFile|default:$defaultTemplateFile}
{if $navListHeading}
<div class="nonfocal">
  <h3>{$navListHeading}</h3>
</div>
{/if}
<div data-role="controlgroup" data-type="horizontal" data-mini="true" id="heart_buttons" data-theme="a">
  {foreach $primaryButtons as $key=>$item}
    {if $hideImages}{$item['img']=null}{/if}
    {if !isset($item['separator'])}
      {include file="$listItemTemplateFile" subTitleNewline=$subTitleNewline|default:false icon="$key"}
    {/if}
  {/foreach}
</div>
