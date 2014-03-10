<?php
$lang['invalid_characters'] = 'Znakovi kao: %s nisu dozvoljeni za to polje: %s';
$lang['item'] = 'Artikal';
$lang['items'] = 'Artikli';
$lang['fielddef'] = 'Definicija polja';
$lang['fielddefs'] = 'Definicije polja';
$lang['template'] = '&Scaron;ablon';
$lang['templates'] = '&Scaron;abloni';
$lang['category'] = 'Kategorija';
$lang['categories'] = 'Kategorije';
$lang['option'] = 'Opcija';
$lang['options'] = 'Opcije';
$lang['back'] = 'Jednu stran nazad';
$lang['item_title'] = 'Naslov';
$lang['prompt_item_title'] = 'Naslov Artikla';
$lang['active'] = 'Aktivno';
$lang['time_control'] = 'Koristite kontrolu vremena';
$lang['start_time'] = 'Datum početka';
$lang['end_time'] = 'Datum kraja';
$lang['item_title_empty'] = 'Naslov artikla je prazan';
$lang['required_field_empty'] = 'Obavezno polje je prazno';
$lang['too_long'] = 'Vrednost polja prelazi maksimalnu dužinu';
$lang['approve'] = 'Postavi status na &quot;Aktivan&quot;';
$lang['revert'] = 'Postavi status na &#039;Dekativiran&#039;';
$lang['submit_order'] = 'Sačuvaj redosled';
$lang['delete_selected'] = 'Izbri&scaron;i izabrana %s';
$lang['areyousure_deletemultiple'] = 'Da li ste sigurni da želite da izbri&scaron;ete %s?';
$lang['select_all'] = 'Izaberi sve';
$lang['error_startgreaterend'] = 'Datum početka je veće od krajnjeg datuma.';
$lang['item_alias_exists'] = 'Alias artikla postoji. Alias mora biti jedinstven.';
$lang['return_url'] = 'Nazad';
$lang['pathcontainsvars'] = 'Ovo polje može se izmeniti nakon čuvanja ovog %s';
$lang['editfielddef'] = 'Izmeni definiciju polja';
$lang['fielddef_name'] = 'Ime';
$lang['fielddef_help'] = 'Koristan savet';
$lang['fielddef_type'] = 'Tip';
$lang['fielddef_max_length'] = 'Maksimalna dužina';
$lang['fielddef_required'] = 'Obavezno';
$lang['extra'] = 'Dodatno';
$lang['textbox'] = 'Tekst polje';
$lang['checkbox'] = 'Polje za potvrdu';
$lang['textarea'] = 'Zona teksta';
$lang['select_date'] = 'Izbor Datuma';
$lang['upload_file'] = 'Upload datoteke';
$lang['dropdown'] = 'Dropdovn';
$lang['gallery'] = 'Dropdovn Galerije';
$lang['multiselect'] = 'Multiselect';
$lang['hierarchy'] = 'Stranice';
$lang['select_file'] = 'Izbor datoteke';
$lang['fieldset_start'] = 'Fieldset početak';
$lang['fieldset_end'] = 'Fieldset kraj';
$lang['fielddef_name_empty'] = 'Ime polja definicije je prazno';
$lang['fielddef_name_exists'] = 'Ime polja definicije postoji';
$lang['fielddef_alias_exists'] = 'Alis polja definicje postoji. Alias mora biti jedinstven.';
$lang['invalid'] = 'Vrednost polja je nevažeć';
$lang['status_required'] = 'Postavi status na &#039;potreban&#039;';
$lang['status_optional'] = 'Postavi status na &#039;opcionalan&#039;';
$lang['is_default'] = 'Pode&scaron;en na &#039;Podrazumevan&#039;';
$lang['status_default'] = 'Postavljen na &#039;Podrazumevan&#039;';
$lang['helptext_title'] = 'Upustvo za moguće definicije polja:';
$lang['gallery_helptext'] = '<ul>
    <li>No extra instructions</li>
</ul>';
$lang['textbox_helptext'] = '<ul>
    <li><strong>Instruction:</strong> <code>size[20]</code><br />
        Possible value: integer</li>
    <li><strong>Instruction:</strong> <code>max_lenght[20]</code><br />
        Possible value: integer</li>
</ul>';
$lang['checkbox_helptext'] = '<ul>
    <li>No extra instruction</li>
</ul>';
$lang['textarea_helptext'] = '<ul>
    <li><strong>Instruction:</strong> <code>max_lenght[20]</code><br />
        Possible value: integer</li>
    <li><strong>Instruction:</strong> <code>wysiwyg[1]</code><br />
        Possible value: 1|0|true|false</li>
</ul>';
$lang['select_date_helptext'] = '<ul>
    <li><strong>Instruction:</strong> <code>size[20]</code><br />
        Possible value: integer</li>
    <li><strong>Instruction:</strong> <code>max_lenght[20]</code><br />
        Possible value: integer</li>
    <li><strong>Instruction:</strong> <code>dateformat[dd/mm/yy]</code><br />
        Possible value: Date format used by the jQuery datepicker. Try googling &#039;jquery formatDate&#039;</li>
</ul>';
$lang['upload_file_helptext'] = '<ul>
    <li><strong>Instruction:</strong> <code>allow[pdf,gif,jpeg,jpg]</code><br />
        Possible value: extension (keep lowercase)</li>
    <li><strong>Instruction:</strong> <code>dir[/path/to/dir]</code><br />
        Possible value: Directory path that will be appended to $config[&#039;uploads_url&#039;] . No slash at the end. {$item_id} and {$item_alias} will be replaced.</li>
    <li><strong>Instruction:</strong> <code>exclude_prefix[thumb_,foo_]</code><br />
        Possible value: prefix</li>
    <li><strong>Instruction:</strong> <code>filebrowser[1]</code><br />
        Possible value: 1|0|true|false<br />
        Note: Sets GBFilePicker to filebrowser mode instead of default dropdown mode</li>
    <li><strong>Instruction:</strong> <code>image[1]</code><br />
        Possible value: 1|0|true|false<br />
        Note: Sets GBFilePicker to show thumbnail image instead of input field.</li>
    <li><strong>Instruction:</strong> <code>create_dirs[1]</code><br />
        Possible value: 1|0|true|false<br />
        Note: Sets GBFilePicker to allow creating new directory. (Depends on user or group as well as GBFilePicker permission)</li>
    <li><strong>Instruction:</strong> <code>delete[1]</code><br />
        Possible value: 1|0|true|false<br />
        Note: Sets GBFilePicker to allow deleting files. (Depends on user or group as well as GBFilePicker permission)</li> 
    <li><strong>Instruction:</strong> <code>show_subdirs[1]</code><br />
        Possible value: 1|0|true|false<br />
        Note: Sets GBFilePicker to allow viewing of subdirectories. (Depends on user or group as well as GBFilePicker permission)</li>                         
</ul>';
$lang['select_file_helptext'] = '<ul>
    <li><strong>Instruction:</strong> <code>allow[pdf,gif,jpeg,jpg]</code><br />
        Possible value: extension (keep lowercase)</li>
    <li><strong>Instruction:</strong> <code>dir[/path/to/dir]</code><br />
        Possible value: Directory path that will be appended to $config[&#039;uploads_url&#039;] . No slash at the end. {$item_id} and {$item_alias} will be replaced.</li>
    <li><strong>Instruction:</strong> <code>exclude_prefix[thumb_,foo_]</code><br />
        Possible value: prefix</li>
</ul>';
$lang['dropdown_helptext'] = '<ul>
    <li><strong>Instruction:</strong> <code>options[apple=Apple,banana=Banana]</code><br />
        Possible value:  key=value</li>
</ul>';
$lang['multiselect_helptext'] = '<ul>
    <li><strong>Instruction:</strong> <code>options[apple=Apple,banana=Banana]</code><br />
        Possible value:  key=value</li>
    <li><strong>Instruction:</strong> <code>size[5]</code><br />
        Possible value: integer</li>
</ul>';
$lang['fieldset_start_helptext'] = '<ul>
    <li>No extra instructions</li>
</ul>';
$lang['fieldset_end_helptext'] = '<ul>
    <li>No extra instructions</li>
</ul>';
$lang['hierarchy_helptext'] = '<ul>
    <li>No extra instructions</li>
</ul>';
$lang['reorder_categories'] = 'Promeni redosled Kategorija';
$lang['edit_category'] = 'Izmeni Kategoriju';
$lang['category_name'] = 'Ime Kategorije';
$lang['category_description'] = 'Opis Kategorije';
$lang['category_name_empty'] = 'Ime Kategorije je prazno';
$lang['category_alias_exists'] = 'Alias Kategorije postoji. Alias mora biti jedinstven.';
$lang['summarytemplate'] = '&Scaron;ablon pregleda';
$lang['summarytemplates'] = '&Scaron;ablone pregleda';
$lang['detailtemplate'] = 'Detalj &scaron;ablon';
$lang['detailtemplates'] = 'Detalj &scaron;ablone';
$lang['searchtemplate'] = '&Scaron;ablon pretraga';
$lang['searchtemplates'] = '&Scaron;ablone pretraga';
$lang['filtertemplate'] = 'Filter &scaron;ablon';
$lang['filtertemplates'] = 'Filter &scaron;ablone';
$lang['edittemplate'] = 'Izmeni &scaron;ablon';
$lang['template_name'] = 'Ime &scaron;ablona';
$lang['template_name_empty'] = 'Ime &scaron;ablona je prazno';
$lang['template_content_empty'] = 'Sadržaj &scaron;ablona je prazan';
$lang['default_templates'] = 'Podrazumevani &scaron;abloni';
$lang['module_options'] = 'Modul opcije';
$lang['url_options'] = 'URL opcije';
$lang['prompt_friendlyname'] = 'Modul ime';
$lang['prompt_adminsection'] = 'Modul admin sekcija';
$lang['prompt_item_singular'] = 'Artikal jednina';
$lang['prompt_item_plural'] = 'Artikal množina';
$lang['prompt_url_prefix'] = 'URL prefiks';
$lang['prompt_display_inline'] = 'Prikaz detalja Inline';
$lang['prompt_item_cols'] = 'Prikaži ova polja u tački pregleda';
$lang['text_sortorder'] = 'Podrazumevani redosled sortiranja artikla';
$lang['ascending'] = 'Rastući';
$lang['descending'] = 'Opadajući';
$lang['main'] = 'Glavni';
$lang['content'] = 'Sadržaj';
$lang['layout'] = 'Izgled sajta';
$lang['usersgroups'] = 'Korisnici i Korisničke grupe';
$lang['extensions'] = 'Ekstenzije';
$lang['siteadmin'] = 'Administracija sajta';
$lang['myprefs'] = 'Pode&scaron;avanja';
$lang['ecommerce'] = 'ECommerce';
$lang['notice'] = 'Notice';
$lang['instances'] = 'Instance';
$lang['installed_instances_warning'] = 'Below is a list of duplicated module instances.<br />Make sure to backup your site (Databse and Files) before &quot;update&quot; action';
$lang['installed_instances'] = 'Instalirane instance';
$lang['instance_name'] = 'Ime instance';
$lang['instance_friendlyname'] = 'Ime';
$lang['instance_smarty'] = 'Smarty tag';
$lang['instance_version'] = 'Verzija';
$lang['instance_upgrade'] = 'Nadogradnja';
$lang['instance_uptodate'] = 'Aktualno';
$lang['instance_moduleupgraded'] = 'Modul nadograđen';
$lang['duplicate_instance'] = 'Dupliraj modul';
$lang['duplicate_description'] = ' can be easily duplicated to multiple module instances with duplicate button.<br /> Install newly copied module from &quot;Extensions &raquo; Modules&quot;.';
$lang['copy_title'] = 'Dupliraj modul';
$lang['submit'] = 'Podnesi';
$lang['default'] = 'Podrazumevani';
$lang['cancel'] = 'Otkaži';
$lang['reset'] = 'Resetuj podrazumevani';
$lang['duplicate'] = 'Dupliraj';
$lang['changessaved'] = 'Va&scaron;e izmene su uspe&scaron;no sačuvane.';
$lang['templaterestored'] = 'Podrazumevani &scaron;ablon je obnovljen.';
$lang['areyousure'] = 'Da li ste sigurni da želite da izbri&scaron;ete?';
$lang['up'] = 'Gore';
$lang['down'] = 'Dole';
$lang['edit'] = 'Izmeni';
$lang['delete'] = 'Izbri&scaron;i';
$lang['nosuchid'] = 'ID ne postoji';
$lang['deleted'] = 'Artikal(i) je uspe&scaron;no izbrisan.';
$lang['add'] = 'Dodaj %s';
$lang['alias'] = 'Alias';
$lang['alias_invalid'] = 'Alias je nevažeći. To mora biti validno PHP ime variable';
$lang['search'] = 'Pretraži';
$lang['searchfor'] = 'Potraži za';
$lang['searchresultsfor'] = 'Traži rezultate za';
$lang['firstpage'] = '<<';
$lang['prevpage'] = '<';
$lang['nextpage'] = '>';
$lang['lastpage'] = '>>';
$lang['module_name'] = 'Modul ime';
$lang['module_name_empty'] = 'Modul ime je prazno';
$lang['module_name_invalid'] = 'Modul ime sadrži nevažeće znake';
$lang['modulecopied'] = 'Modul uspe&scaron;no kopiran';
$lang['filter'] = 'Filter';
$lang['filterprompt'] = 'Filter %s';
$lang['param_filter_missing'] = 'Parameter <em>filter</em> is required in filter mode.';
$lang['all'] = 'Sve';
$lang['moddescription'] = 'ListIt allows you to create lists that you can display throughout your website.';
$lang['postinstall'] = ' has successfully been installed';
$lang['postuninstall'] = ' has successfully been uninstalled';
$lang['changelog'] = '<p>Version 1.1</p><ul><li>Mulitlevel Categories</li><li>Summary Pagination</li><li>Multiple Categories for parameter category</li><li>CMSMS 1.10 ready</li><li>Backend table search</li><li>Exclude Category parameter</li></ul>';
$lang['general'] = 'Op&scaron;ti';
$lang['usage'] = 'Upotreba';
$lang['permissions'] = 'Dozvole';
$lang['duplicating'] = 'Duplicating this module';
$lang['about'] = 'About';
$lang['help_general'] = '<h3>General Info</h3>		
	<p>Simply put, ListIt allows you to create lists that you can display throughout your website. You could make a simple FAQ or Testimonials feature with this module. The web developer defines fields to constrain what data the client can enter. A number of field types can be specified - text input, checkbox, text area, select date, upload file, select file, dropdown - and additional instructions can be set for each type, for example, input field size, max length, WYSIWYG editor, possible drop down values, possible file extensions, directory paths for file selections, date formats, etc..</p>
	<p>An important note of warning - This is not a content construction kit, such as in Drupal. It is meant for small listings, not to store thousands of records. This is because of the database model used (EAV). Also, each bit of data you enter is stored as TEXT data type, regardless of whether it is varchar, boolean, timestamp, etc. This is a restriction of a short development time frame.</p>';
$lang['help_usage'] = '<h3>Usage</h3>			
	<p>You can configure {$module_name} here: Content > {$module_name}</p>
	<p>Place this tag in your page: {{$module_name}}</p>';
$lang['help_usage_options'] = 'After installing the module the next thing to do is set the options.  				
	<ol>					
		<li>To change the name of the module in the menu change the &quot;Module Friendly Name&quot;.</li>
		<li>To change the name of the item tab change the &quot;Item Plural&quot;.</li>
	</ol>';
$lang['help_usage_fielddefs'] = 'Next - set the Field Definitions. 
	<ol>
		<li>Choose from &quot;Text Input&quot;, &quot;Checkbox&quot;, &quot;Text Area&quot;, &quot;Select Date&quot;, &quot;Upload File&quot;, &quot;Select File&quot; &amp; &quot;Dropdown&quot;.</li>
		<li>For each field definition, you can specify additional instructions in the &quot;extra&quot; field. See the &quot;Field Definitions&quot; tab for a list.</li>
		<li>Each item in each list has three default fields. All Field Definitions set here are additional to them.</li>
	</ol>';
$lang['help_usage_categories'] = 'There is a single category by default called &quot;General&quot;. This can be renamed and additional Categories can be added.';
$lang['help_usage_items'] = 'Now we move on to the item list itself. In this example it says &quot;Add Box&quot;, this was renamed in the &quot;Options&quot; tab. 
	<ol>
		<li>The first field is the default &quot;Title&quot; field.</li>
		<li>The &quot;Category&quot; dropdown is also a default field, and if unchanged, will be set to &quot;General&quot;.</li>
		<li>The third default field is the checkbox called &quot;Active&quot;. This allows you to toggle a list entry without deleting it.</li>
	</ol>';
$lang['help_permissions'] = '<h3>Permissions</h3>
	<p>You can specify the following permissions under Users &amp; Groups > Group Permissions</p>
	<ul>
		<li>{$module_name}: Modify Items</li>
		<li>{$module_name}: Modify Categories</li>
		<li>{$module_name}: Modify Options</li>
	</ul>
	<p>To allow non-admin users to upload files, please go to Extensions > GBFilePicker and tick that first checkbox &quot;Show filemanagement options&quot;.</p>';
$lang['help_fielddefs'] = '<h3>Field Definitions</h3>
	<p>The first thing you should configure are your field definitions. <strong>Note:</strong> Field definitions can only be deleted when they&#039;re not in use in order to avoid data loss.</p>
	<p>For each field definition, you can specify additional instructions in the &quot;extra&quot; field.</p>
	<ul>
		<li>
			<p>Instruction: 
			<code>size[20]</code><br />
			Possible value: integer<br />
			Applicable to: Text Input, Select Date</p>    
		</li>
		<li>
			<p>Instruction: 
			<code>max_length[20]
			</code><br />
			Possible value: integer<br />
			Applicable to: Text Input, Text Area, Select Date</p>
		</li>
		<li>
			<p>Instruction: 
			<code>wysiwyg[1]
			</code><br />
			Possible value: 1|0|true|false<br />
			Applicable to: Text Area</p>
		</li>
		<li>
			<p>Instruction: 
			<code>options[apple=Apple,banana=Banana]
			</code><br />
			Possible value: key=value,...<br />
			Applicable to: Dropdown</p>
		</li>
      <li>
      <p>Instruction: 
        <code>allow[pdf,gif,png,jpeg,jpg]
        </code><br />
        Possible value: extension,... (keep lowercase)<br />
        Applicable to: Upload File, Select File
      </p>    
      </li>    
      <li>        
      <p>Instruction: 
        <code>dir[/path/to/dir]
        </code><br />
        Possible value: Directory path that will be appended to 
        <code>$config[&#039;uploads_url&#039;]
        </code>. No slash at the end. <code>{$item_id} and {$item_alias}</code> will be replaced.<br />
        Applicable to: Upload File, Select File
      </p>    
      </li>    
      <li>        
      <p>Instruction: 
        <code>exclude_prefix[thumb_,foo_]
        </code><br />
        Possible value: prefix,...<br />
        Applicable to: Upload File, Select File
      </p>    
      </li>    
      <li>        
      <p>Instruction: 
        <code>dateformat[dd/mm/yy]
        </code><br />
        Possible value: Date format used by the jQuery datepicker. Try googling &#039;jquery formatDate&#039;<br />
        Applicable to: Select Date
      </p>    
      </li>
	  <li>        
      <p>Instruction: 
        <code>filebrowser[1]
        </code><br />
        Possible value: 1|0|true|false<br />
        Applicable to: Upload File<br />
		<b>Note:</b> Sets GBFilePicker to filebrowser mode instead of default dropdown mode
      </p>    
      </li>
      <li>
      <p>Instruction: 
        <code>image[1]
        </code><br />
        Possible value: 1|0|true|false<br />
        Applicable to: Upload File<br />
        <b>Note:</b> Sets GBFilePicker to show thumbnail image instead of input field.
      </p>    
      </li>
      <li>
      <p>Instruction: 
        <code>create_dirs[1]
        </code><br />
        Possible value: 1|0|true|false<br />
        Applicable to: Upload File<br />
        <b>Note:</b> Sets GBFilePicker to allow creating of new direcotires.
      </p>    
      </li> 
      <li>
      <p>Instruction: 
        <code>delete[1]
        </code><br />
        Possible value: 1|0|true|false<br />
        Applicable to: Upload File<br />
        <b>Note:</b> Sets GBFilePicker to allow deleting files.
      </p>    
      </li>
      <li>
      <p>Instruction: 
        <code>show_subdirs[1]
        </code><br />
        Possible value: 1|0|true|false<br />
        Applicable to: Upload File<br />
        <b>Note:</b> Sets GBFilePicker to allow viewing of subdirectories.
      </p>    
      </li>                       
    </ul>
    <p>You can specify multiple instructions separated by a semicolon (
      <code>;
      </code>), for example:
    </p>
    <p>
      <code>allow[pdf];dir[/docs/pdf]</code>
    </p>
    
	<h3>Field Definitions by type</h3>
        
    <ul>
        <li>Text Input: <code>size[20];max_length[20]</code></li>
        <li>Checkbox: <code>-</code></li>
        <li>Text Area: <code>max_length[20];wysiwyg[1]</code></li>
        <li>Select Date: <code>size[20];max_length[20];dateformat[dd/mm/yy]</code></li>
        <li>Upload File: <code>allow[pdf,gif,jpeg,jpg];dir[/path/to/dir];exclude_prefix[thumb_,foo_];filebrowser[1];image[1];</code></li>
        <li>Select File: <code>allow[pdf,gif,jpeg,jpg];dir[/path/to/dir];exclude_prefix[thumb_,foo_]</code></li>
        <li>Dropdown: <code>options[apple=Apple,banana=Banana]</code></li>
        <li>Content Pages: <code>-</code></li>
        <li>Fieldset Start: <code>-</code></li>
        <li>Fieldset End: <code>-</code></li>
    </ul>';
$lang['help_categories'] = '<h3>Categories</h3>
	<p>Multi level categories are supported.</p>';
$lang['help_templates'] = '<h3>Templates</h3>
	<p>If you are not sure what variables are available to use in your templates, try the debug template:</p>
	<p>{{$module_name} summarytemplate=&#039;debug&#039;}</p>
	<p>You can access any field directly when looping through items using its alias, for example, to if you created a field definition with an alias &quot;position&quot;, you can do:</p>';
$lang['help_templates_categories'] = '<p>Besides, you can loop through categories in the summary template just as well as looping through items:</p>';
$lang['help_duplicating'] = '<h3>Duplicating this module</h3>
	<p>This module was made to be easily duplicated. To duplicate this module, follow these steps BEFORE installing the module:</p>
	<ol>    
		<li>Rename the directory &quot;<b>ListIt</b>&quot;</li>    
		<li>Rename &quot;class <b>ListIt</b> extends CMSModule&quot; inside ListIt.module.php</li>    
		<li>Rename &quot;<b>ListIt</b>.module.php&quot;</li>
	</ol>
	<p>Make sure you follow the CMSMS module naming conventions, a-z with no punctuation characters or spaces to be safe :)</p>
	<p>You can always change the module friendly name once installed under &quot;Options&quot; (Content > {$module_name}). To change the icon, replace /modules/{$module_name}/images/icon.gif.</p>';
$lang['help_about'] = '<h3>About</h3>
	<p>Origin of this module comes from <a href="http://dev.cmsmadesimple.org/projects/listit" target="_blank">ListIt Module</a> developed by Ben Malen.<br />As there were no plans on further development of the module some people decided to fork the module and continue with development.<br />
	If you find any bugs please feel free to submit a bug report <a href="http://dev.cmsmadesimple.org/bug/list/1015" target="_blank">here</a> or for any good ideas consider submiting a feature request <a href="http://dev.cmsmadesimple.org/feature_request/list/1015" target="_blank">here</a>. <br />
	Please keep in mind that developers do have their daily jobs which means that feature requests are considered and done as time allows. If you need a feature really badly consider contacting one of the developers for a sponsored development.
	</p>
	<h3>Team</h3>
	<ul>
		<li>Jonathan Schmid (Foaly*) hi@jonathanschmid.de <br />www.jonathanschmid.de</li>
		<li>Goran Ilic (uniqu3) g.ilic@i-arts.eu <br />www.ich-mach-das.at</li>
		<li>Robert Campbell (calguy1000) calguy1000@cmsmadesimple.org  <br />www.calguy1000.com</li>
		<li>Lukas Blatter (nockenfell) nockenfell@gmail.com <br />www.blattertech.ch</li>
		<li>Arnoud (arnoud) arnoud@upservice.nl <br />www.upservice.nl</li>
		<li>Wayne ONeil (wishbone) wayne@teamwishbone.com <br />www.teamwishbone.com</li>
		<li>Tapio L&ouml;ytyy (Stikki) tapsa@blackmilk.fi</li>
	</ul>';
$lang['help_param_action'] = '	Override the default action. Possible values are:
	<ul>
		<li>&quot;default&quot; - displays the summary view.</li>
		<li>&quot;detail&quot; - displays a specified entry in detail mode.</li>
		<li>&quot;search&quot; - displays the search form.</li>
		<li>&quot;filter&quot; - displays the filter form. Parameter <em>filter</em> is required.</li>
	</ul>';
$lang['help_param_showall'] = 'Show all items, irrespective of end date.';
$lang['help_param_category'] = 'Specify an alias or comma separated aliases of the category/categories displayed items must be a member of.';
$lang['help_param_exclude_category'] = 'Specify an alias or comma separated aliases of the category/categories displayed items musn&#039;t be a member of.';
$lang['help_param_subcategory'] = 'If parameter &#039;category&#039; is specified, this parameter set to <em>true</em> will make allowance for subcategories&#039; items. It is set to false by default.';
$lang['help_param_detailtemplate'] = 'The detail template you wish to use.';
$lang['help_param_summarytemplate'] = 'The summary template you wish to use.';
$lang['help_param_searchtemplate'] = 'The search template you wish to use.';
$lang['help_param_orderby'] = 'You can order by any of the following columns: item_id, item_title, item_position, category_id, category_name, category_position, category_hierarchy.<br />
	<ul>
		<li>For example:<br />
		orderby=&#039;category_name, item_title&#039;</li>
		<li>You can also specify ascending or descending for any column, for example:<br />
		orderby=&#039;category_name|asc, item_title|desc&#039;</li>
	</ul>';
$lang['help_param_pagelimit'] = 'Maximum number of items to display (per page).  If this parameter is not supplied all matching items will be displayed.  If it is, and there are more items available than specified in the parameter, text and links will be supplied to allow scrolling through the results';
$lang['help_param_start'] = 'Start at the nth item -- leaving empty will start at the first item.';
$lang['help_param_number'] = 'Maximum number of items to display (per page) -- leaving empty will show all items. This is a synonym for the pagelimit parameter.';
$lang['help_param_detailpage'] = 'Page to display item details in. Must be a page alias. Used to allow details to be displayed in a different page than summary.';
$lang['help_param_item'] = 'This parameter is only applicable to the detail view. It allows specifying which item to display in detail mode. Must be an item alias.';
$lang['help_param_search'] = 'Search all fields. Uses fulltext search.';
$lang['help_param_search_'] = 'Search a particular field. You can use &#039;title&#039; or the alias of a field definition, e.g. search_title. Will be ignored when parameter &#039;search&#039; is set, but multiple search_* params can be combined.';
$lang['help_param_filter'] = 'Required for action <em>filter</em>. Specify the fields whose values should be offered as filter options by listing the field&#039;s aliases comma separated.';
$lang['help_param_returnpage'] = 'Used for filter or search mode only. Page to display search results respectivly filtered items in. Must be a page alias. Used to allow summary to be displayed in a different page than filter / search mask.';
$lang['qca'] = 'P0-1458450664-1284573084918';
$lang['utmz'] = '156861353.1343464690.1.1.utmccn=(direct)|utmcsr=(direct)|utmcmd=(none)';
$lang['utma'] = '156861353.683421596.1343464690.1343464690.1343466878.2';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353';
?>