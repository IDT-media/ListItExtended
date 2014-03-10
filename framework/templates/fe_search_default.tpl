<div id="{$modulealias}_search">
	{$formstart}
		<label for="{$modulealias}searchinput">{$mod->ModLang('searchfor')}:</label>&nbsp;
		<input type="text" id="{$modulealias}searchinput" name="{$actionid}search" size="20" maxlength="50" value="" />
		<input class="search-button" name="submit" value="{$mod->ModLang('search')}" type="submit" />
	{$formend}
</div>