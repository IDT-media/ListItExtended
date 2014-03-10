<?php
$lang['invalid_characters'] = 'Characters, such: %s not allowed with field: %s';
$lang['item'] = 'Element';
$lang['items'] = 'Elementer';
$lang['fielddef'] = 'Feltdefinisjon';
$lang['fielddefs'] = 'Feltdefinisjoner';
$lang['template'] = 'Mal';
$lang['templates'] = 'Maler';
$lang['category'] = 'Kategori';
$lang['categories'] = 'Kategorier';
$lang['option'] = 'Valg';
$lang['options'] = 'Valg';
$lang['maintenance'] = 'Vedlikehold';
$lang['back'] = 'Go one page back';
$lang['prompt_fix_fielddefs'] = 'Attempt to repair field definition database tables';
$lang['message_fielddefs_fixed'] = 'Field Definitions on all instances repaired.';
$lang['item_title'] = 'Title';
$lang['prompt_item_title'] = 'Item title';
$lang['active'] = 'Active';
$lang['create_time'] = 'Date created';
$lang['time_control'] = 'Use time control';
$lang['start_time'] = 'Start time';
$lang['end_time'] = 'End time';
$lang['item_title_empty'] = 'Item title is empty';
$lang['required_field_empty'] = 'Required field is empty';
$lang['too_long'] = 'Field value exceeds max length';
$lang['approve'] = 'Set Status to &#039;Active&#039;';
$lang['revert'] = 'Set Status to &#039;Inactive&#039;';
$lang['submit_order'] = 'Lagre rekkef&oslash;lge';
$lang['delete_selected'] = 'Delete Selected %s';
$lang['areyousure_deletemultiple'] = 'Are you sure you want to delete all of these %s?';
$lang['select_all'] = 'Select all';
$lang['error_startgreaterend'] = 'Start date is greater than end date.';
$lang['item_alias_exists'] = 'Item alias already exists. Alias must be unique.';
$lang['return_url'] = 'Return';
$lang['pathcontainsvars'] = 'This field can be edited after first saving this %s';
$lang['item_var_help_item_id'] = 'If item_id is given, items are expected to be existing ones in database. If you&#039;re importing new items, ignore this field.';
$lang['item_var_help_category_id'] = 'If category_id is given, the item will be set into this category. If category_id is given but dosen&#039; exist, it is ignored and the default category is used instead.';
$lang['item_var_help_title'] = 'Item title that is shown in URL and describes item.';
$lang['item_var_help_alias'] = 'Item alias determines friendly computer acceptable name of item. Alias is unique for each item.';
$lang['item_var_help_position'] = 'You can set the position of items which determines their order of display.';
$lang['item_var_help_active'] = 'This option will set the item as either active or inactive.';
$lang['item_var_help_start_time'] = 'Set the time when you want to show this item';
$lang['item_var_help_end_time'] = 'Set the time when you want to hide this item';
$lang['editfielddef'] = 'Edit Field Definition';
$lang['fielddef_name'] = 'Name';
$lang['fielddef_help'] = 'Helpful tip';
$lang['fielddef_type'] = 'Type';
$lang['fielddef_deps'] = 'Module Dependencies';
$lang['fielddef_deps_missing'] = 'One or more module dependencies are missing. Please install all required modules to start using this field.';
$lang['fielddef_scan'] = 'Scan Field Definitions';
$lang['fielddef_scanned'] = 'Field Definitions scanned';
$lang['fielddef_type_notset'] = 'Field Definitions type is not set';
$lang['fielddef_friendlytype'] = 'Friendly Type';
$lang['fielddef_originator'] = 'Originator';
$lang['fielddef_max_length'] = 'Maximum length';
$lang['fielddef_required'] = 'Required';
$lang['registered_fielddefs'] = 'Registered Field Definitions';
$lang['fielddef_name_empty'] = 'Field definition name is empty';
$lang['fielddef_name_exists'] = 'Field definition name already exists';
$lang['fielddef_alias_exists'] = 'Field definition alias already exists. Alias must be unique.';
$lang['fielddef_is_unique'] = 'Field definition is unique, you can&#039;t have more than one of these.';
$lang['fielddef_image'] = 'Expected to be image';
$lang['invalid'] = 'Field value is invalid';
$lang['status_required'] = 'Set status to &#039;required&#039;';
$lang['status_optional'] = 'Set status to &#039;optional&#039;';
$lang['is_default'] = 'Is set to &#039;Default&#039;';
$lang['status_default'] = 'Set to &#039;Default&#039;';
$lang['helptext_title'] = 'Possible Field Definition instructions for Extra field:';
$lang['fielddef_TextInput'] = 'Text Input';
$lang['fielddef_Checkbox'] = 'Checkbox';
$lang['fielddef_TextArea'] = 'Text Area';
$lang['fielddef_SelectDate'] = 'Select Date';
$lang['fielddef_SelectDateTime'] = 'Select DateTime';
$lang['fielddef_Dropdown'] = 'Dropdown';
$lang['fielddef_ContentPages'] = 'Content Pages';
$lang['fielddef_SelectFile'] = 'Select File';
$lang['fielddef_RadioGroup'] = 'Radio Group';
$lang['enable_jqui'] = 'Use jQueryUI Buttons';
$lang['fielddef_Slider'] = 'Slider';
$lang['fielddef_MultiSelect'] = 'Multi Select';
$lang['fielddef_CheckboxGroup'] = 'Checkbox Group';
$lang['fielddef_FileUpload'] = 'File Upload';
$lang['fielddef_allow_help'] = 'Specify a comma seprated list of file extensions that are allowed. For example: pdf,gif,jpeg,jpg (keep lowercase)';
$lang['fielddef_dir_help'] = 'Directory path that will be appended to $config[&#039;uploads_url&#039;] . No slash at the end. {$item_id} and {$field_id} will be replaced.';
$lang['fielddef_exclude_prefix_help'] = 'Specify a comma separated list of prefixes to exclude files that start with those prefixes. For example: thumb_, foo_';
$lang['fielddef_multioptions_help'] = 'Options separated by line breaks. Values can be separated from text with a = character. For example: Banana=banana';
$lang['fielddef_separator_help'] = 'Can be empty, single character or HTML entity.';
$lang['fielddef_size_help'] = 'Specify size of input field. For example: 20';
$lang['fielddef_max_lenght_help'] = 'Specify maximum length of the field. For example: 255';
$lang['fielddef_date_format_help'] = 'Specify date format used by jQuery Datepicker. Try googling &#039;jquery formatDate&#039;. For example: dd-mm-yy';
$lang['fielddef_format_type_help'] = 'Specify output format for this field.';
$lang['fielddef_show_seconds_help'] = 'Specify whether the seconds scroller should be shown. NOTICE, second scroller has no effect if time format is wrong. Try HH:mm:ss';
$lang['fielddef_time_format_help'] = 'Specify date format used by jQuery timepicker. Try googling &#039;jquery formatTime&#039;. For example: HH:mm';
$lang['fielddef_wysiwyg_help'] = 'If checked, a WYSIWYG Editor will be enabled for this field.';
$lang['fielddef_min_value_help'] = 'Specify minimum value for this field.';
$lang['fielddef_max_value_help'] = 'Specify maximum value for this field.';
$lang['fielddef_increment_by_help'] = 'Increment slider values , commonly a dividend of the slider&#039;s maximum value. The default increment is 1.';
$lang['fielddef_width_help'] = 'Specify width of element. Can be a percentage or pixel value. This is used as the CSS value.';
$lang['fielddef_subtype_help'] = 'Select Sub Type for this field to determine its behavior.';
$lang['fielddef_showall_help'] = 'Show all, regardless of system permissions.';
$lang['fielddef_columns_help'] = 'Number of columns. Divide this field into multiple columns for a better user experience.';
$lang['fielddef_media_type_help'] = 'Allows you to specify images as media type to be displayed. By default all files will be shown.';
$lang['fielddef_enable_jqui_help'] = 'Enhances standard form elements to themeable buttons with appropriate hover and active styles.';
$lang['reorder_categories'] = 'Omsorter kategorier';
$lang['edit_category'] = 'Rediger kategori';
$lang['category_name'] = 'Kategori navn';
$lang['category_description'] = 'Kategori beskrivelse';
$lang['category_name_empty'] = 'Category name is empty';
$lang['category_alias_exists'] = 'Category alias already exists. Alias must be unique.';
$lang['categorytemplate'] = 'Category Template';
$lang['categorytemplates'] = 'Category Templates';
$lang['summarytemplate'] = 'Summary Template';
$lang['summarytemplates'] = 'Summary Templates';
$lang['detailtemplate'] = 'Detail Template';
$lang['detailtemplates'] = 'Detail Templates';
$lang['searchtemplate'] = 'Search Template';
$lang['searchtemplates'] = 'Search Templates';
$lang['filtertemplate'] = 'Filter Template';
$lang['filtertemplates'] = 'Filter Templates';
$lang['edittemplate'] = 'Edit Template';
$lang['template_name'] = 'Template name';
$lang['template_name_empty'] = 'Template name is empty';
$lang['template_content_empty'] = 'Template content is empty';
$lang['default_templates'] = 'Default templates';
$lang['module_options'] = 'Module Options';
$lang['url_options'] = 'URL Options';
$lang['default_options'] = 'Module defaults';
$lang['xmodule_options'] = 'Cross Module Options';
$lang['prompt_friendlyname'] = 'Module friendly name';
$lang['prompt_moddescription'] = 'Module Admin description';
$lang['prompt_adminsection'] = 'Module Admin Section';
$lang['items_options'] = 'Items Options';
$lang['prompt_item_singular'] = 'Item singular';
$lang['prompt_item_plural'] = 'Item plural';
$lang['prompt_url_prefix'] = 'URL Prefix';
$lang['prompt_display_inline'] = 'Display details inline';
$lang['prompt_subcategory'] = 'Enable subcategory option, will show inherited items in category and its children';
$lang['prompt_item_cols'] = 'Show this fields in item overview';
$lang['prompt_items_per_page'] = 'Display items per page';
$lang['prompt_create_date'] = 'Display item created date in Item edit mode?';
$lang['prompt_detailpage'] = 'Detail page';
$lang['prompt_summarypage'] = 'Summary page';
$lang['prompt_reindex_search'] = 'Items searchable by Search module';
$lang['text_sortorder'] = 'Default Items sortorder';
$lang['options_notice'] = 'After changing module friendly name or Admin section, you may need to clear the cache for your changes to take effect.';
$lang['prompt_allow_autoscan'] = 'Allow system to scan field definitions automatically';
$lang['notice_allow_autoscan'] = 'Allowing automatic scan on install, upgrade and uninstall events, might have some strange behavior with some core versions.';
$lang['prompt_allow_autoinstall'] = 'Allow system to install instances automatically';
$lang['notice'] = 'Notice';
$lang['instances'] = 'Instances';
$lang['installed_instances_warning'] = 'Below is a list of duplicated module instances.<br />Make sure to backup your site (Database and Files) before &quot;update&quot; action';
$lang['installed_instances'] = 'Installed instances';
$lang['instance_name'] = 'Instance name';
$lang['instance_friendlyname'] = 'Vennlig navn';
$lang['instance_smarty'] = 'Smarty tag';
$lang['instance_version'] = 'Versjon';
$lang['instance_upgrade'] = 'Oppgrader';
$lang['instance_uptodate'] = 'Oppdatert';
$lang['instance_moduleupgraded'] = 'Module upgraded';
$lang['copy_title'] = 'Duplicate module';
$lang['submit'] = 'Send';
$lang['default'] = 'Standard';
$lang['cancel'] = 'Avbryt';
$lang['update'] = 'Oppdater';
$lang['repair'] = 'Reparer';
$lang['save_create'] = 'Save &amp; Create';
$lang['reset'] = 'Reset Default';
$lang['duplicate'] = 'Create instance';
$lang['changessaved'] = 'Your changes have been successfully saved.';
$lang['changessaved_create'] = 'Your previous item has been successfully saved. Create new item?';
$lang['templaterestored'] = 'Default Template has been restored.';
$lang['areyousure'] = 'Er du sikker p&aring; at du &oslash;nsker &aring; slette?';
$lang['up'] = 'Opp';
$lang['down'] = 'Ned';
$lang['edit'] = 'Rediger';
$lang['copy'] = 'Kopier';
$lang['delete'] = 'Slett';
$lang['nosuchid'] = 'No such ID';
$lang['deleted'] = 'The item(s) have been successfully deleted.';
$lang['add'] = 'Legg til %s';
$lang['import'] = 'Importer %s';
$lang['export'] = 'Eksporter %s';
$lang['alias'] = 'Alias';
$lang['alias_invalid'] = 'Alias is invalid. It must be a valid PHP variable name';
$lang['search'] = 'S&oslash;k';
$lang['searchfor'] = 'S&oslash;k etter';
$lang['searchresultsfor'] = 'S&oslash;keresultater for';
$lang['firstpage'] = '<<';
$lang['prevpage'] = '<';
$lang['nextpage'] = '>';
$lang['lastpage'] = '>>';
$lang['module_name'] = 'Module name';
$lang['module_name_empty'] = 'Module name is empty';
$lang['module_name_invalid'] = 'Module name contains invalid characters';
$lang['modulecopied'] = 'Module copied succesfully';
$lang['select_one'] = 'Velg en';
$lang['size'] = 'St&oslash;rrelse';
$lang['max_lenght'] = 'Maks lengde';
$lang['wysiwyg'] = 'WYSIWYG';
$lang['date_format'] = 'Date Format';
$lang['time_format'] = 'Time Format';
$lang['format_type'] = 'Format Type';
$lang['dir'] = 'Katalog';
$lang['allowed'] = 'Allowed';
$lang['exclude_prefix'] = 'Exclude prefix';
$lang['image'] = 'Bilde';
$lang['file'] = 'Fil';
$lang['required'] = 'P&aring;krevd';
$lang['ascending'] = 'Ascending';
$lang['descending'] = 'Descending';
$lang['extra'] = 'Extra';
$lang['combined'] = 'Combined';
$lang['show_seconds'] = 'Show Seconds';
$lang['value'] = 'Value';
$lang['width'] = 'Width';
$lang['min_value'] = 'Minimum Value';
$lang['max_value'] = 'Maximum Value';
$lang['increment_by'] = 'Increment by';
$lang['subtype'] = 'Sub Type';
$lang['showall'] = 'Show All';
$lang['columns'] = 'Columns';
$lang['owner'] = 'Owner';
$lang['filename'] = 'File name';
$lang['enclouser'] = 'Enclosure';
$lang['separator'] = 'Separator';
$lang['values'] = 'Values';
$lang['import_alias'] = 'Item/Fielddef alias';
$lang['file_alias'] = 'File header/alias';
$lang['error_optionrequired'] = 'Option %s is required';
$lang['error_bad_extension'] = 'File you trying to upload has bad extension';
$lang['error_file_permissions'] = 'There was problem with file permissions';
$lang['error_file_empty'] = 'No file given';
$lang['error_file_nocsv'] = 'File is not CSV file';
$lang['filter'] = 'Filter';
$lang['filterprompt'] = 'Filter %s';
$lang['param_filter_missing'] = 'Parameter <em>filter</em> is required in filter mode.';
$lang['all'] = 'All';
$lang['eventdesc_PreItemSave'] = 'Sent before item save process begins. Possible to manipulate item object data.';
$lang['eventdesc_PostItemSave'] = 'Sent after item save process has completed. Possible to manipulate item object data.';
$lang['eventdesc_PreItemDelete'] = 'Sent before item delete process begins. Possible to manipulate item object data.';
$lang['eventdesc_PostItemDelete'] = 'Sent after item delete process has completed. Possible to manipulate item object data.';
$lang['eventdesc_PreItemLoad'] = 'Sent before item load process begins. Possible to manipulate item object data.';
$lang['eventdesc_PostItemLoad'] = 'Sent after item load process has completed. Possible to manipulate item object data.';
$lang['eventdesc_PreRenderAction'] = 'Sent on action execute. Possible to manipulate item query data.';
$lang['eventhelp_PreItemSave'] = '<p>Sent before item save process begins. Possible to manipulate item object data.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;item_object&#039; - Reference to affected item object.</li>
</ul>';
$lang['eventhelp_PostItemSave'] = '<p>Sent after item save process has completed. Possible to manipulate item object data.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;item_object&#039; - Reference to affected item object.</li>
</ul>';
$lang['eventhelp_PreItemDelete'] = '<p>Sent before item delete process begins. Possible to manipulate item object data.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;item_object&#039; - Reference to affected item object.</li>
</ul>';
$lang['eventhelp_PostItemDelete'] = '<p>Sent after item delete process has completed. Possible to manipulate item object data.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;item_object&#039; - Reference to affected item object.</li>
</ul>';
$lang['eventhelp_PreItemLoad'] = '<p>Sent before item load process begins. Possible to manipulate item object data.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;item_object&#039; - Reference to affected item object.</li>
</ul>';
$lang['eventhelp_PostItemLoad'] = '<p>Sent after item load process has completed. Possible to manipulate item object data.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;item_object&#039; - Reference to affected item object.</li>
</ul>';
$lang['eventhelp_PreRenderAction'] = '<p>Sent on action execute. Possible to manipulate item query data.</p>
<h4>Parameters</h4>
<ul>
<li>&#039;action_name&#039; - Name of executed action.</li>
<li>&#039;query_object&#039; - Reference to affected query object.</li>
</ul>';
$lang['moddescription'] = 'ListIt allows you to create lists that you can display throughout your website.';
$lang['postinstall'] = ' has successfully been installed';
$lang['postuninstall'] = ' has successfully been uninstalled';
$lang['general'] = 'General';
$lang['usage'] = 'Usage';
$lang['permissions'] = 'Permissions';
$lang['duplicating'] = 'Creating Instances';
$lang['upgrading'] = 'Upgrading';
$lang['smarty_plugins'] = 'Smarty plugins';
$lang['about'] = 'About';
$lang['upgrade_from'] = 'Upgrading from';
$lang['team'] = 'Team';
$lang['contributors'] = 'Contributors';
$lang['help_general'] = '<h3>General Info</h3>      
    <p>Simply put, ListItExtended allows you to create lists that you can display throughout your website. You could make a simple FAQ or Testimonials feature with this module. The web developer defines fields to constrain what data the client can enter. A number of field types can be specified - text input, checkbox, text area, select date, upload file, select file, dropdown - and additional instructions can be set for each type, for example, input field size, max length, WYSIWYG editor, possible drop down values, possible file extensions, directory paths for file selections, date formats, etc..</p>
    <p>An important note of warning - This is not a content construction kit, such as in Drupal. It is meant for small listings, not to store thousands of records. This is because of the database model used (EAV). Also, each bit of data you enter is stored as TEXT data type, regardless of whether it is varchar, boolean, timestamp, etc.</p>';
$lang['help_usage'] = '<h3>Usage</h3>    
       
    <p>You can configure {$module_name} here: Content &raquo; {$module_name}</p>
    <p>Place this tag in your page: {{$module_name}}</p><br />';
$lang['help_usage_options'] = 'After installing the module the next thing to do is set the options.                 
    <ol>                    
        <li>To change the name of the module in the menu change the &quot;Module Friendly Name&quot;.</li>
        <li>To change the name of the item tab change the &quot;Item Plural&quot;.</li>
    </ol>';
$lang['help_usage_fielddefs'] = 'Next - set the Field Definitions. 
    <ol>
        <li>Choose from &quot;Text Input&quot;, &quot;Checkbox&quot;, &quot;Text Area&quot;, &quot;Select Date&quot;, &quot;Select File&quot;, &quot;Content Pages&quot;  &amp; &quot;Dropdown&quot;.</li>
        <li>For each field definition, you can specify or choose additional settings<br /> from available options which depend on field definition type.</li>
        <li>Each item in each list has three default fields. <br />All Field Definitions set here are additional to them.</li>
    </ol>';
$lang['help_usage_categories'] = 'Since Version 1.4, Categories were moved to Field definitions. To be able to use Categories with your ListIt2 instance you will have to create a
	 Field definition with type of &quot;Category&quot;.<br /> Once a Field definition was create new Tab with name &quot;Categories&quot; will become available in your ListIt2 module instance.<br />
	 Now you can start adding categories.';
$lang['help_usage_items'] = 'Now we move on to the item list itself. In this example it says &quot;Add Box&quot;, this was renamed in the &quot;Options&quot; tab. 
    <ol>
        <li>The first field is the default &quot;Title&quot; field.</li>
        <li>The &quot;Category&quot; dropdown is also a default field, and if unchanged, will be set to &quot;General&quot;.</li>
        <li>The third default field is the checkbox called &quot;Active&quot;. This allows you to toggle a list entry without deleting it.</li>
    </ol>';
$lang['help_permissions'] = '<h3>Permissions</h3>
    <p>You can specify the following permissions under Users &amp; Groups &rarr; Group Permissions</p>
    <ul>
        <li>{$module_name}: Modify Items</li>
        <li>{$module_name}: Modify all items</li>
        <li>{$module_name}: Remove items</li>
        <li>{$module_name}: Approve items</li>
        <li>{$module_name}: Modify Categories</li>
        <li>{$module_name}: Modify Options</li>
    </ul>
    <p>To allow non-admin users to upload files, please go to Extensions > GBFilePicker and tick that first checkbox &quot;Show filemanagement options&quot;.</p>';
$lang['help_fielddefs'] = '<h3>Field Definitions</h3>
    <p>The first thing you should configure are your field definitions.</p>
    <p>For each field definition, you can specify additional settings by choosing from available options.</p>
    
    <h3>Default Field Definitions by type</h3>
    <ul>
        <li>Text Input</li>
        <li>Checkbox</li>
        <li>Checkbox Group</li>
        <li>Radio Group</li>
        <li>Text Area</li>
        <li>Select File</li>
        <li>File Upload</li>
        <li>Dropdown</li>
        <li>Content Pages</li>
        <li>Select DateTime</li>
        <li>Multi Select</li>
        <li>Checkbox Group</li>
        <li>Slider</li>
        <li>Categories</li>
    </ul>
    
    <h3>Custom Field Definitions</h3>
    <p>Since Version 1.3 field definitions have been completely rewritten.<br />
    As a result you can now create your custom field definitions by following naming convention in ListItExtended module.</p>
    <p>Following these changes, ListItExtended Team has also released a module named <a href="http://dev.cmsmadesimple.org/projects/listit2xdefs" target="_blank">ListIt2XDefs</a> that is simply a wrapper module for Custom Field definitions.<br />
    When creating your custom filed for example &quot;MyField&quot; (where MyField would be name of your custom field) you would create &quot;MyField&quot; folder inside &quot;ListIt2XDefs/fielddefs&quot; folder and add needed files in this particular folder.<br />
    Fielddef file has to be prefixed with &quot;listit2fd&quot; for example &quot;listit2fd.MyField.php&quot;, for input field template which is used when managing Item you would need &quot;input.MyField.tpl&quot; and as field definition settings template you would need admin.MyField.tpl (only needed if additional settings are possible for this field).</p>
    <p>After you are done writing your own custom field definition, you will have to go to &quot;Modules &raquo; ListIt2&quot; click on &quot;Field Definitions&quot; tab and scan for new field definitions by clicking on &quot;Scan Field Definitions&quot; button.<br />
    <strong>If you are looking for Field Definitions like GBFilePicker Upload, Gallery Options, FEU Dropdown, Color Picker install <a href="http://dev.cmsmadesimple.org/projects/listit2xdefs" target="_blank">ListIt2XDefs</a> module first.</strong></p><br />
    
    <h4><strong>Watch this video for detailed instructions</strong></h4>';
$lang['help_upgrading_12xto13'] = '    <h4>Step one</h4>
    <p class=&quot;red&quot;><strong>Please read upgrade Information above!<br />
    Make sure you create Backup or your Website and Database before any further actions</strong></p>
    <p>As mentioned after upgrade from 1.2.x to 1.3 the first step you will have to make is installing newly created <strong>{ListIt2Original}</strong> Instance.<br />
    Once this Instance is installed your old Original ListIt2 Items will be available in ListIt2Original Instance which you will find in &quot;Content&quot; backend section.</p>
    <p>At this moment your Frontend will most possibly be broken, displaying a Error about not recognized Smarty Tag for example &quot;unknown tag ListIt2&quot;, you should replace any of {ListIt2} tags you are using in your Pages or Templates to {ListIt2Original}.</p>
    <h4>Step two</h4>
    <p>Due to limitation in module upgrade process, it is not possible to detect any of your previous ListIt2 Module settings, which means that you should make sure to change these settings in &quot;Content &raquo; ListIt2Original&quot; again to your preference.<br />
    Also you will have to set any Template in &quot;Templates&quot; tab that you have been using before as Defaul template back to &quot;default&quot; if you are not using &quot;sumarytemplate&quot; or &quot;detailtemplate&quot; or any Template related parameters.</p>
    <h4>Step three</h4>
    <p>In case you have been using Field definitions like GBFilePicker Upload File or Gallery selection, please note that these are no longer part of ListItExtended Module.<br />
    Reason for this is simply that Field definitions have been completely rewriten making it possible for you to create your own custom Field definitions and simply ListItExtended DEV Team can not support any third party Modules as part of ListItExtended Module and therefor possibly delaying releases in future due to Module incompatibility or anything else.</p>
    <p>To make your old Upload File or Gallery Fields working again you will have to install <a href="http://dev.cmsmadesimple.org/projects/listit2xdefs" target="_blank">ListItExtended XDefs</a> Module which is a Gateway module to ListItExtended custom Field definitions.<br />
    After ListItExtended XDefs is installed you will find a list of available Field Definitions in &quot;Extensions &raquo; ListIt2&quot; by clicking on &quot;Field Definitions&quot; tab.<br />
    Ideally your Field definitions should work again, if that is not the case you should try to repair Field definitions database table by clicking on &quot;Repair&quot; button under &quot;Maintenance&quot; tab.</p><br />
    <p><strong>If you have followed above steps, you should now have a fully functional and upgraded ListItExtended Module and all created Instances.</strong></p>';
$lang['help_upgrading_13xto14'] = '	<h4>Categories changes</h4>
	<p>In version 1.4 behavior of Categories was changed and moved to Field definitions. Reason for this is, that not every ListIt2 Module instance actually requires Categories,
	therefore when you see your Categories missing you will have to create new Field definition of type &quot;Category&quot;, if you do not see this Field definition, try scaning for new Field
	definition in ListIt2 Module interface, located in &quot;Field Definitions&quot; tab.</p>
	<p>Once your Category Filed definition was created, you should see &quot;Categories&quot; tab in your ListIt2 Module instance again, as well as have the ability of choosing a Category for a Item.</p>';
$lang['help_categories'] = '	<h3>Categories</h3>
    <p>Categories are part of Field definitions and disabled by default.<br />
    If you need Categories with this instance you will have to create a new Field definition of type &quot;Category&quot;.<br />
    Once a Field definition was created, a news tab named &quot;Categories&quot; will become available in module Instance.</p>
    <p>Categories support multiple levels and created Items may belong to multiple categories, depending on your selected options while creating Category Field defintion.</p><br />
    <p>There are two sample templates included to demonstarte how categories within ListIt2 Module instance work, this should give you a starting idea on how to create your personalizied and custom<br />
    Templates for your next project.</p>
    <h4>Using Categories</h4>
    <p>For detailed usage and available parameters, have a look below at &quot;Parameters&quot; Help section</p>
    <pre><code>{ action=&#039;category&#039;}</code></pre>';
$lang['help_templates'] = '<h3>Templates</h3>
    <p>If you are not sure what variables are available to use in your templates, try debugging:</p>
    <p>{{$module_name} debug=1}</p>
    <p>You can access any field directly when looping through items using its alias, for example, to if you created a field definition with an alias &quot;position&quot;, you can do one of the following:</p>';
$lang['help_duplicating'] = '<h3>Creating Module Instances</h3>
    <p>This module is a Control Panel for creating ListItExtended Module Instances. To create ListItExtended module Instance, simply go to &quot;Instances&quot; tab and click on &quot;Create Instance&quot; button.<br />
    Make sure you follow the CMSMS module naming conventions, a-z with no punctuation characters or spaces to be safe :)<br />
    After the module has been created a new instance will be installed and listed in original ListItExtended module under &quot;Instances&quot; tab.</p><br />
    <p>You can always change the module friendly name once installed under &quot;Options&quot; (Content &raquo; ListIt2NameOfDuplicate).<br />
    To change the icon, replace /modules/ListIt2NameOfDuplicate/images/icon.gif.<br />
    To change Admin section of the module, simply select appropriate section from Dropdown. Make sure you clear the cache after these changes.</p>';
$lang['help_about'] = '	<h3>About</h3>
    <p>Origin of this module comes from <a href="http://dev.cmsmadesimple.org/projects/listit" target="_blank">ListIt Module</a> developed by Ben Malen.<br />As there were no plans on further development of the module some people decided to fork the module and continue with development.<br />
    If you find any bugs please feel free to submit a bug report <a href="http://dev.cmsmadesimple.org/bug/list/1015" target="_blank">here</a> or for any good ideas consider submiting a feature request <a href="http://dev.cmsmadesimple.org/feature_request/list/1015" target="_blank">here</a>. </p>
    <p>Please keep in mind that developers do have their daily jobs which means that feature requests are considered and done as time allows. If you need a feature really badly consider contacting one of the developers for a sponsored development.
    </p>';
$lang['help_smarty_plugins'] = '	<h4>What does this do?</h4>
	 <p>This plugin allows you to load ListItExtended item and category object by certain criteria, anywhere in the system.</p>
	 
	<h4>How do I use it?</h4>
	<p>Simply insert this tag into your page or template:</p>
	<pre><code>{ListIt2Loader item=&#039;item&#039; identifier=&#039;alias&#039; instance=&#039;ListIt2Instance&#039; value=&#039;myalias&#039; assign=&#039;tmp&#039;}</code></pre>
	
	<p>&nbsp;</p>
	
	<p>Following line will load item object from instance &#039;ListIt2Instance&#039; by alias &#039;myalias&#039; and assign it to variable $tmp. <br /> 
	After this you can use it in similar way, just like in regular ListItExtended templates:</p>
	<pre><code>{$tmp->title}</code></pre>
	
	<p>&nbsp;</p>
	
	<p>If multiple items are being loaded, this function returns array of objects, else it returns single item/category object</p>

	<h4>What parameters does it take?</h4>
	<ul>
		<li><em>(required) </em><tt>instance</tt> - Name of instance that holds items. <i>(If used inside ListItExtended templates, this parameter is optional)</i></li>
		<li><em>(required) </em><tt>value</tt> - Comma separated list of identifier values: &#039;alias1,alias2,alias3&#039; or &#039;1,2,3&#039;</li>
		<li><em>(optional) </em><tt>item=&quot;item&quot;</tt> - Wanted item type, either: item/category</li>
		<li><em>(optional) </em><tt>identifier=&quot;item_id/category_id&quot;</tt> - Wanted identifier, one of following: item_id, category_id, alias</li>
		<li><em>(optional) </em><tt>force_array=&quot;false&quot;</tt> - Force output value as array</li>
	</ul>';
$lang['help_param_action'] = 'Override the default action. Possible values are:
<ul>
<li>&quot;default&quot; - to display the summary view.</li>
<li>&quot;detail&quot; - to display a specified entry in detail mode.</li>
</ul>';
$lang['help_param_showall'] = 'Show all items, irrespective of end date.';
$lang['help_param_category'] = 'Specify the category alias to display items only from this category.';
$lang['help_param_exclude_category'] = 'Specify an alias or comma separated aliases of the category/categories displayed items musn&#039;t be a member of.';
$lang['help_param_subcategory'] = 'If parameter &#039;category&#039; is specified, this parameter set to <em>true</em> will make allowance for subcategories&#039; items. It is set to false by default.';
$lang['help_param_detailtemplate'] = 'The detail template you wish to use.';
$lang['help_param_summarytemplate'] = 'The summary template you wish to use';
$lang['help_param_searchtemplate'] = 'The search template you wish to use.';
$lang['help_param_categorytemplate'] = 'The category template you wish to use.';
$lang['help_param_orderby'] = 'You can order by any of the following columns: item_id, item_title, item_position, category_id, category_name, category_position.<br />
<ul>
<li>For example:<br />
orderby=&#039;category_name, item_title&#039;</li>
<li>You can also specify ascending or descending for any column, for example:<br />
orderby=&#039;category_name|asc, item_title|desc&#039;</li>
</ul>
';
$lang['help_param_pagelimit'] = 'Maximum number of items to display (per page).  If this parameter is not supplied all matching items will be displayed.  If it is, and there are more items available than specified in the parameter, text and links will be supplied to allow scrolling through the results';
$lang['help_param_start'] = 'Start at the nth item -- leaving empty will start at the first item.';
$lang['help_param_number'] = 'Maximum number of items to display (per page) -- leaving empty will show all items. This is a synonym for the pagelimit parameter.';
$lang['help_param_detailpage'] = 'Page to display item details in. Must be a page alias. Used to allow details to be displayed in a different page than summary.';
$lang['help_param_summarypage'] = 'Page to display item summary in. Must be a page alias/id. Used to allow summaries to be displayed in a different page than initiator.';
$lang['help_param_item'] = 'This parameter is only applicable to the detail view. It allows specifying which item to display in detail mode. Must be an item alias.';
$lang['help_param_search'] = 'Search all fields. Uses fulltext search. Can be combined with filter search.';
$lang['help_param_search_'] = 'Search a particular field. You can use &#039;title&#039; or the alias of a field definition, e.g. search_title. Can be combined with fulltext search. Multiple search_* params can be combined.';
$lang['help_param_filter'] = 'Applies only to action: <em>search</em>. Specify the fields whose values should be offered as filter options by listing the field&#039;s aliases comma separated.';
$lang['help_param_debug'] = 'Enables debug mode, printing out all the objects, arrays, variables available for current action.';
$lang['help_param_collapse'] = 'Applies only to action: <em>category</em>. Toggle collapse categories.';
$lang['help_param_show_items'] = 'Applies only to action: <em>category</em>. Append items to category tree.';
$lang['help_param_number_of_levels'] = 'Applies only to action: <em>category</em>. Number of of category levels to show.';
$lang['help_param_include_items'] = 'Specify an id/alias or comma separated ids/aliases of the items you want to display.';
$lang['help_param_exclude_items'] = 'Specify an id/alias or comma separated ids/aliases of the items you want to exclude from list.';
$lang['upgrade_warning'] = '<h3>Important upgrade Information</h3>
    <p><strong>If you have upgraded to 1.3 from ListItExtended 1.2.2 or earlier, read this carefully!</strong></p>
    <p>After completing the upgrade proceedure of ListItExtended 1.3, your previous &quot;ListIt2&quot; module will be converted to a new module instance called ListIt2Original.<br />
    Please go to &quot;Extensions &raquo; Modules&quot; and install this newly created instance. Once installed, items from your original ListIt2 module will be available again.<br />
    Unfortunately you will have to change all {ListIt2} tags in your website to {ListIt2Original}. Sorry about that.</p>';
$lang['utma'] = '156861353.1779385890.1374233219.1374233219.1374233219.1';
$lang['utmz'] = '156861353.1374233219.1.1.utmcsr=google|utmccn=(organic)|utmcmd=organic|utmctr=(not provided)';
$lang['utmc'] = '156861353';
$lang['utmb'] = '156861353.1.10.1374233219';
?>