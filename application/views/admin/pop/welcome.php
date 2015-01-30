<div class="admin_home_left">
		<div class="admin_home_dashboard"> 
        	<h3 class="sep"><span><?php echo 'Admin Dashboard';?> </span> </h3>
 
 	<br />
    <?php echo $this->session->userdata('success');?>
    <ul class="admin_home_dashboard_links">
	 <li>
      <ul>
        <li>
          <a href="<?php echo base_url();?>admin/manage_user/listing" class="links_theme">
          Manage Users </a>
		          <li>
          <a href="<?php echo base_url();?>admin/manage_service/listing" class="links_theme">
          Manage Services</a>
        </li>
        </li>
      </ul>
    </li>
	<li>
      <ul>
        <li>
          <a href="<?php echo base_url();?>admin/manage_category/listing" class="links_layout">
           Manage Categories </a>
        </li>
        
      </ul>
    </li>
    <li>
      <ul>
	         
        <li>
          <a href="<?php echo base_url();?>admin/manage_drug/listing" class="links_abuse">
            Manage Drugs </a>
                     
                  </li>
     
        
      </ul>
    </li>
  </ul>
</ul>           
        
       
        </div>
        
        
 	</div>
    
    
<div class="admin_home_right"> 
  <h3 class="sep">
<span><?php echo 'Quick Stats';?> </span>
</h3>



<table cellspacing="0" class='admin_home_stats'>
  <thead>
    <tr>
      <th align="left"><?php echo 'Statistics';?></th>
      <th align="left"><?php echo 'Active';?></th>
	  <th align="left"><?php echo 'Inactive';?></th>
      <th align="left"><?php echo 'Total';?></th>
    </tr>
  </thead>
  <tbody>         
          <tr>
        <td>
          Users        </td>
		  <?php $active_users = $this->manage_user_model->get_active_users();
		  $deactive_users = $this->manage_user_model->get_deactive_users();?>
         <td>
          <?php echo $active_users; ?>        </td>
        <td>
          <?php echo $deactive_users; ?>        </td>
		<td>
          <?php echo ($active_users+$deactive_users); ?>        </td>
      </tr>
          <tr>
        <td>
         Drugs        </td>
		 <?php $active_drugs = $this->manage_drug_model->get_active_drugs();
		  $deactive_drugs = $this->manage_drug_model->get_deactive_drugs();?>
      <td>
          <?php echo $active_drugs; ?>        </td>
        <td>
          <?php echo $deactive_drugs; ?>        </td>
		<td>
          <?php echo ($active_drugs+$deactive_drugs); ?>        </td>
      </tr>
          <tr>
        <td>
          Categories        </td>
		  <?php $active_categories = $this->manage_category_model->get_active_categories(); 
		  $deactive_categories = $this->manage_category_model->get_deactive_categories();?>
        <td>
          <?php echo $active_categories; ?>        </td>
        <td>
          <?php echo $deactive_categories; ?>        </td>
		<td>
          <?php echo ($active_categories+$deactive_categories); ?>        </td>
      </tr>          		            	
         
      </tbody>
</table>


</div>