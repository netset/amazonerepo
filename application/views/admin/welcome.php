<div class="admin_home_left">
 <?php if($this->session->flashdata('status')!=''){ ?>
              <p><?php echo $this->session->flashdata('status'); ?></p>  
                <?php } ?> 
		<div class="admin_home_dashboard"> 
        	<h3 class="sep"><span><?php echo 'Admin Dashboard';?> </span> </h3>
 
 	<br />
    <?php echo $this->session->userdata('success');?>
    <ul class="admin_home_dashboard_links">
	<li>
      <ul>
        <li>
          <a href="<?php echo base_url();?>admin/manage_user/listing" class="links_layout">
            Manage Users </a>
        </li>
           <li>
          <a href="<?php echo base_url();?>admin/manage_category/listing" class="links_layout">
            Manage Category </a>
        </li>     
      </ul>
    </li>
    <li>
      <ul>
	    <li>
          <a href="<?php echo base_url();?>admin/manage_job/listing" class="links_layout">
            Manage Jobs</a>
        </li> 
         <li>
          <a href="<?php echo base_url();?>admin/manage_bid/listing" class="links_layout">
            Manage Bids </a>
        </li>       
       

      </ul>
    </li>
	    <li>
      <ul>
	         
        <li>
          <a href="<?php echo base_url();?>admin/manage_message/listing" class="links_layout">
           Manage Message</a>
                     
                  </li>

      </ul>
      <ul>
	

      </ul>
    </li>
  </ul>
</ul>           
        
       
        </div>
        
        
 	</div>
   
   
   <div class="admin_home_right"> 
  <h3 class="sep">
<span><?php echo 'Quick Status';?> </span>
</h3>


<table cellspacing="0" class='admin_home_stats'>
  <thead>
   <tr>
      <td colspan="3"><center><h3> Users </h3></center></th>
    
    </tr>
    <tr>
      <th align="left"><?php echo 'Total Users';?></th>
      <th align="left"><?php echo 'Service Provider';?></th>
      <th align="left"><?php echo 'Consumer';?></th>
    </tr>
  </thead>    
          <tr>
        <td> <?php echo $this->manage_user_model->get_total_users() ; ?>   </td>
        
	 <td>  <?php echo $this->manage_user_model->get_total_users($role=2) ; ?></td>
        <td>   <?php echo $this->manage_user_model->get_total_users($role=1) ; ?> </td>
      </tr>
    
        		            	
         
      </tbody>
</table>




<table cellspacing="0" class='admin_home_stats'>
  <thead>
   <tr>
      <td colspan="4"><center><h3> Jobs </h3></center></th>
    
    </tr>
    <tr>
      <th align="left"><?php echo 'Total Jobs';?></th>
      <th align="left"><?php echo 'Pending';?></th>
      <th align="left"><?php echo 'Inprogress';?></th>
            <th align="left"><?php echo 'Completed';?></th>
    </tr>
  </thead>    
          <tr>
        <td> <?php echo $this->manage_job_model->get_total_jobs() ; ?>   </td>
               <td> <?php echo $this->manage_job_model->get_total_jobs($status=0) ; ?>   </td> 
	 <td>  <?php echo $this->manage_job_model->get_total_jobs($status=1) ; ?></td>
        <td>   <?php echo $this->manage_job_model->get_total_jobs($status=2) ; ?> </td>
      </tr>
    
        		            	
         
      </tbody>
</table>



<table cellspacing="0" class='admin_home_stats'>
  <thead>
   <tr>
      <td colspan="3"><center><h3> Bids </h3></center></th>
    
    </tr>
    <tr>
      <th align="left" colspan="3"><?php echo 'Total Bids';?></th>
    </tr>
  </thead>    
          <tr>
        <td colspan="3">  <?php echo $this->manage_bid_model->get_total_bids(); ?>      </td>
      </tr>
    
        		            	
         
      </tbody>
</table>




<table cellspacing="0" class='admin_home_stats'>
  <thead>
   <tr>
      <td colspan="3"><center><h3> Categories </h3></center></th>
    
    </tr>
    <tr>
      <th align="left" colspan="3"><?php echo 'Total Categories';?></th>
    </tr>
  </thead>    
          <tr>
        <td colspan="3">  <?php echo $this->manage_job_model->get_total_category(); ?>      </td>
      </tr>
    
        		            	
         
      </tbody>
</table>

</div>