<?php
/* --- do not edit ------------------------------------------------------ */
/* Only necessary in the English lang file, because it's always loaded first, even English is not the user's language.
*/

// Here only for fallback
$module_name = LISTIT2;

/* -- end of do not edit ------------------------------------------------ */

// global
$lang['invalid_characters'] = 'Characters, such: %s not allowed with field: %s';

// tabs
$lang['item'] = 'Item';
$lang['items'] = 'Items';
$lang['fielddef'] = 'Field Definition';
$lang['fielddefs'] = 'Field Definitions';
$lang['template'] = 'Template';
$lang['templates'] = 'Templates';
$lang['category'] = 'Category';
$lang['categories'] = 'Categories';
$lang['option'] = 'Option';
$lang['options'] = 'Options';
$lang['maintenance'] = 'Maintenance';
$lang['back'] = 'Go one page back';

// maintenance
$lang['prompt_fix_fielddefs'] = 'Attempt to repair field definition database tables';
$lang['message_fielddefs_fixed'] = 'Field Definitions on all instances repaired.';

// items
$lang['item_title'] = 'Title';
$lang['prompt_item_title'] = 'Item title';
$lang['active'] = 'Active';
$lang['create_time'] = 'Date created';
$lang['modified_time'] = 'Date modified';
$lang['time_control'] = 'Use time control';
$lang['start_time'] = 'Start time';
$lang['end_time'] = 'End time';
$lang['item_title_empty'] = 'Item title is empty';
$lang['required_field_empty'] = 'Required field is empty';
$lang['too_long'] = 'Field value exceeds max length';
$lang['approve'] = 'Set Status to \'Active\'';
$lang['revert'] = 'Set Status to \'Inactive\'';
$lang['toggle_status'] = 'Toggle Status';
$lang['select_item'] = 'Select item';
$lang['submit_order'] = 'Save order';
$lang['delete_selected'] = 'Delete Selected %s';
$lang['areyousure_deletemultiple'] = 'Are you sure you want to delete all of these %s?';
$lang['select_all'] = 'Select all';
$lang['error_startgreaterend'] = 'Start date is greater than end date.';
$lang['item_alias_exists'] = 'Item alias already exists. Alias must be unique.';
$lang['return_url'] = 'Return';
$lang['pathcontainsvars'] = 'This field can be edited after first saving this %s'; // <- unused.

// Item static variable helps
$lang['item_var_help_item_id'] = 'If item_id is given, items are expected to be existing ones in database. If you\'re importing new items, ignore this field.';
$lang['item_var_help_category_id'] = 'If category_id is given, the item will be set into this category. If category_id is given but dosen\' exist, it is ignored and the default category is used instead.';
$lang['item_var_help_title'] = 'Item title that is shown in URL and describes item.';
$lang['item_var_help_alias'] = 'Item alias determines friendly computer acceptable name of item. Alias is unique for each item.';
$lang['item_var_help_position'] = 'You can set the position of items which determines their order of display.';
$lang['item_var_help_active'] = 'This option will set the item as either active or inactive.';
$lang['item_var_help_start_time'] = 'Set the time when you want to show this item.';
$lang['item_var_help_end_time'] = 'Set the time when you want to hide this item.';
$lang['item_var_help_owner'] = 'Set admin user ID for this item, to set owner.';
$lang['item_var_help_key1'] = 'Set additional identifier \'key1\' for this item.';
$lang['item_var_help_key2'] = 'Set additional identifier \'key2\' for this item.';
$lang['item_var_help_key3'] = 'Set additional identifier \'key3\' for this item.';

// field definitions
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
$lang['fielddef_is_unique'] = 'Field definition is unique, you can\'t have more than one of these.';
$lang['fielddef_image'] = 'Expected to be image';
$lang['invalid'] = 'Field value is invalid';
$lang['status_required'] = 'Set status to \'required\'';
$lang['status_optional'] = 'Set status to \'optional\'';
$lang['is_default'] = 'Is set to \'Default\'';
$lang['status_default'] = 'Set to \'Default\'';
$lang['helptext_title'] = 'Possible Field Definition instructions for Extra field:';

// TextInput
$lang['fielddef_TextInput'] = 'Text Input';
// CheckBox
$lang['fielddef_Checkbox'] = 'Checkbox';
// TextArea
$lang['fielddef_TextArea'] = 'Text Area';
// Select Date (deprecated)
$lang['fielddef_SelectDate'] = 'Select Date';
// Select DateTime
$lang['fielddef_SelectDateTime'] = 'Select DateTime';
//Dropdown
$lang['fielddef_Dropdown'] = 'Dropdown';
// Content Pages
$lang['fielddef_ContentPages'] = 'Content Pages';
// Select File
$lang['fielddef_SelectFile'] = 'Select File';
// Radio Group
$lang['fielddef_RadioGroup'] = 'Radio Group';
$lang['enable_jqui'] = 'Use jQueryUI Buttons';
// Slider
$lang['fielddef_Slider'] = 'Slider';
// Multi Select
$lang['fielddef_MultiSelect'] = 'Multi Select';
// Checkbox Group
$lang['fielddef_CheckboxGroup'] = 'Checkbox Group';
// File Upload
$lang['fielddef_FileUpload'] = 'File Upload';

/* Instructions */
$lang['fielddef_allow_help'] = 'Specify a comma seprated list of file extensions that are allowed. For example: pdf,gif,jpeg,jpg (keep lowercase)';
$lang['fielddef_dir_help'] = 'Directory path that will be appended to $config[\'uploads_url\'] . No slash at the end. {$item_id} and {$field_id} will be replaced.';
$lang['fielddef_exclude_prefix_help'] = 'Specify a comma separated list of prefixes to exclude files that start with those prefixes. For example: thumb_, foo_';
$lang['fielddef_multioptions_help'] = 'Options separated by line breaks. Values can be separated from text with a = character. For example: Banana=banana';
$lang['fielddef_separator_help'] = 'Can be empty, single character or HTML entity.';
$lang['fielddef_size_help'] = 'Specify size of input field. For example: 20';
$lang['fielddef_max_length_help'] = 'Specify maximum length of the field. For example: 255';
$lang['fielddef_date_format_help'] = 'Specify date format used by jQuery Datepicker. Try googling \'jquery formatDate\'. For example: dd-mm-yy';
$lang['fielddef_format_type_help'] = 'Specify output format for this field.';
$lang['fielddef_show_seconds_help'] = 'Specify whether the seconds scroller should be shown. NOTICE, second scroller has no effect if time format is wrong. Try HH:mm:ss';
$lang['fielddef_time_format_help'] = 'Specify date format used by jQuery timepicker. Try googling \'jquery formatTime\'. For example: HH:mm';
$lang['fielddef_wysiwyg_help'] = 'If checked, a WYSIWYG Editor will be enabled for this field.';
$lang['fielddef_min_value_help'] = 'Specify minimum value for this field.';
$lang['fielddef_max_value_help'] = 'Specify maximum value for this field.';
$lang['fielddef_increment_by_help'] = 'Increment slider values , commonly a dividend of the slider\'s maximum value. The default increment is 1.';
$lang['fielddef_width_help'] = 'Specify width of element. Can be a percentage or pixel value. This is used as the CSS value.';
$lang['fielddef_subtype_help'] = 'Select Sub Type for this field to determine its behavior.';
$lang['fielddef_showall_help'] = 'Show all, regardless of system permissions.';
$lang['fielddef_columns_help'] = 'Number of columns. Divide this field into multiple columns for a better user experience.';
$lang['fielddef_media_type_help'] = 'Allows you to specify images as media type to be displayed. By default all files will be shown.';
$lang['fielddef_enable_jqui_help'] = 'Enhances standard form elements to themeable buttons with appropriate hover and active styles.';

// category
$lang['reorder_categories'] = 'Reorder Categories';
$lang['edit_category'] = 'Edit Category';
$lang['category_name'] = 'Category name';
$lang['category_description'] = 'Category Description';
$lang['category_name_empty'] = 'Category name is empty';
$lang['category_alias_exists'] = 'Category alias already exists. Alias must be unique.';

// templates
$lang['archivetemplate'] = 'Archive Template';
$lang['archivetemplates'] = 'Archive Templates';
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

// options
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
$lang['prompt_display_inline'] = 'Display details inline (replaces module tag instead of {content})';
$lang['prompt_subcategory'] = 'Enable subcategory option, will show inherited items in category and its children';
$lang['prompt_item_cols'] = 'Display these fields in item overview';
$lang['prompt_items_per_page'] = 'Display items per page';
$lang['prompt_create_date'] = 'Display item created date in Item edit mode?';
$lang['prompt_detailpage'] = 'Detail page';
$lang['prompt_summarypage'] = 'Summary page';
$lang['prompt_reindex_search'] = 'Items searchable by Search module';
$lang['text_sortorder'] = 'Default Items sortorder';
$lang['options_notice'] = 'After changing module friendly name or Admin section, you may need to clear the cache for your changes to take effect.';
$lang['prompt_allow_autoscan'] = 'Allow system to scan field definitions automatically';
$lang['notice_allow_autoscan'] = 'Allowing automatic scan on ModuleInstalled, ModuleUpgraded, ModuleUninstalled and ContentPostCompile events, might have some strange behavior with some core versions.';
$lang['prompt_allow_autoinstall'] = 'Allow system to install instances automatically';

// instances
$lang['notice'] = 'Notice';
$lang['instances'] = 'Instances';
$lang['installed_instances_warning'] = 'Below is a list of duplicated module instances.<br />Make sure to backup your site (Database and Files) before "update" action';
$lang['installed_instances'] = 'Installed instances';
$lang['instance_name'] = 'Instance name';
$lang['instance_friendlyname'] = 'Friendly name';
$lang['instance_smarty'] = 'Smarty tag';
$lang['instance_version'] = 'Version';
$lang['instance_upgrade'] = 'Upgrade';
$lang['instance_uptodate'] = 'Up to date';
$lang['instance_moduleupgraded'] = 'Module upgraded';
//$lang['duplicate_instance'] = 'Duplicate module';
//$lang['duplicate_description'] = $module_name . ' can be easily duplicated to multiple module instances with duplicate button.<br /> Install newly copied module from "Extensions &raquo; Modules".';
$lang['copy_title'] = 'Duplicate module';

// global
$lang['submit'] = 'Submit';
$lang['default'] = 'Default';
$lang['cancel'] = 'Cancel';
$lang['update'] = 'Update';
$lang['repair'] = 'Repair';
$lang['save_create'] = 'Save &amp; Create';
$lang['reset'] = 'Reset Default';
$lang['duplicate'] = 'Create instance';
$lang['changessaved'] = 'Your changes have been successfully saved.';
$lang['changessaved_create'] = 'Your previous item has been successfully saved. Create new item?';
$lang['templaterestored'] = 'Default Template has been restored.';
$lang['areyousure'] = 'Are you sure you want to delete?';
$lang['up'] = 'Up';
$lang['down'] = 'Down';
$lang['edit'] = 'Edit';
$lang['copy'] = 'Copy';
$lang['delete'] = 'Delete';
$lang['nosuchid'] = 'No such ID';
$lang['deleted'] = 'The item(s) have been successfully deleted.';
$lang['add'] = 'Add %s';
$lang['import'] = 'Import %s';
$lang['export'] = 'Export %s';
$lang['alias'] = 'Alias';
$lang['alias_invalid'] = 'Alias is invalid. It must only include letters, numbers and underscores';
$lang['search'] = 'Search';
$lang['searchfor'] = 'Search for';
$lang['searchresultsfor'] = 'Search results for';
$lang['firstpage'] = '&lt;&lt;';
$lang['prevpage'] = '&lt;';
$lang['nextpage'] = '&gt;';
$lang['lastpage'] = '&gt;&gt;';
$lang['module_name'] = 'Module name';
$lang['module_name_empty'] = 'Module name is empty';
$lang['module_name_invalid'] = 'Module name contains invalid characters';
$lang['modulecopied'] = 'Module copied succesfully';
$lang['select_one'] = 'Select One';
$lang['size'] = 'Size';
$lang['max_length'] = 'Max Length';
$lang['wysiwyg'] = 'WYSIWYG';
$lang['date_format'] = 'Date Format';
$lang['time_format'] = 'Time Format';
$lang['format_type'] = 'Format Type';
$lang['dir'] = 'Directory';
$lang['allowed'] = 'Allowed';
$lang['exclude_prefix'] = 'Exclude prefix';
$lang['image'] = 'Image';
$lang['file'] = 'File';
$lang['required'] = 'Required';
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

// csv import/export
$lang['filename'] = 'File name';
$lang['enclouser'] = 'Enclosure';
$lang['separator'] = 'Separator';
$lang['values'] = 'Values';
$lang['import_alias'] = 'Item/Fielddef alias';
$lang['file_alias'] = 'File header/alias';

// errors
$lang['error_optionrequired'] = 'Option %s is required';
$lang['error_bad_extension'] = 'File you trying to upload has bad extension';
$lang['error_file_permissions'] = 'There was problem with file permissions';
$lang['error_file_empty'] = 'No file given';
$lang['error_file_nocsv'] = 'File is not CSV file';

// filter
$lang['filter'] = 'Filter';
$lang['filterprompt'] = 'Filter %s';
$lang['param_filter_missing'] = 'Parameter <em>filter</em> is required in filter mode.';
$lang['all'] = 'All';

// Event descriptions
$lang['eventdesc_PreItemSave'] = 'Sent before item save process begins. Possible to manipulate item object data.';
$lang['eventdesc_PostItemSave'] = 'Sent after item save process has completed. Possible to manipulate item object data.';
$lang['eventdesc_PreItemDelete'] = 'Sent before item delete process begins. Possible to manipulate item object data.';
$lang['eventdesc_PostItemDelete'] = 'Sent after item delete process has completed. Possible to manipulate item object data.';
$lang['eventdesc_PreItemLoad'] = 'Sent before item load process begins. Possible to manipulate item object data.';
$lang['eventdesc_PostItemLoad'] = 'Sent after item load process has completed. Possible to manipulate item object data.';
$lang['eventdesc_PreRenderAction'] = 'Sent on action execute. Possible to manipulate item query data.';

#Event help
$lang['eventhelp_PreItemSave'] = "<p>".$lang['eventdesc_PreItemSave']."</p>
<h4>Parameters</h4>
<ul>
<li>'item_object' - Reference to affected item object.</li>
</ul>";

$lang['eventhelp_PostItemSave'] = "<p>".$lang['eventdesc_PostItemSave']."</p>
<h4>Parameters</h4>
<ul>
<li>'item_object' - Reference to affected item object.</li>
</ul>";

$lang['eventhelp_PreItemDelete'] = "<p>".$lang['eventdesc_PreItemDelete']."</p>
<h4>Parameters</h4>
<ul>
<li>'item_object' - Reference to affected item object.</li>
</ul>";

$lang['eventhelp_PostItemDelete'] = "<p>".$lang['eventdesc_PostItemDelete']."</p>
<h4>Parameters</h4>
<ul>
<li>'item_object' - Reference to affected item object.</li>
</ul>";

$lang['eventhelp_PreItemLoad'] = "<p>".$lang['eventdesc_PreItemLoad']."</p>
<h4>Parameters</h4>
<ul>
<li>'item_object' - Reference to affected item object.</li>
</ul>";

$lang['eventhelp_PostItemLoad'] = "<p>".$lang['eventdesc_PostItemLoad']."</p>
<h4>Parameters</h4>
<ul>
<li>'item_object' - Reference to affected item object.</li>
</ul>";

$lang['eventhelp_PreRenderAction'] = "<p>".$lang['eventdesc_PreRenderAction']."</p>
<h4>Parameters</h4>
<ul>
<li>'action_name' - Name of executed action.</li>
<li>'query_object' - Reference to affected query object.</li>
</ul>";

// module
$lang['moddescription'] = 'ListItExtended allows you to create lists that you can display throughout your website.';
$lang['postinstall'] = '::INSTANCE_NAME:: has successfully been installed';
$lang['postuninstall'] = '::INSTANCE_NAME:: has successfully been uninstalled';

// module help
$lang['general'] = 'General';
$lang['usage'] = 'Usage';
$lang['permissions'] = 'Permissions';
$lang['duplicating'] = 'Creating Instances';
$lang['upgrading'] = 'Upgrading';
$lang['smarty_plugins'] = 'Smarty plugins';
//$lang['about'] = 'About';
$lang['upgrade_from'] = 'Upgrading from';
$lang['team'] = 'Team';
//$lang['contributors'] = 'Contributors';

$lang['help_general'] = '<h3>General Info</h3>      
    <p>Simply put, ListItExtended allows you to create lists that you can display throughout your website. You could make a simple FAQ or Testimonials feature with this module. The web developer defines fields to constrain what data the client can enter. A number of field types can be specified - text input, checkbox, text area, select date, upload file, select file, dropdown - and additional instructions can be set for each type, for example, input field size, max length, WYSIWYG editor, possible drop down values, possible file extensions, directory paths for file selections, date formats, etc..</p>
    <p>An important note of warning - This is not a content construction kit, such as in Drupal. It is meant for small listings, not to store thousands of records. This is because of the database model used (EAV). Also, each bit of data you enter is stored as TEXT data type, regardless of whether it is varchar, boolean, timestamp, etc.</p>';
	
$lang['help_usage'] = '<h3>Usage</h3>    
       
    <p>You can configure ::INSTANCE_NAME:: here: Content &raquo; ::INSTANCE_NAME::</p>
    <p>Place this tag in your page: {::INSTANCE_NAME::}</p><br />';
	
$lang['help_usage_options'] = 'After installing the module the next thing to do is set the options.                 
    <ol>                    
        <li>To change the name of the module in the menu change the "Module Friendly Name".</li>
        <li>To change the name of the item tab change the "Item Plural".</li>
    </ol>';
	
$lang['help_usage_fielddefs'] = 'Next - set the Field Definitions. 
    <ol>
        <li>Choose from "Text Input", "Checkbox", "Text Area", "Select Date", "Select File", "Content Pages"  &amp; "Dropdown".</li>
        <li>For each field definition, you can specify or choose additional settings<br /> from available options which depend on field definition type.</li>
        <li>Each item in each list has three default fields. <br />All Field Definitions set here are additional to them.</li>
    </ol>';
	
$lang['help_usage_categories'] = 'Since Version 1.4, Categories were moved to Field definitions. To be able to use Categories with your ListIt2 instance you will have to create a
	 Field definition with type of "Category".<br /> Once a Field definition was create new Tab with name "Categories" will become available in your ListIt2 module instance.<br />
	 Now you can start adding categories.';

$lang['help_usage_items'] = 'Now we move on to the item list itself. In this example it says "Add Box", this was renamed in the "Options" tab. 
    <ol>
        <li>The first field is the default "Title" field.</li>
        <li>The "Category" dropdown is also a default field, and if unchanged, will be set to "General".</li>
        <li>The third default field is the checkbox called "Active". This allows you to toggle a list entry without deleting it.</li>
    </ol>';
	
$lang['help_permissions'] = '<h3>Permissions</h3>
    <p>You can specify the following permissions under Users &amp; Groups &rarr; Group Permissions</p>
    <ul>
        <li>::INSTANCE_NAME::: Modify Items</li>
        <li>::INSTANCE_NAME::: Modify all items</li>
        <li>::INSTANCE_NAME::: Remove items</li>
        <li>::INSTANCE_NAME::: Approve items</li>
        <li>::INSTANCE_NAME::: Modify Categories</li>
        <li>::INSTANCE_NAME::: Modify Options</li>
    </ul>
    <p>To allow non-admin users to upload files, please go to Extensions > GBFilePicker and tick that first checkbox "Show filemanagement options".</p>';
	
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
    When creating your custom filed for example "MyField" (where MyField would be name of your custom field) you would create "MyField" folder inside "ListIt2XDefs/fielddefs" folder and add needed files in this particular folder.<br />
    Fielddef file has to be prefixed with "listit2fd" for example "listit2fd.MyField.php", for input field template which is used when managing Item you would need "input.MyField.tpl" and as field definition settings template you would need admin.MyField.tpl (only needed if additional settings are possible for this field).</p>
    <p>After you are done writing your own custom field definition, you will have to go to "Modules &raquo; ListIt2" click on "Field Definitions" tab and scan for new field definitions by clicking on "Scan Field Definitions" button.<br />
    <strong>If you are looking for Field Definitions like GBFilePicker Upload, Gallery Options, FEU Dropdown, Color Picker install <a href="http://dev.cmsmadesimple.org/projects/listit2xdefs" target="_blank">ListIt2XDefs</a> module first.</strong></p><br />
    
    <h4><strong>Watch this video for detailed instructions</strong></h4>';
	
$lang['help_upgrading_12xto13'] = <<<EOT
    <h4>Step one</h4>
    <p class="red"><strong>Please read upgrade Information above!<br />
    Make sure you create Backup or your Website and Database before any further actions</strong></p>
    <p>As mentioned after upgrade from 1.2.x to 1.3 the first step you will have to make is installing newly created <strong>{ListIt2Original}</strong> Instance.<br />
    Once this Instance is installed your old Original ListIt2 Items will be available in ListIt2Original Instance which you will find in "Content" backend section.</p>
    <p>At this moment your Frontend will most possibly be broken, displaying a Error about not recognized Smarty Tag for example "unknown tag ListIt2", you should replace any of {ListIt2} tags you are using in your Pages or Templates to {ListIt2Original}.</p>
    <h4>Step two</h4>
    <p>Due to limitation in module upgrade process, it is not possible to detect any of your previous ListIt2 Module settings, which means that you should make sure to change these settings in "Content &raquo; ListIt2Original" again to your preference.<br />
    Also you will have to set any Template in "Templates" tab that you have been using before as Defaul template back to "default" if you are not using "sumarytemplate" or "detailtemplate" or any Template related parameters.</p>
    <h4>Step three</h4>
    <p>In case you have been using Field definitions like GBFilePicker Upload File or Gallery selection, please note that these are no longer part of ListItExtended Module.<br />
    Reason for this is simply that Field definitions have been completely rewriten making it possible for you to create your own custom Field definitions and simply ListItExtended DEV Team can not support any third party Modules as part of ListItExtended Module and therefor possibly delaying releases in future due to Module incompatibility or anything else.</p>
    <p>To make your old Upload File or Gallery Fields working again you will have to install <a href="http://dev.cmsmadesimple.org/projects/listit2xdefs" target="_blank">ListItExtended XDefs</a> Module which is a Gateway module to ListItExtended custom Field definitions.<br />
    After ListItExtended XDefs is installed you will find a list of available Field Definitions in "Extensions &raquo; ListIt2" by clicking on "Field Definitions" tab.<br />
    Ideally your Field definitions should work again, if that is not the case you should try to repair Field definitions database table by clicking on "Repair" button under "Maintenance" tab.</p><br />
    <p><strong>If you have followed above steps, you should now have a fully functional and upgraded ListItExtended Module and all created Instances.</strong></p>
EOT;

$lang['help_upgrading_13xto14'] = <<<EOT
	<h4>Categories changes</h4>
	<p>In version 1.4 behavior of Categories was changed and moved to Field definitions. Reason for this is, that not every ListIt2 Module instance actually requires Categories,
	therefore when you see your Categories missing you will have to create new Field definition of type "Category", if you do not see this Field definition, try scaning for new Field
	definition in ListIt2 Module interface, located in "Field Definitions" tab.</p>
	<p>Once your Category Filed definition was created, you should see "Categories" tab in your ListIt2 Module instance again, as well as have the ability of choosing a Category for a Item.</p>
EOT;
	
$lang['help_categories'] = <<<EOT
	<h3>Categories</h3>
    <p>Categories are part of Field definitions and disabled by default.<br />
    If you need Categories with this instance you will have to create a new Field definition of type "Category".<br />
    Once a Field definition was created, a news tab named "Categories" will become available in module Instance.</p>
    <p>Categories support multiple levels and created Items may belong to multiple categories, depending on your selected options while creating Category Field defintion.</p><br />
    <p>There are two sample templates included to demonstarte how categories within ListIt2 Module instance work, this should give you a starting idea on how to create your personalizied and custom<br />
    Templates for your next project.</p>
    <h4>Using Categories</h4>
    <p>For detailed usage and available parameters, have a look below at "Parameters" Help section</p>
    <pre><code>{::INSTANCE_NAME:: action='category'}</code></pre>
EOT;
	
$lang['help_templates'] = '<h3>Templates</h3>
    <p>If you are not sure what variables are available to use in your templates, try debugging:</p>
    <p>{::INSTANCE_NAME:: debug=1}</p>
    <p>You can access any field directly when looping through items using its alias, for example, to if you created a field definition with an alias "position", you can do one of the following:</p>';

$lang['help_duplicating'] = '<h3>Creating Module Instances</h3>
    <p>This module is a Control Panel for creating ListItExtended Module Instances. To create ListItExtended module Instance, simply go to "Instances" tab and click on "Create Instance" button.<br />
    Make sure you follow the CMSMS module naming conventions, a-z with no punctuation characters or spaces to be safe :)<br />
    After the module has been created a new instance will be installed and listed in original ListItExtended module under "Instances" tab.</p><br />
    <p>You can always change the module friendly name once installed under "Options" (Content &raquo; ListIt2NameOfDuplicate).<br />
    To change the icon, replace /modules/ListIt2NameOfDuplicate/images/icon.gif.<br />
    To change Admin section of the module, simply select appropriate section from Dropdown. Make sure you clear the cache after these changes.</p>';
	

$lang['help_smarty_plugins'] = <<<EOT
	<h4>What does this do?</h4>
	 <p>This plugin allows you to load ListItExtended item and category object by certain criteria, anywhere in the system.</p>
	 
	<h4>How do I use it?</h4>
	<p>Simply insert this tag into your page or template:</p>
	<pre><code>{ListIt2Loader item='item' identifier='alias' instance='ListIt2Instance' value='myalias' assign='tmp'}</code></pre>
	
	<p>&nbsp;</p>
	
	<p>Following line will load item object from instance 'ListIt2Instance' by alias 'myalias' and assign it to variable &dollar;tmp. <br /> 
	After this you can use it in similar way, just like in regular ListItExtended templates:</p>
	<pre><code>{&dollar;tmp->title}</code></pre>
	
	<p>&nbsp;</p>
	
	<p>If multiple items are being loaded, this function returns array of objects, else it returns single item/category object</p>

	<h4>What parameters does it take?</h4>
	<ul>
		<li><em>(required) </em><tt>instance</tt> - Name of instance that holds items. <i>(If used inside ListItExtended templates, this parameter is optional)</i></li>
		<li><em>(required) </em><tt>value</tt> - Comma separated list of identifier values: 'alias1,alias2,alias3' or '1,2,3'</li>
		<li><em>(optional) </em><tt>item="item"</tt> - Wanted item type, either: item/category</li>
		<li><em>(optional) </em><tt>identifier="item_id/category_id"</tt> - Wanted identifier, one of following: item_id, category_id, alias</li>
		<li><em>(optional) </em><tt>force_array="false"</tt> - Force output value as array</li>
	</ul>
EOT;

$lang['help_param_action'] = '
    Override the default action. Possible values are:
    <ul>
        <li>&quot;default&quot; - displays the summary view.</li>
        <li>&quot;detail&quot; - displays a specified entry in detail mode.</li>
        <li>&quot;search&quot; - displays the search form. Optional parameters that affect to this action only: <em>filter.</em></li>
        <li>&quot;category&quot; - displays the categories. Optional parameters that affect to this action only: <em>show_items, collapse, number_of_levels.</em></li>
        <li>&quot;archive&quot; - displays the archives. </li>
    </ul>';	
$lang['help_param_showall'] = 'Show all items, irrespective of end date.';
$lang['help_param_category'] = 'Specify an alias or comma separated aliases of the category/categories displayed items must be a member of.';
$lang['help_param_exclude_category'] = 'Specify an alias or comma separated aliases of the category/categories displayed items musn\'t be a member of.';
$lang['help_param_subcategory'] = 'If parameter \'category\' is specified, this parameter set to <em>true</em> will make allowance for subcategories\' items. It is set to false by default.';
$lang['help_param_detailtemplate'] = 'The detail template you wish to use.';
$lang['help_param_summarytemplate'] = 'The summary template you wish to use.';
$lang['help_param_searchtemplate'] = 'The search template you wish to use.';
$lang['help_param_categorytemplate'] = 'The category template you wish to use.';
$lang['help_param_orderby'] = 'You can order by any of the following columns: item_id, item_title, item_position, item_created, category_id, category_name, category_position, category_hierarchy, rand and also by custom fields with custom_* (* would be field definition alias).<br />
    <ul>
        <li>For example:<br />
        orderby=\'category_name, item_title\'</li>
        <li>With fielddef values:<br />
        orderby=\'custom_[fielddef alias]\'</li>        
        <li>You can also specify ascending or descending for any column, for example:<br />
        orderby=\'category_name|ASC, item_title|DESC\'</li>
    </ul>';
$lang['help_param_pagelimit'] = 'Maximum number of items to display (per page).  If this parameter is not supplied all matching items will be displayed.  If it is, and there are more items available than specified in the parameter, text and links will be supplied to allow scrolling through the results';
$lang['help_param_start'] = 'Start at the nth item -- leaving empty will start at the first item.';
$lang['help_param_number'] = 'Maximum number of items to display (per page) -- leaving empty will show all items. This is a synonym for the pagelimit parameter.';
$lang['help_param_detailpage'] = 'Page to display item details in. Must be a page alias/id. Used to allow details to be displayed in a different page than summary.';
$lang['help_param_summarypage'] = 'Page to display item summary in. Must be a page alias/id. Used to allow summaries to be displayed in a different page than initiator.';
$lang['help_param_item'] = 'This parameter is only applicable to the detail view. It allows specifying which item to display in detail mode. Must be an item alias.';
$lang['help_param_search'] = 'Search all fields. Uses fulltext search. Can be combined with filter search.';
$lang['help_param_search_'] = 'Search a particular field. You can use \'title\' or the alias of a field definition, e.g. search_title. Can be combined with fulltext search. Multiple search_* params can be combined.';
$lang['help_param_filter'] = 'Applies only to action: <em>search</em>. Specify the fields whose values should be offered as filter options by listing the field\'s aliases comma separated.';
//$lang['help_param_returnpage'] = 'Used for filter or search mode only. Page to display search results respectivly filtered items in. Must be a page alias. Used to allow summary to be displayed in a different page than filter / search mask.';
$lang['help_param_debug'] = 'Enables debug mode, printing out all the objects, arrays, variables available for current action.';
$lang['help_param_collapse'] = 'Applies only to action: <em>category</em>. Toggle collapse categories.';
$lang['help_param_show_items'] = 'Applies only to action: <em>category</em>. Append items to category tree.';
$lang['help_param_number_of_levels'] = 'Applies only to action: <em>category</em>. Number of of category levels to show.';
$lang['help_param_include_items'] = 'Specify an id/alias or comma separated ids/aliases of the items you want to display.';
$lang['help_param_exclude_items'] = 'Specify an id/alias or comma separated ids/aliases of the items you want to exclude from list.';
$lang['help_param_year'] = 'Filter items by year.';
$lang['help_param_month'] = 'Filter items by month.';

// this is temporary for 1.3 upgrade
$lang['upgrade_warning'] = '<h3>Important upgrade Information</h3>
    <p><strong>If you have upgraded to 1.3 from ListItExtended 1.2.2 or earlier, read this carefully!</strong></p>
    <p>After completing the upgrade proceedure of ListItExtended 1.3, your previous "ListIt2" module will be converted to a new module instance called ListIt2Original.<br />
    Please go to "Extensions &raquo; Modules" and install this newly created instance. Once installed, items from your original ListIt2 module will be available again.<br />
    Unfortunately you will have to change all {ListIt2} tags in your website to {ListIt2Original}. Sorry about that.</p>';

?>