{include file="findInclude:common/templates/header.tpl"}

<h2>Address</h2>
{$locations[$item['location']['url']]}
<p class="address_links">  
  <a data-role="none" href="http://maps.google.com/maps?q={$item['address']['street1']} {$item['address']['street2']} {$item['address']['city']} {$item['address']['state']} {$item['address']['zip_code']}">{$item['address']['street1']}, {$item['address']['street2']}
  <br/> 
  {$item['address']['city']}, {$item['address']['state']} {$item['address']['zip_code']}</a>
</p> 
<p>&nbsp;</p>

{if (isset($item['specialties']) && count($item['specialties']) > 0)}
<h2>Specialties</h2>
  {foreach $item['specialties'] as $specialty}
    {$specialties[$specialty['url']]}
    <p>&nbsp;</p>
  {/foreach}

{/if}

{if ($ph->Board1)}
<h2>Board Certification</h2>
{$ph->Board1}
<p>&nbsp;</p>
{/if}

{if ($ph->AppointmentDate)}
<h2>Appointment Date</h2>
{$ph->AppointmentDate}
<p>&nbsp;</p>
{/if}

{if ($ph->MedicalSchool1)}
<h2>Medical School</h2>
{$ph->MedicalSchool1}
<p>&nbsp;</p>
{/if}

{if ($ph->Residency1)}
<h2>Residency</h2>
{$ph->Residency1}
<p>&nbsp;</p>
{/if}

{if ({$gender})}
<h2>Gender</h2>
{$gender}
{/if}



<p>&nbsp;</p>

<a id="edit_page" data-save-url="{$saveUrl}" href="#" onclick="javascript:toggleMercury($(this));return false;">Edit Page</a>

{include file="findInclude:common/templates/footer.tpl"}