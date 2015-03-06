	<?php
		include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; 
		include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/header.html.php';
	?>

		
<!--[if IE 6]>
<link href="css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->


<div id="header-wrap">
	<div id="header-container">
		<div id="header">
			<h1>Supreme RMS</h1>
			<ul>
				<li><a href="#">Sign Out</a></li>
			</ul>
		</div>
	</div>
</div>

		
<div id="ie6-container-wrap">
	<div id="container">
		
		<div id="controls">
			
			<?php 
				if (userHasRole('Content Administrator'))
					{
						include $_SERVER['DOCUMENT_ROOT'].'/svl/ca_menu.html.php';
					}


				if (userHasRole('Site Administrator'))
				{
					include $_SERVER['DOCUMENT_ROOT'].'/svl/sa_menu.html.php';

				}
				?>
</div>
		<div id="content">
		
		  <p> <h2>    <?php htmlout ($pagetitle); ?>     </h2> </p>
	 
	  <form action ="?<?php htmlout($action); ?>" method = "post" onSubmit="return verify(this);">

      <div class="tabber">
        <div class="tabbertab" title="Business Details">
        
		  	<table cellspacing = 2 cellpadding = 2 border = 1>      
		  <tr> <h2>    <?php htmlout ($pagetitle); ?>     </h2> </tr>
		  <tr>
					<td> Business Name </td>
				  <td> <input type="text" name="bus_name" id="bus_name" title  = "Business Name" style="width: 200px" tabindex="1" value="<?php htmlout($bus_name); ?>"/> </td>
	
	
	
	
	
				 <td>Owner First Name </td>
				  <td><input type="text" name="prim_contact_fname" title = "Owner First Name"
					id="prim_contact_fname" STYLE="width: 200px" 
					value="<?php htmlout($prim_contact_fname); ?>"/></td>
	
	
		 </tr>
		 <tr>
		 <td> Street Address </td>
				<td> <textarea name="street_addr" id="street_addr" title = "Street Address" rows = "1" style="width: 200px" tabindex=2><?php htmlout($street_addr); ?></textarea></td>
				
				
				
				<td>Owner Last name </td>
					<td><input type="text" name="prim_contact_lname" title = "Owner Last Name"
					id="prim_contact_lname" STYLE="width: 200px" value="<?php htmlout($prim_contact_lname); ?>"/></td>
            </td>
		 </tr>
		 
		 <tr>
		 
		  <td>Parish</td>
				  <td><select name = "parish_id" size="1" id = "parish_id" style="width: 200px" title = "Parish"
				  tabindex=3  onchange="getCity(this.value)">
					<option value ="0"> Select Parish </option>
					<?php foreach ($parishes as $parish): ?>
					<option value = "<?php htmlout($parish['id']); ?>" 
					<?php 
				
					if ($parish['id'] == $parish_id)
					echo ' selected= "selected"'; ?> >
					<?php htmlout($parish['name']); ?> 	</option>
		  <?php endforeach; ?>   </select></td>
				
		
			<td>Home Address</td>
					<td>
					<textarea name="home_addr" id="home_addr" title = "Home Address" rows="2" cols="40"><?php htmlout($home_addr); ?></textarea></td>
			  	
		 </tr>
		 <td>Town </td>
					<td >
					<div id="citydiv"> <select name = "city_id" id = "city_id" style="width: 200px"
					title = "Town" tabindex=4 >
					<option value ="0"> Select Town </option>
					<?php foreach ($cities as $city): ?>
					<option value = "<?php htmlout($city['id']); ?>" 
		
					<?php 
					if ($city['id'] == $city_id)
					echo ' selected= "selected"'; ?> >
					<?php htmlout($city['name']); ?>  </option>
					<?php endforeach; ?> </select> </div>		  </td>
						 
					
					
					<td>Parish</td>
				  <td><select name = "owner_parish" id = "owner_parish" title = "Parish" style="width: 200px" onchange="getOwnerTown(this.value)">		  >
					<option value ="0"> Select Parish </option>
					<?php foreach ($owner_parishes as $parish): ?>
					<option value = "<?php htmlout($parish['id']); ?>" 
					<?php 				
					if ($parish['id'] == $owner_parish)
					echo ' selected= "selected"'; ?> >
					<?php htmlout($parish['name']); ?> 	</option>
					<?php endforeach; ?>   </select></td>
					
					
					
					
		  <tr>
		 <td>Post Office </td>
					<td><div id="towndiv"><select name = "zipcode_id" id = "zipcode_id" style="width: 200px"  tabindex=5>
					<option value ="0" selected="selected"> Select Postal Code </option>
					<?php foreach ($zipcodes as $zipcode): ?>
					<option value = "<?php htmlout($zipcode['id']); ?>" 
		
					<?php 
					if ($zipcode['id'] == $zipcode_id)
					echo ' selected= "selected"'; ?> >
					<?php htmlout($zipcode['post_office']); ?> 	</option>
					<?php endforeach; ?>  	</select></div></td>
            
					<td>Town</td>
					<td >
					<div id="owner_town_id"> <select name = "owner_town" id = "owner_town" style="width: 200px"
					 >
					<option value ="0"> Select Town </option>
					<?php foreach ($owner_cities as $city): ?>
					<option value = "<?php htmlout($city['id']); ?>" 
		
					<?php 
					if ($city['id'] == $owner_town)
					echo ' selected= "selected"'; ?> >
					<?php htmlout($city['name']); ?>  </option>
					<?php endforeach; ?> </select> </div>		 </td>
					
					
					
		 </tr>
		 <td>Country </td>
					<td><select name = "country_id" id = "country_id" style="width: 200px" tabindex=6>
					<?php foreach ($countries as $country): ?>
					<option value = "<?php htmlout($country['id']); ?>" 
		
					<?php 
 					if ($country['id'] == $country_id)
					echo ' selected= "selected"'; ?> >
					<?php htmlout($country['name']); ?>
					</option>
					<?php endforeach; ?>
					</select></td>
					
					<td>Post Office </td>
					<td><div id="owner_zipcode_id"><select name = "owner_zipcode" id = "owner_zipcode" style="width: 200px">
					<option value ="0" selected="selected"> Select Postal Code </option>
					<?php foreach ($owner_zipcodes as $zipcode): ?>
					<option value = "<?php htmlout($zipcode['id']); ?>" 
		
					<?php 
					if ($zipcode['id'] == $owner_zipcode)
					echo ' selected= "selected"'; ?> >
					<?php htmlout($zipcode['post_office']); ?> 	</option>
					<?php endforeach; ?>  	</select></div></td>
					
					
					
					
					
					
		 <tr>
		   <td>TRN No </td>
					  <td><input type="text" name="trn" title = "Taxpayer Registration Number" 
					  id="trn" style="width: 200px" value="<?php htmlout($trn); ?>"/></td>
					  
					  
					  <td>Home Phone</td>
					<td><input type="text" name="home_phone" title = "Owner's Home Phone Number"
					id="home_phone" STYLE="width: 200px" value="<?php htmlout($home_phone); ?>"/></td>
		 </tr>
		 <tr>
		  <td>Phone</td>
					<td><input type="text" name="bus_phone" title = "Business Phone Number"
					id="bus_phone" STYLE="width: 200px" value="<?php htmlout($bus_phone); ?>"/></td>
		
		<td>Mobile </td>
					<td><input type="text" name="mobile_phone" Title = "Cellular Phone"
					id="mobile_phone" STYLE="width: 200px" value="<?php htmlout($mobile_phone); ?>"/></td>
		 
		 </tr>
		  <tr>
		 <td>Other </td>
					<td><input type="text" name="alt_phone" title = "Other Business Phone Number"
					id="alt_phone" STYLE="width: 200px" value="<?php htmlout($alt_phone); ?>"/></td>
		 
					<td>Email</td>
					<td><input type="text" name="email" Title = "Email Address"
					id="email" STYLE="width: 200px" value="<?php htmlout($email); ?>"/></td>
		 
		 </tr>
		  <tr>
		   
					  <td>Fax No</td>
					<td><input type="text" name="faxno" Title = "Fax Number"
					id="faxno" STYLE="width: 200px" value="<?php htmlout($faxno); ?>"/></td>
					  
					  
					
              <td colspan="2"><strong>Secondary Contact</strong></td>
           
			
			
            
		 
		 
		 </tr>
		 <tr>
		 
					<td>Business Type</td>
				  <td><select name = "bus_reg_type_id" id = "bus_reg_type_id" title = "Businenss Registration Type" style="width: 200px" onchange="getOwnerTown(this.value)">		  >
					<option value ="0"> Select Business Type </option>
					<?php foreach ($bus_reg_types as $bus_reg_type): ?>
					<option value = "<?php htmlout($bus_reg_type['id']); ?>" 
					<?php 				
					if ($bus_reg_type['id'] == $bus_reg_type_id)
					echo ' selected= "selected"'; ?> >
					<?php htmlout($bus_reg_type['name']); ?> 	</option>
					<?php endforeach; ?>   </select></td>
			</tr>		
		 
		 
		 
		 
		 
		 <tr>
		 
		  <td>Trade Style </label></td>
              <td><select name = "trade_style_id" id = "trade_style_id" STYLE="width: 200px" title = "Business Trade Style">
                  <option value ="0"> Select Trade Style </option>
                  <?php foreach ($trade_styles as $trade_style): ?>
                  <option value = "<?php htmlout($trade_style['id']); ?>" 
		
		<?php 
 		
		if ($trade_style['id'] == $trade_style_id)
		echo ' selected= "selected"'; ?> >
                  <?php htmlout($trade_style['name']); ?>
                  </option>
                  <?php endforeach; ?>
                </select></td>
				
				<td>BDO</td>
              <td><select name = "bus_anal_bdo" id = "bus_anal_bdo" STYLE="width: 200px" title = "Business Development Officer">
                  <option value ="0"> Select BDO </option>
                 
				 <?php foreach ($bdo_officers as $bdo_officer): ?>
                  <option value = "<?php htmlout($bdo_officer['id']); ?>" 
				  <?php 
 		
				if ($bdo_officer['id'] == $bdo_officer_id)
				echo ' selected= "selected"'; ?> >
				<?php htmlout($bdo_officer['name']); ?>  </option>   <?php endforeach; ?>
					</select></td>
		 </tr>
		 
		 <tr>
		 </tr>
		 
		 <tr>
		 <td>Application For </td>
					<td><select name = "application_type_id" id = "application_type_id" style="width: 200px" title = "Application Type"
					tabindex=7>
					<option value ="0"> Select Application Type </option>
					<?php foreach ($application_types as $application_type): ?>
					<option value = "<?php htmlout($application_type['id']); ?>" 
			
					<?php 
 		
					if ($application_type['id'] == $application_type_id)
					echo ' selected= "selected"'; ?> >
					<?php htmlout($application_type['name']); ?>
					</option>
					<?php endforeach; ?>
					</select></td>
					
					
					
             
				  <td>First Name</td>
				  <td><input type="text" name="sec_contact_fname" title = "First Name"
					id="sec_contact_fname" STYLE="width: 200px" 
					value="<?php htmlout($sec_contact_fname); ?>"/></td>
            </tr>
		  </tr>
		 
		 <tr>
		   <tr>
						<td>Service Provider</td>
						<td><select name = "tech_eval_serv_prov_id" id = "tech_eval_serv_prov_id"
						STYLE="width: 200px" title = "Service Provider" >
						<option value ="0"> Select Provider </option>
						<?php foreach ($tech_eval_serv_providers as $tech_eval_serv_provider): ?>
						<option value = "<?php htmlout($tech_eval_serv_provider['id']); ?>" 
						<?php 
				
						if ($tech_eval_serv_provider['id'] == $tech_eval_serv_prov_id)
						echo ' selected= "selected"'; ?> >
						<?php htmlout($tech_eval_serv_provider['name']); ?>
						</option>
						<?php endforeach; ?>
						</select></td>
						
						
						<td>Last Name</td>
					<td><input type="text" name="sec_contact_lname" Title = "Secondary Contact Person Last Name"
					id="sec_contact_lname" STYLE="width: 200px" 
					value="<?php htmlout($sec_contact_lname); ?>"/></td>
            </tr>
		 
		 </tr>
		 
		 <tr>
		 <td>	Status  </td> 
			<td> <select name = "status_id" id = "status_id" style="width: 200px" title = "Status" >   
			
           <option value ="0"> Select Retailer Status </option>
          <?php foreach ($statuses as $status): ?>
          <option value = "<?php htmlout($status['id']); ?>" 
		
			<?php 
 		
			if ($status['id'] == $status_id)
		echo ' selected= "selected"'; ?> >
          <?php htmlout($status['status']); ?>
          </option>
          <?php endforeach; ?>
        </select> 	</td>
		
		 <td> Application Date</td>
					  <td><input type="text" name="application_date" id="application_date" title = "Application Date"
					  STYLE="width: 200px" value="<?php htmlout($application_date); ?>" /></td>
		 
		 </tr>
		  <td>Corporate Name </td>
               <td><input type="text" name="corporate_name" id="corporate_name" style="width: 200px" title = "Name of the Corporate Group"
			   value="<?php htmlout($corporate_name); ?>"/></td>
		  <tr>
		 </tr>
		 
		
			
          </table>
		
		  
		  
        </div>
		
		
        <div class="tabbertab" title="Support">
          <table cellspacing = 2 cellpadding = 2 border = 1>
            <tr>
              <td>BDO </td>
              <td><select name = "bdo_officer_id" id = "bdo_officer_id" STYLE="width: 200px" title = "Business Development Officer">
                  <option value ="0"> Select BDO </option>
                  <?php foreach ($bdo_officers as $bdo_officer): ?>
                  <option value = "<?php htmlout($bdo_officer['id']); ?>" 
		
		<?php 
 		
		if ($bdo_officer['id'] == $bdo_officer_id)
		echo ' selected= "selected"'; ?> >
                  <?php htmlout($bdo_officer['name']); ?>
                  </option>
                  <?php endforeach; ?>
                </select></td>
				
				
		  <td colspan="2" align = "center"><strong>Location Assessment</strong></td>
            </tr>
			
			
			
			
            <tr>
              <td><label for = "csr_officer">CSR </label></td>
              <td><select name = "csr_officer_id" id = "csr_officer_id" STYLE="width: 200px" title = "Customer Service Representative">
                  <option value ="0"> Select CSR </option>
                  <?php foreach ($csr_officers as $csr_officer): ?>
                  <option value = "<?php htmlout($csr_officer['id']); ?>" 
		
		<?php 
 		
		if ($csr_officer['id'] == $csr_officer_id)
		echo ' selected= "selected"'; ?> >
                  <?php htmlout($csr_officer['name']); ?>
                  </option>
                  <?php endforeach; ?>
                </select></td>
				
				<td>BDO</td>
              <td><select name = "bus_anal_bdo" id = "bus_anal_bdo" STYLE="width: 200px" title = "Business Development Officer">
                  <option value ="0"> Select BDO </option>
                 
				 <?php foreach ($bdo_officers as $bdo_officer): ?>
                  <option value = "<?php htmlout($bdo_officer['id']); ?>" 
				  <?php 
 		
				if ($bdo_officer['id'] == $bdo_officer_id)
				echo ' selected= "selected"'; ?> >
				<?php htmlout($bdo_officer['name']); ?>  </option>   <?php endforeach; ?>
					</select></td>
            </tr>
				
				
				
				
            </tr>
            <tr>
              <td><input type="checkbox" name="multiple_agent" value="yes" title = "Applicant has other retail locations?"
<?php 
	if($multiple_agent){
		echo 'checked = "checked"';
	}
?>
	  /></td>
              <td> Multiple Agent </td>
           
		   
		   <td>Completion Date</td>
              <td><input type="text" name="bus_anal_comp_date" id="bus_anal_comp_date" STYLE="width: 200px" value="<?php htmlout($bus_anal_comp_date); ?>"/></td>
			
		   
		   
            </tr>
			<tr>
              <td><input type="checkbox" name="multiple_terminal" value="yes"  title = "Applicant has more than one terminal at present location?"
<?php 
	if($multiple_terminal){
		echo 'checked = "checked"';
	}
?>
	  /></td>
              <td> Multiple terminals </td>
			  
			  
			   <td>Result</td>
              <td><select name = "bus_anal_result_id" id = "bus_anal_result_id" STYLE="width: 200px" Title = "Location Assessment Result">
                  <option value ="0"> Select Result </option>
                  <?php foreach ($bus_anal_results as $bus_anal_result): ?>
                  <option value = "<?php htmlout($bus_anal_result['id']); ?>" 
		
		<?php 
 		
		if ($bus_anal_result['id'] == $bus_anal_result_id)
		echo ' selected= "selected"'; ?> >
                  <?php htmlout($bus_anal_result['name']); ?>
                  </option>
                  <?php endforeach; ?>
                </select></td>
            </tr>
			
			
			<tr>
			<td> </td>
			<td> </td>
			
			<td>Comment</td>
				  <td><textarea name="bus_anal_note" id="bus_anal_note" title = "Any comment on the retail location assessment"><?php htmlout($bus_anal_note); ?></textarea></td> 
			</tr>
			
			
			<table>
				
				 <tr>
						<td></td>
					  	<td align  = "center">Mon </td>
						<td align  = "center">Tue </td>
						<td align  = "center">Wed </td>
						<td align  = "center">Thur </td>
						<td align  = "center">Fri </td>
						<td align  = "center">Sat </td>
						<td align  = "center">Sun </td>
				</tr>
				 
				
				
			 <tr>
					  <td>Opening Times </td>
					 
				
					  
					   <td><input type="text" name="mon_openingtime" title = "Monday Opening Time"
					  id="mon_openingtime" style="width: 70px" 
					  value="<?php htmlout($mon_openingtime); ?>"/> </td>
					  
					   <td><input type="text" name="tue_openingtime" title = "Tuesday Opening Time"
					  id="tue_openingtime" style="width: 70px" 
					  value="<?php htmlout($tue_openingtime); ?>"/> </td>
					  
					   <td><input type="text" name="wed_openingtime" title = "Wednesday Opening Time"
					  id="wed_openingtime" style="width: 70px" 
					  value="<?php htmlout($wed_openingtime); ?>"/></td>
					  
					   <td><input type="text" name="thu_openingtime" title = "Thursday Opening Time"
					  id="thu_openingtime" style="width: 70px" 
					  value="<?php htmlout($thu_openingtime); ?>"/></td>
					  
					   <td><input type="text" name="fri_openingtime" title = "Friday Opening Time"
					  id="fri_openingtime" style="width: 70px" 
					  value="<?php htmlout($fri_openingtime); ?>"/></td>
					 
					 <td><input type="text" name="sat_openingtime" title = "Saturday Opening Time"
					  id="sat_openingtime" style="width: 70px" 
					  value="<?php htmlout($sat_openingtime); ?>"/></td>
					  
					   <td><input type="text" name="sun_openingtime" title = "Sunday Opening Time"
					  id="sun_openingtime" style="width: 70px" 
					  value="<?php htmlout($sun_openingtime); ?>"/></td>
					  
			</tr>
			
				
			 <tr>
					  <td>Closing Times </td>
					 
					   
					   <td><input type="text" name="mon_closingtime" title = "Monday Closing Time"
					  id="mon_closingtime" style="width: 70px" 
					  value="<?php htmlout($mon_closingtime); ?>"/> </td>
					  
					   <td><input type="text" name="tue_closingtime" title = "Tuesday ClosingTime"
					  id="tue_closingtime" style="width: 70px" 
					  value="<?php htmlout($tue_closingtime); ?>"/> </td>
					  
					   <td><input type="text" name="wed_closingtime" title = "Wednesday Closing Time"
					  id="wed_closingtime" style="width: 70px" 
					  value="<?php htmlout($wed_closingtime); ?>"/></td>
					  
					   <td><input type="text" name="thu_closingtime" title = "Thursday Closing Time"
					  id="thu_closingtime" style="width: 70px" 
					  value="<?php htmlout($thu_closingtime); ?>"/></td>
					  
					   <td><input type="text" name="fri_closingtime" title = "Friday Closing Time"
					  id="fri_closingtime" style="width: 70px" 
					  value="<?php htmlout($fri_closingtime); ?>"/></td>
					 
					 <td><input type="text" name="sat_closingtime" title = "Saturday Closing Time"
					  id="sat_closingtime" style="width: 70px" 
					  value="<?php htmlout($sat_closingtime); ?>"/></td>
					   
					   <td><input type="text" name="sun_closingtime" title = "Sunday Closing Time"
					  id="sun_closingtime" style="width: 70px" 
					  value="<?php htmlout($sun_closingtime); ?>"/></td>
					  
				</tr>
				
			
			</table>		  
						
			
          </table>
        </div>
		
		
		
		
		<div class="tabbertab" title="Application">
		
        <table cellspacing = 2 cellpadding = 2 border = 1>
            <tr>
			  <td colspan="2" align = "center"><strong>Application Package</strong></td>
			    <td colspan="2" align = "center"><strong>Contract</strong></td>
			</tr>
			
			<tr>
              <td>Sent To Applicant</td>
              <td><input type="text" name="pck_sub_to_pros_date" id="pck_sub_to_pros_date" title = "Date - Application Package Sent To Applicant" STYLE="width: 200px" value="<?php htmlout($pck_sub_to_pros_date); ?>"/></td>
			  
			  <td>Sent To Applicant</td>
					  <td><input type="text" name="contract_sub_to_pros_date" id="contract_sub_to_pros_date" title ="Date - Contract Sent To Applicant"
					  STYLE="width: 200px" value="<?php htmlout($contract_sub_to_pros_date); ?>"/></td>
					  
            </tr>
			
			
			
			
            <tr>
              <td>Received</td>
              <td><input type="text" name="pck_recd_by_pros_date" id="pck_recd_by_pros_date" STYLE="width: 200px" title = "Application Package Received By Applicant Date" value="<?php htmlout($pck_recd_by_pros_date); ?>"/></td>
           
			<td>Returned </td>
					  <td><input type="text" name="contract_ret_date" id="contract_ret_date" title = "Contract Signed and Returned"
					  STYLE="width: 200px" value="<?php htmlout($contract_ret_date); ?>"/></td>

		   </tr>
           
		  
		  
				
				     		  
		  <tr>       <td colspan="2" align = "center"><strong>Background Check</strong></td>
					 <td colspan="2" align = "center"><strong>Banking</strong></td>
		  </tr>
            	
				<td>Provider</td>
					<td><select name = "sec_chk_serv_prov_id" id = "sec_chk_serv_prov_id" title = "Security Check Service Provider"
					STYLE="width: 200px">
					<option value ="0"> Select Provider </option>
					<?php foreach ($sec_chk_serv_providers as $sec_chk_serv_provider): ?>
					<option value = "<?php htmlout($sec_chk_serv_provider['id']); ?>" 
				
					<?php 
					if ($sec_chk_serv_provider['id'] == $sec_chk_serv_prov_id)
					echo ' selected= "selected"'; ?> >
					<?php htmlout($sec_chk_serv_provider['name']); ?>
					</option>
					<?php endforeach; ?>
					</select>
					</td>
			 
			 <td> Guarantee Received</td>
					  <td><input type="text" name="bnk_grant_recd_date" id="bnk_grant_recd_date" 
					  STYLE="width: 200px" value="<?php htmlout($bnk_grant_recd_date); ?>" /></td>
			
			
			<tr>
				  <td>Date Requested</td>
				  <td><input type="text" name="sec_chk_req_date" id="sec_chk_req_date" title = "Background Check Request Date" 
				  STYLE="width: 200px"  value="<?php htmlout($sec_chk_req_date); ?>" /></td>
				  
				   <td>Account Requested </td>
					  <td><input type="text" name="bnk_acc_req_date" id="bnk_acc_req_date" title = "Bank Account Requested Date" STYLE="width: 200px" value="<?php htmlout($bnk_acc_req_date); ?>" /></td>
				  
				  
            </tr>
			
			
          
			
			
			
			
				<tr>
				  <td> Completion Date</td>
				  <td><input type="text" name="sec_chk_comp_date" id="sec_chk_comp_date" 
				  STYLE="width: 200px"  value="<?php htmlout($sec_chk_comp_date); ?>"/></td>
				  
				   <td>Account No.</td>
				  <td><input type="text" name="bnk_accno" id="bnk_accno" title = "Bank Account Number"
				  STYLE="width: 200px"  value="<?php htmlout($bnk_accno); ?>" /></td>
				  
			<tr>       <td colspan="2" align = "center"><strong>Technical Evaluation</strong></td>
					 <td colspan="2" align = "center"><strong>Installation</strong></td>
		  </tr>



			</tr>
			 <tr>
				  <td>Sent To Provider</td>
				  <td><input type="text" name="tech_eval_sub_to_serv_prov_date" 
				  id="tech_eval_sub_to_serv_prov_date" 
				  STYLE="width: 200px" value="<?php htmlout($tech_eval_sub_to_serv_prov_date); ?>" /></td>
				  
				   <td>System Configuration</td>
					<td><input type="text" name="agent_config_date" id="agent_config_date" STYLE="width: 200px" value="<?php htmlout($agent_config_date); ?>" /></td>
			  
            </tr>
			
			
			
		
			
			
			
            <tr>
             
              <td>Result</td>
				  <td><select name = "tech_eval_result_id" id = "tech_eval_result_id" style="width: 200px" title = "Result of Technical Evaluation"
				  >
					<option value ="0"> Select Result </option>
					<?php foreach ($tech_eval_results as $tech_eval_result): ?>
					<option value = "<?php htmlout($tech_eval_result['id']); ?>" 
					<?php 
				
					if ($tech_eval_result['id'] == $tech_eval_result_id)
					echo ' selected= "selected"'; ?> >
					<?php htmlout($tech_eval_result['name']); ?> 	</option>
					<?php endforeach; ?>   </select></td>
				
				
				 <td>Installation Date</td>
				<td><input type="text" name="terminal_install_date" id="terminal_install_date" 
				title = "Installation Date" STYLE="width: 200px" value="<?php htmlout($terminal_install_date); ?>" /></td>
				
				</tr>
			
			
			
			
			
            <tr>
              <td> Comment</td>
              <td><textarea name="tech_eval_note" id="tech_eval_note" cols="20" rows="3"> <?php htmlout($tech_eval_note); ?> 
</textarea></td>
            </tr>
            <tr>
              <td>Evaluation Docs</td>
              <td><input type="text" name="tech_eval_recd_date" id="tech_eval_recd_date" 
			  title = "Received Technical Evaluation Documentation" STYLE="width: 200px" value="<?php htmlout($tech_eval_recd_date); ?>" /></td>
            </tr>
            <tr>
             
            </tr>
            <tr>
             
            </tr>
			
			
			
			</tr>
			
			</table>
        </div>
		
		
		
		
		
		
		
		
      </div>
      <div>
        <input type = "hidden" name = "id" value = "<?php htmlout($id); ?>" />
        <input type = "submit" value = "<?php htmlout($button); ?>" />
      </div> 
	  </form>
	  </div>
	  
	  
	  
	  
	  	</div>
		</div>


<div id="footer-wrap">
	<div id="footer-container">
		<div id="footer">
			
			<p>Copyright</p>
		</div>
	</div>
</div>
	  
	  
	  
      <script language="JavaScript" src="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>jquery-ui-1.8.18.custom/tabber.js"></script> 
    <!--  <script language="JavaScript" src="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>js/jquery.ui.datepicker.js"></script> -->
    <!--    <script type="text/javascript" src="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>sjs/jquery-1.3.2.min.js"></script> -->
      <script type="text/javascript" src="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>jquery-ui-1.8.18.custom/cal.js"></script> 
      <script type="text/javascript" src="<?php
		echo 'http://'.$_SERVER['SERVER_NAME'].'/svl/';
		?>jquery-ui-1.8.18.custom/ajaxPopulatefield.js"></script> 
	  
	  
	 

<script>

	jQuery(function($){
	
	  
	
	
	
	
	
	
	
	
		$("#bus_phone").mask("(999) 999-9999");
		$("#alt_phone").mask("(999) 999-9999");
		$("#faxno").mask("(999) 999-9999");
		$("#home_phone").mask("(999) 999-9999");
		$("#mobile_phone").mask("(999) 999-9999");
		$("#trn").mask("999-999-999");
	
		
	
		$.mask.definitions['g']="[ ]";
		$.mask.definitions['h']="[aApP]";
		$.mask.definitions['i']="[mM]";
		$.mask.definitions['2']="[0-1]";
		$.mask.definitions['6']="[0-5]";
		TimeMask = "29:69ghi";
		
		
		
		
		$('#mon_openingtime').mask(TimeMask);
		$('#tue_openingtime').mask(TimeMask);
		$('#wed_openingtime').mask(TimeMask);
		$('#thu_openingtime').mask(TimeMask);
		$('#fri_openingtime').mask(TimeMask);
		$('#sat_openingtime').mask(TimeMask);
		$('#sun_openingtime').mask(TimeMask);
		
		$('#mon_closingtime').mask(TimeMask);
		$('#tue_closingtime').mask(TimeMask);
		$('#wed_closingtime').mask(TimeMask);
		$('#thu_closingtime').mask(TimeMask);
		$('#fri_closingtime').mask(TimeMask);
		$('#sat_closingtime').mask(TimeMask);
		$('#sun_closingtime').mask(TimeMask);
		
		
		$('#application_date').datepicker({ dateFormat: 'yy-mm-dd'});
		
		
		
		$('#bus_anal_comp_date').datepicker({ dateFormat: 'yy-mm-dd'});
		
		
	  $(form).validate({ 
		rules: { 
        application_date: { 
            required: true, 
            dpDate: true 
        } 
		}     
		}); 
	  
		
		
    });
</script>
	  
	  
	
	 
	  
	   
	  
	  
	  
	  
	  
	  
	  <script language="JavaScript">
	  
		function verify(form)
		{
		
			
		
		
		
			if(form.bus_name.value == "")
				{
					alert("Please enter a Business name.");
					form.bus_name.focus();
						return false;
				}
	 
			 if(form.street_addr.value == "")
				{
					alert("Please enter a business street address.");
					form.street_addr.focus();
					return false;
				}
			  
			if(form.parish_id.value == "")
			{
				alert("Please select business parish.");
				form.parish_id.focus();
				return false;
			}
	  
	  	  
			if((form.city_id.value == "" )|| (form.city_id.value == "0" ))
			{
				alert("Please select business town.");
				form.city_id.focus();
				return false;
			}
	  
				
	  if(!checkDate(form.application_date))  {alert("Application Date f");return false;}

	  
	  if(!checkTime(form.bus_anal_comp_date)) return false; 
	  return true;
			
}	  
	  
	  function checkDate(field) { 
	  var allowBlank = true; 
	  var minYear = 1902; 
	  var maxYear = (new Date()).getFullYear(); 
	  var errorMsg = ""; 
	  // regular expression to match required date format 
	  re = /^(\d{4})-(\d{1,2})-(\d{1,2})$/; 
	if(field.value != '') {
	  if(regs = field.value.match(re)) 
	  { if(regs[3] < 1 || regs[3] > 31) { 
	  errorMsg = "Invalid value for day: " + regs[3]; 
	  } else if(regs[2] < 1 || regs[2] > 12) { 
	  errorMsg = "Invalid value for month: " + regs[2]; 
	  } else if(regs[1] < minYear || regs[1] > maxYear) { 
	  errorMsg = "Invalid value for year: " + regs[1] + " - must be between " + minYear + " and " + maxYear; 
	  } 
	  } else { errorMsg = "Invalid date format: " + field.value; 
	  } 
	  } else if(!allowBlank) { 
	  errorMsg = "Empty date not allowed!"; 
	  } 
	 
	 if(errorMsg != "") 
	 {
	//alert(errorMsg); 
	field.focus(); 
	field.value=""; 
	return false; 
	} 
	return true; }
	  
	</script>
	
		
							
	