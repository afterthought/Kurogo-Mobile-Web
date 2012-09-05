{include file="findInclude:common/templates/header.tpl"}

<h2>Address</h2>
{$location}
<p class="address_links">  
  <a data-role="none" href="http://maps.google.com/maps?q={$address['street1']} {$address['street2']} {$address['city']} {$address['state']} {$address['zip_code']}">{$address['street1']}, {$address['street2']}
  <br/> 
  {$address['city']}, {$address['state']} {$address['zip_code']}</a>
</p> 
<p>&nbsp;</p>

{if ($ph->Specialty)}
<h2>Specialty</h2>
{$ph->Specialty}
<p>&nbsp;</p>
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