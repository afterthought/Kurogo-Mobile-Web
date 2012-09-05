{if ($item['head_shot'])}
 <img src="{$item['head_shot']['src']}" class="profile_photo">
{else}
<img src="images/silhouette.jpg" class="profile_photo">
{/if}
<div class="profile">

  <div class="profile_entry profile_header"><a href="{$item['url']}">{$item['first_name']} {$item['middle_name']} {$item['last_name']}, {$item['title']}</a></div>
  <div class="profile_entry profile_header">{$item->Specialty}</div>
  <p>&nbsp;</p>

  <div class="profile_entry location" style="height:2em;">{$item['location']}</div>
  <br/>
  <div class="address_links">  
    <a data-role="none" href="http://maps.google.com/maps?q={$item['address']['street1']} {$item['address']['street2']} {$item['address']['city']} {$item['address']['state']} {$item['address']['zip_code']}">{$item['address']['city']}, {$item['address']['state']}</a>
  </div>

   <br/>
   <p class="phone_numbers bigger_phone">
     <a data-role="none" href="tel:{$item['phone']}" data-role="none">{$item['phone']}</a>      
   </p>
  </div>