
	
	<div class="row">
		<div class="span6 offset3">
			<h1>Sign up</h1>
						
			<?php if(@$error): ?>
			<div class="alert">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<?php echo $error; ?>
			</div>
			<?php endif; ?>
	

			<div class="well">
			
				<form class="form-horizontal" method="post" action="">
					<div class="control-group">
						<label class="control-label" for="inputFullName">First Name</label>
						<div class="controls">
							<input type="text" id="first_name" value="<?php echo set_value('first_name'); ?>" name="first_name">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="inputFullName">Last Name</label>
						<div class="controls">
							<input type="text" id="last_name" value="<?php echo set_value('last_name'); ?>" name="last_name">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="inputEmail">Username</label>
						<div class="controls">
							<input type="text" id="inputEmail" value="<?php echo set_value('username'); ?>" name="username">
							<em>http://<strong>username</strong>.site.com</em>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="inputEmail">Email</label>
						<div class="controls">
							<input type="text" id="inputEmail" value="<?php echo set_value('email'); ?>" name="email">
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="inputEmail">Phone</label>
						<div class="controls">
							<input type="text" id="inputPhone" value="<?php echo set_value('phone'); ?>" name="phone">
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="password">Password</label>
						<div class="controls">
							<input type="password" id="password" name="password">
						</div>
					</div>
					
					<div class="control-group">
						
						<div class="pull-right">
							<?= $this->recaptcha->html();?>
						</div>
					</div>
					
					
					<div class="control-group">
						<div class="controls">
							<button type="submit" name="submit" class="btn">Sign up</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
