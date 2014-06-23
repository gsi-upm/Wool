<div id="footer">
            <p><span></span></p>
		<a href="http://gsi.dit.upm.es/" target="_blank">
		<div class="gsiLogo" title="Grupo de Sistemas Inteligentes" ></div>
		</a>
		</a>
		<div class="footerInfo" data-bind="click: showCredits">
			· <?php echo Html::anchor('admin', Lang::get('footer.credits')) ?> ·
		</div>
		<div class="paramsFooter"><?php echo Lang::get('footer.page-render'); ?>{exec_time}s
		 	<?php echo Lang::get('footer.render-use');?> {mem_usage}mb <?php echo Lang::get('footer.memory');?>
		 </div>
		<div class="footerInfo">
			<?php 
			if(isset($current_user->username)):
			echo Lang::get('footer.logged').$current_user->username; 
			endif;
			?>
		</div>
</div>