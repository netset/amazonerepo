<nav>
				<ul>
					<li><a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>public/images/frontend_images/new-logo.jpg" /></a><div class="clear"></div></li>
					<li class="li-height"><a href="<?php echo base_url()?>static_pages"><div class="size_a"><?php if(isset($selected_nav) && $selected_nav=='static_pages') {?> <img src="<?php echo base_url()?>public/images/frontend_images/leaf-gr.png"  /> <?php } else {?><img src="<?php echo base_url()?>public/images/frontend_images/leaf.png" onmouseover="this.src='<?php echo base_url()?>public/images/frontend_images/leaf-gr.png'" onmouseout="this.src='<?php echo base_url()?>public/images/frontend_images/leaf.png'"/><?php }?></div><?php if(isset($selected_nav) && $selected_nav=='static_pages') {?><p><span>Progetto</span></p> <?php } else { ?> <p>Progetto</p> <?php }?></a><div class="clear"></div></li>
                    
                    
					<li class="li-height"><a href="<?php echo base_url()?>static_pages/staticpage_chisiamo"><div class="size_a"><?php if(isset($selected_nav) && $selected_nav=='staticpage_chisiamo') {?><img src="<?php echo base_url()?>public/images/frontend_images/group-hover.png"  /><?php } else {?><img src="<?php echo base_url()?>public/images/frontend_images/group.png" onmouseover="this.src='<?php echo base_url()?>public/images/frontend_images/group-hover.png'" onmouseout="this.src='<?php echo base_url()?>public/images/frontend_images/group.png'"/><?php }?></div><?php if(isset($selected_nav) && $selected_nav=='staticpage_chisiamo') {?><p><span>Chi Siamo</span></p><?php } else { ?> <p>Chi Siamo</p> <?php }?></a><div class="clear "></div></li>
                    
					<li class="li-height"><a href="<?php echo base_url()?>icorner"><div class="size_a"><?php if(isset($selected_nav) && $selected_nav=='icorner') {?><img class="middle" src="<?php echo base_url()?>public/images/frontend_images/stnd-hover.png" /><?php } else {?><img class="middle" src="<?php echo base_url()?>public/images/frontend_images/stnd.png" onmouseover="this.src='<?php echo base_url()?>public/images/frontend_images/stnd-hover.png'" onmouseout="this.src='<?php echo base_url()?>public/images/frontend_images/stnd.png'" /><?php }?></div><?php if(isset($selected_nav) && $selected_nav=='icorner') {?><p><span>I corner</span></p><?php } else { ?><p>I corner</p><?php } ?></a><div class="clear"></div></li>
                    
					<li class="li-height"><a href="<?php echo base_url()?>faq"><div class="size_a"><?php if(isset($selected_nav) && $selected_nav=='faq') {?><img src="<?php echo base_url()?>public/images/frontend_images/chat-hover.png"  /><?php } else {?><img src="<?php echo base_url()?>public/images/frontend_images/chat.png" onmouseover="this.src='<?php echo base_url()?>public/images/frontend_images/chat-hover.png'" onmouseout="this.src='<?php echo base_url()?>public/images/frontend_images/chat.png'" /><?php } ?></div><?php if(isset($selected_nav) && $selected_nav=='faq') {?><p><span>FAQ</span></p><?php } else { ?><p>FAQ</p><?php }?></a><div class="clear"></div></li>
                    
					<li class="li-height"><a href="<?php echo base_url()?>contatti"><div class="size_a"><?php if(isset($selected_nav) && $selected_nav=='contatti') {?><img class="new" src="<?php echo base_url()?>public/images/frontend_images/msg-hover.png" /><?php } else {?> <img src="<?php echo base_url()?>public/images/frontend_images/msg.png" onmouseover="this.src='<?php echo base_url()?>public/images/frontend_images/msg-hover.png'" onmouseout="this.src='<?php echo base_url()?>public/images/frontend_images/msg.png'" /><?php }?> </div><?php if(isset($selected_nav) && $selected_nav=='contatti') {?><p><span>Contatti</span></p><?php } else { ?><p>Contatti</p><?php }?></a><div class="clear"></div></li>
                                        <div class="clear"></div>
				</ul>
</nav>