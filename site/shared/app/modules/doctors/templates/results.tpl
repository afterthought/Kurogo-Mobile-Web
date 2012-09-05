
<ul id="physician_list" data-role="listview" data-theme="g" class="physician_list">
  {foreach $results as $item}
    {if !isset($item['separator'])}
      <li style="min-height:160px;" data-icon="none">
        
        {include file="findInclude:modules/$moduleID/templates/listItem.tpl" subTitleNewline=$subTitleNewline|default:true} 

      </li>
      <div style="text-align:center;margin-top:10px; margin-left:5px; margin-right:5px;padding-bottom:10px; border-style:solid;border-bottom-color:#719CB1;border-bottom-width:2px;">

      </div>
    {/if}
  {/foreach}
  {if ($moreURL)}
    <li id="liMore"><button id="btnMore" data-role="button" data-url="{$moreURL}">More...</button></li>
  {/if}
  
  
  {if count($results) == 0}
    {block name="noResults"}
      <li>{"NO_RESULTS"|getLocalizedString}</li>
    {/block}
  {/if}
</ul>
