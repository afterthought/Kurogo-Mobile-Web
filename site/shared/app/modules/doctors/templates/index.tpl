{include file="findInclude:common/templates/header.tpl"}

<div style="text-align:center;">

	<strong>Maine Medical Center</strong>
  <br/>
	<strong style="color:red;">Emergency - Call 911 immediately!</strong>
	
</div>

{$searchAction = $searchPage|default:"/$configModule/search"}

<form action="{$searchAction}" method="GET" data-ajax="false">
<fieldset data-role="fieldcontain">
  	<label for="specialty">Specialty:</label>
  	<div class="picker-field">
	    <select name="specialty" id="specialty" data-theme="s" data-corners="false" data-shadow="false" data-mini="true" data-prevent-focus-zoom="true">
			{html_options options=$specialities}
		  </select>
    </div>
</fieldset>

<fieldset data-role="fieldcontain">
	<label for="city">City:</label>
	<div class="picker-field">
	  <select name="city" id="city" data-theme="s" data-corners="false" data-shadow="false" data-mini="true" data-prevent-focus-zoom="true">
		{html_options options=$cities}
		</select>
	</div>
</fieldset>

<fieldset data-role="fieldcontain">
	<label for="last_name">Last Name:</label>
	<div class="text-field">
	<div class="text-left">
  <input type="Text" id="last_name" autocomplete="off" placeholder="-All-" name="last_name" data-theme="m" data-prevent-focus-zoom="true">
  </div>
  </div>
	<ul id="lastname_suggestions" data-role="listview" data-inset="true" ></ul>
</fieldset>

<fieldset data-role="fieldcontain">  
  <label for="first_name">First Name:</label>
  <div class="text-field">
	<div class="text-left">
	<input type="Text" id="first_name" autocomplete="off" placeholder="-All-" name="first_name" data-theme="m" data-prevent-focus-zoom="true">
	</div>
	</div>
	<ul id="firstname_suggestions" data-role="listview" data-inset="true" ></ul>
</fieldset>

<fieldset data-role="fieldcontain">  
	<label for="gender">Gender Preferences:</label>
	<div class="picker-field">
	  <select name="gender" id="gender" data-theme="s" data-corners="false" data-shadow="false" data-mini="true" data-prevent-focus-zoom="true">
		{html_options options=$genders}
	  </select>
	</div>
</fieldset>

<fieldset data-role="fieldcontain">
  <label for="accepting_new_patients">
  <input type="checkbox" name="accepting_new_patients" id="accepting_new_patients" value="is_accepting"/>Accepting new patients</label>
</fieldset>

<div style="text-align:center;" id="search">
<input type="submit" data-theme="m" data-inline="true" data-corners="false" data-shadow="false" value="Search" />
</div>
</form>

{include file="findInclude:common/templates/footer.tpl"}