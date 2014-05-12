<div class="pageoverflow">
	<p class="pagetext">{$fielddef->GetName()}{if $fielddef->IsRequired()}*{/if}:</p>
	<div class="pageinput">
		{if $fielddef->GetDesc()}({$fielddef->GetDesc()})<br />{/if}
		{$fld_value = $fielddef->GetValue("array")}
		<input type="text" name="{$actionid}customfield[{$fielddef->GetId()}][]" id="{$actionid}customfield_{$fielddef->GetId()}_lat" value="{$fld_value[0]}" size="{$fielddef->GetOptionValue('size')}" /><br />
		<input type="text" name="{$actionid}customfield[{$fielddef->GetId()}][]" id="{$actionid}customfield_{$fielddef->GetId()}_lon" value="{$fld_value[1]}" size="{$fielddef->GetOptionValue('size')}" /><br />
		<button id="{$actionid}customfield_{$fielddef->GetId()}_lookup">Lookup</button>
	</div>
	
	<script type="text/javascript">
	jQuery(document).ready(function($) {

		$("#{$actionid}customfield_{$fielddef->GetId()}_lookup").on("click", function(e) {
		
			$.ajaxSetup({ cache: true });
			$.getScript('https://www.google.com/jsapi', function() {
			
				google.load('maps', '3', { 
					other_params: 'sensor=false', 
					callback: function () {
					
						// Init GeoCoder
						var geocoder = new google.maps.Geocoder(),
							address = $('[name="m1_customfield[2]"]').val(); // change to smarty name attrribute value
					
						// Marker setup
						geocoder.geocode({ 'address' : address }, function(results, status) {
													
							if(status === google.maps.GeocoderStatus.OK) {
								//console.log(results);

								var lat = results[0].geometry.location.lat(),
									lng = results[0].geometry.location.lng();
											
<<<<<<< HEAD
								$("#{$actionid}customfield_{$fielddef->GetId()}_lat").val(results[0].geometry.location.lat());
								$("#{$actionid}customfield_{$fielddef->GetId()}_lon").val(results[0].geometry.location.lng());
								console.log(results[0].geometry.location);
=======
								$("#{$actionid}customfield_{$fielddef->GetId()}_lat").val(lat);
								$("#{$actionid}customfield_{$fielddef->GetId()}_lon").val(lng);
>>>>>>> f2aa63d2b3007c03feb9ba31a8a28ea88d553cbc
							}							
						});					
					}
				});
			});		
	
			e.preventDefault();
			
		});
	});
	</script>
	
</div>