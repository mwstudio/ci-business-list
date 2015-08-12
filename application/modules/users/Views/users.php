
	<div class="row">
		<div class="span12">
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Username</th>
						<th>Email</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbod>
					<?php foreach($users as $user): ?>
					<tr>
						<td><?= $user->id; ?></td>
						<td><?= ucfirst($user->first_name) . ' ' . ucfirst($user->last_name); ?></td>
						<td><a href="<?= base_url('users/profile/'.$user->username); ?>"><?= $user->username; ?></a></td>
						<td><?php echo $user->contact->email; ?></td>
						<td><a href="<?= base_url('users/status/'.$user->username.'/'.$user->status); ?>"><?= $user->status == 0 ? 'Inactive' : 'Active'; ?></a></td>
					</tr>
					<?php endforeach; ?>
				</tbod>
			</table>
			
		</div>
	</div>
