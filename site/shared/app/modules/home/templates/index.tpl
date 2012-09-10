{extends file="findExtends:modules/home/templates/index.tpl"}

{block name="homeSpringboard"}

  {include file="findInclude:modules/home/templates/heartbuttons.tpl" primaryButtons=$modules['primary']}
  {if count($modules['secondary'])}

    {include file="findInclude:modules/home/templates/fastnavs.tpl" navlistItems=$modules['secondary']}
  {/if}
{/block}