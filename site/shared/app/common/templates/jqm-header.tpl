{if !$webBridgeAjaxContentLoad && !$ajaxContentLoad}<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
  <meta http-equiv="content-type" content="application/xhtml+xml" charset="{$charset}" />
  {if $refreshPage}
    <meta http-equiv="refresh" content="{$refreshPage}" />
  {/if}
  <title>{block name="pageTitle"}{if !$isModuleHome}{$moduleName}: {/if}{$pageTitle|strip_tags|escape:'htmlall'}{/block}</title>
  <link rel="shortcut icon" href="/favicon.ico" />
{/if}
  
  {capture name="headerCSS" assign="headerCSS"}
  
    {block name="cssURLs"}
      {foreach $cssURLs as $cssURL}
        <link href="{$cssURL|escape}" rel="stylesheet" media="all" type="text/css"/>
      {/foreach}
    {/block}
  
  
    {block name="minifyCSS"}
      <link href="{$minify['css']|escape}" rel="stylesheet" media="all" type="text/css"/>
    {/block}
    

    {block name="inlineCSS"}
      {foreach $inlineCSSBlocks as $css}
        <style type="text/css" media="screen">
          {$css}
        </style>
      {/foreach}
    {/block}
  {/capture}
  
  {capture name="ajaxContentLoadingHTML" assign="ajaxContentLoadingHTML"}{strip}
    {block name="ajaxContentLoadingHTML"}
      <div class="loading"><div><img src="/common/images/loading.gif" width="27" height="21" alt="Loading" align="absmiddle" />{"AJAX_CONTENT_LOADING"|getLocalizedString}</div></div>
    {/block}
  {/strip}{/capture}
  
  {capture name="ajaxContentErrorHTML" assign="ajaxContentErrorHTML"}{strip}
    {block name="ajaxContentErrorHTML"}
      <div class="nonfocal">{"AJAX_CONTENT_LOAD_FAILED"|getLocalizedString}</div>
    {/block}
  {/strip}{/capture}
  
  {capture name="headerJavascript" assign="headerJavascript"}
    {block name="urlBaseJavascript"}
      <script type="text/javascript">
        var URL_BASE='{$smarty.const.URL_BASE}';
        var API_URL_PREFIX='{$smarty.const.API_URL_PREFIX}';
      </script>
    {/block}
    
    {block name="ajaxJavascript"}
      <script type="text/javascript">
        var AJAX_CONTENT_LOADING_HTML = '{$ajaxContentLoadingHTML|escape:"quotes"}';
        var AJAX_CONTENT_ERROR_HTML = '{$ajaxContentErrorHTML|escape:"quotes"}';
      </script>
    {/block}

    {block name="analyticsJavascript"}
      {if strlen($GOOGLE_ANALYTICS_ID)}
        <script type="text/javascript">
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', '{$GOOGLE_ANALYTICS_ID}']);
          {if $GOOGLE_ANALYTICS_DOMAIN}
          _gaq.push(['_setDomainName', '{$GOOGLE_ANALYTICS_DOMAIN}']);
          {/if}
          _gaq.push(['_trackPageview']);
        </script>
      {/if}
    {/block}
    
    {block name="javascriptURLs"}
      {foreach $javascriptURLs as $url}
        <script src="{$url|escape}" type="text/javascript"></script>
      {/foreach}
    {/block}
    
    {block name="minifyJavascript"}
      <script src="{$minify['js']|escape}" type="text/javascript"></script>
    {/block}
    
    {block name="inlineJavascriptBlocks"}
      {foreach $inlineJavascriptBlocks as $inlineJavascriptBlock}
        <script type="text/javascript">{$inlineJavascriptBlock}</script>
      {/foreach}
    {/block}

    {block name="orientationChangeJavascript"}
      <script type="text/javascript">
        setupOrientationChangeHandlers();
        {if count($onOrientationChangeBlocks)}
          addOnOrientationChangeCallback(function () {ldelim}
            {foreach $onOrientationChangeBlocks as $script}
              {$script}
            {/foreach}
          {rdelim});
        {/if}
      </script>
    {/block}
    
    {block name="onLoadJavascriptBlocks"}
      {if count($onLoadBlocks)}
        <script type="text/javascript">
          function onLoad() {ldelim}
            {foreach $onLoadBlocks as $script}
              {$script}
            {/foreach}
          {rdelim}
        </script>
      {/if}
    {/block}
  {/capture}
  
{if !$webBridgeAjaxContentLoad && !$ajaxContentLoad}
  {block name="css"}
    {$headerCSS}
  {/block}

  {block name="javascript"}
    {$headerJavascript}
  {/block}
  
  {if !$autoPhoneNumberDetection}
  <meta name="format-detection" content="telephone=no">
  {/if}
  <meta name="HandheldFriendly" content="true" />
  {block name="viewportHeadTag"}
    <meta name="viewport" id="viewport" 
      content="width=device-width, {if $scalable|default:true}user-scalable=yes{else}user-scalable=no, initial-scale=1.0, maximum-scale=1.0{/if}" />
  {/block}
  {block name="homeScreenIcon"}
  <link rel="apple-touch-icon" href="{$smarty.const.FULL_URL_BASE|nosecure}common/images/icon.png" />
  <link rel="apple-touch-icon-precomposed" href="{$smarty.const.FULL_URL_BASE|nosecure}common/images/icon.png" />
  {/block}
  {block name="additionalHeadTags"}{/block}
</head>

{capture name="breadcrumbHTML" assign="breadcrumbHTML"}
  {block name="breadcrumbs"}
    {if !$isModuleHome}
      {foreach $breadcrumbs as $breadcrumb}
        {if $breadcrumb@first}
          {$crumbClass = 'module'}
        {elseif count($breadcrumbs) == 1}
          {$crumbClass = 'crumb1'}
        {elseif count($breadcrumbs) == 2}
          {if !$breadcrumb@last}
            {$crumbClass = 'crumb2a'}
          {else}
            {assign var=crumbClass value='crumb2b'}
          {/if}
        {elseif count($breadcrumbs) > 2}
          {if $breadcrumb@last}
            {$crumbClass = 'crumb3c'}
          {elseif $breadcrumb@index == ($breadcrumb@total-2)}
            {assign var=crumbClass value='crumb3b'}
          {else}
            {assign var=crumbClass value='crumb3a'}
          {/if}
          
        {/if}
        {if $configModule != $homeModuleID || !$breadcrumb@first}
          <a href="{$breadcrumb['url']|sanitize_url}" {if isset($crumbClass)}class="{$crumbClass}{/if}">
            {if $breadcrumb@first}
              <img src="/common/images/title-{$navImageID|default:$configModule}.png" width="{$module_nav_image_width|default:28}" height="{$module_nav_image_height|default:28}" alt="" />
            {else}
              <span>{$breadcrumb['title']|sanitize_html:'inline'}</span>
            {/if}
          </a>
        {/if}
      {/foreach}
    {/if}
  {/block}
{/capture}

<body class="{$configModule|capitalize}Module" 
  {block name="onLoad"}
    {if count($onLoadBlocks) || count($onOrientationChangeBlocks)}
      onload="{if count($onLoadBlocks)}onLoad();{/if}onOrientationChange();"
    {/if}
  {/block}>
  <div id="container" data-role="page">
  <div id="nonfooternav" >
    <a name="top"> </a>
    {if isset($customHeader)}
      {$customHeader|default:''}
    {else}
      {block name="navbar"}
        <div id="navbar"{if $hasHelp} class="helpon"{/if} data-role="header">
          <div class="breadcrumbs{if $isModuleHome} homepage{/if}">
            <a href="{$homeLink}" class="homelink" title="{$homeLinkText}">
              <img src="/common/images/homelink.png" width="{$homelink_image_width|default:57}" height="{$homelink_image_height|default:45}" alt="{$homeLinkText}" />
            </a>
            
            {$breadcrumbHTML}
            <span class="pagetitle">
              {if $isModuleHome}
                <img src="/common/images/title-{$navImageID|default:$configModule}.png" width="{$module_nav_image_width|default:28}" height="{$module_nav_image_height|default:28}" alt="" class="moduleicon" />
              {/if}
              {$pageTitle|sanitize_html:'inline'}
            </span>
          </div>
          {if $hasHelp}
            <div class="help">
              <a href="{$helpLink}" title="{$helpLinkText}"><img src="/common/images/help.png" width="{$help_image_width|default:46}" height="{$help_image_height|default:45}" alt="{$helpLinkText}" /></a>
            </div>
          {/if}
        </div>
      {/block}
    {/if}
    {block name="containerStart"}
      <div id="content" data-role="content">
    {/block}
{else}
  {block name="ajaxContentHeader"}
    {foreach $inlineCSSBlocks as $css}
      <style type="text/css" media="screen">
        {$css}
      </style>
    {/foreach}

    <script type="text/javascript">
      {foreach $inlineJavascriptBlocks as $script}
        {$script}
      {/foreach}
    </script>
  {/block}
{/if}