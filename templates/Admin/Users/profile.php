<div class="container">
<div class="card mb-3 shadow module-blue-big border borderless mt-3">
		<div class="card-body bg-light border borderless">
			<div class="row">
				<div class="col-md-3 text-center">
<?php echo $this->Html->image('../files/Users/avatar/' . $user->slug . '/' . $user->avatar, ['alt' => 'Profile Picture', 'class' => 'rounded-circle shadow my-2', 'width' => '200px', 'height' => '200px']); ?>
				</div>
				<div class="col-md-9">
				<h3><?= h($user->fullname) ?></h3>
				  <table>
					<tr>
						<th><?= __('User Group') ?></th>
						<td><?= $user->has('user_group') ? $this->Html->link($user->user_group->name, ['controller' => 'UserGroups', 'action' => 'view', $user->user_group->id]) : '' ?></td>
					</tr>
					<tr>
						<th><?= __('Username') ?></th>
						<td><?= h($user->username) ?></td>
					</tr>
					<tr>
						<th><?= __('Email') ?></th>
						<td><?= h($user->email) ?></td>
					</tr>
					<tr>
						<th><?= __('Status') ?></th>
						<td><?= h($user->status) ?></td>
					</tr>
					<tr>
						<th><?= __('Id') ?></th>
						<td><?= $this->Number->format($user->id) ?></td>
					</tr>
				</table>
<div class="row">
	<div class="col">
	  Last Login: <?= date('d M Y h:m:s', strtotime($user->last_login)); ?>
	</div>
	<div class="col">
	  Created: <?= date('d M Y h:m:s', strtotime($user->created)); ?>
	</div>
	<div class="col">
	  Modified: <?= date('d M Y h:m:s', strtotime($user->modified)); ?>
	</div>
</div>
				</div>
			</div>
		</div>
</div>

<div class="card mb-3 shadow module-blue-big border borderless">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">Related Articles
		<div class=" text-light panel_subs"><?php echo $system_name; ?></div>
	</div>
		<div class="card-body bg-light border borderless px-0">
<div class="text-end pb-2 pe-2">
<?= $this->Html->link(__('View All Articles'), ['prefix' => 'Admin','controller' => 'Articles','action' => 'index'], ['class' => 'btn btn-outline-secondary btn-sm', 'escape' => false]) ?>		
</div>
                <?php if (!empty($user->articles)) : ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm px-1">
                        <tr>
                            <th class="px-3"><?= __('Id') ?></th>
                            <th><?= __('Category Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Hits') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Publish On') ?></th>
                            <th class="actions"></th>
                        </tr>
                        <?php foreach ($user->articles as $articles) : ?>
                        <tr>
                            <td class="px-3"><?= h($articles->id) ?></td>
                            <td><?= h($articles->category_id) ?></td>
                            <td><?= h($articles->title) ?></td>
                            <td><?= h($articles->hits) ?></td>
                            <td><?= h($articles->status) ?></td>
                            <td><?= date('d M Y', strtotime($articles->publish_on)); ?></td>
                            <td class="px-3">
<div class="dropdown">
  <button class="btn p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fas fa-bars text-primary"></i>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
	<?= $this->Html->link(__('<i class="fas fa-plus"></i> View'), ['action' => 'view', $articles->id, 'prefix' => false], ['class' => 'dropdown-item', 'escape' => false]) ?>
	<?= $this->Html->link(__('<i class="far fa-edit"></i> Edit'), ['action' => 'edit', $articles->id], ['class' => 'dropdown-item', 'escape' => false]) ?>
	<?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $articles->id], ['confirm' => __('Are you sure you want to delete # {0}?', $articles->id), 'class' => 'dropdown-item', 'escape' => false]) ?>
  </ul>
</div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
		</div>
</div>



    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->id) ?></h3>
            
            <div class="related">
                <h4><?= __('Related Announcements') ?></h4>
                <?php if (!empty($user->announcements)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Note') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Start Published') ?></th>
                            <th><?= __('End Published') ?></th>
                            <th><?= __('Hits') ?></th>
                            <th><?= __('Slug') ?></th>
                            <th><?= __('Retention Date') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Cipta') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->announcements as $announcements) : ?>
                        <tr>
                            <td><?= h($announcements->id) ?></td>
                            <td><?= h($announcements->user_id) ?></td>
                            <td><?= h($announcements->title) ?></td>
                            <td><?= h($announcements->note) ?></td>
                            <td><?= h($announcements->status) ?></td>
                            <td><?= h($announcements->start_published) ?></td>
                            <td><?= h($announcements->end_published) ?></td>
                            <td><?= h($announcements->hits) ?></td>
                            <td><?= h($announcements->slug) ?></td>
                            <td><?= h($announcements->retention_date) ?></td>
                            <td><?= h($announcements->created) ?></td>
                            <td><?= h($announcements->cipta) ?></td>
                            <td><?= h($announcements->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Announcements', 'action' => 'view', $announcements->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Announcements', 'action' => 'edit', $announcements->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Announcements', 'action' => 'delete', $announcements->id], ['confirm' => __('Are you sure you want to delete # {0}?', $announcements->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Contacts') ?></h4>
                <?php if (!empty($user->contacts)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Ticket') ?></th>
                            <th><?= __('Subject') ?></th>
                            <th><?= __('Category') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Notes') ?></th>
                            <th><?= __('Note Admin') ?></th>
                            <th><?= __('Ip') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Respond Date Time') ?></th>
                            <th><?= __('Slug') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->contacts as $contacts) : ?>
                        <tr>
                            <td><?= h($contacts->id) ?></td>
                            <td><?= h($contacts->user_id) ?></td>
                            <td><?= h($contacts->ticket) ?></td>
                            <td><?= h($contacts->subject) ?></td>
                            <td><?= h($contacts->category) ?></td>
                            <td><?= h($contacts->name) ?></td>
                            <td><?= h($contacts->email) ?></td>
                            <td><?= h($contacts->notes) ?></td>
                            <td><?= h($contacts->note_admin) ?></td>
                            <td><?= h($contacts->ip) ?></td>
                            <td><?= h($contacts->status) ?></td>
                            <td><?= h($contacts->respond_date_time) ?></td>
                            <td><?= h($contacts->slug) ?></td>
                            <td><?= h($contacts->created) ?></td>
                            <td><?= h($contacts->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Contacts', 'action' => 'view', $contacts->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Contacts', 'action' => 'edit', $contacts->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Contacts', 'action' => 'delete', $contacts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $contacts->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Emails') ?></h4>
                <?php if (!empty($user->emails)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Recipient') ?></th>
                            <th><?= __('Cc') ?></th>
                            <th><?= __('From Name') ?></th>
                            <th><?= __('From Email') ?></th>
                            <th><?= __('Subject') ?></th>
                            <th><?= __('Message') ?></th>
                            <th><?= __('Is Email Sent') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Retention Date') ?></th>
                            <th><?= __('Action On') ?></th>
                            <th><?= __('Action By') ?></th>
                            <th><?= __('Email Track Status') ?></th>
                            <th><?= __('Email Track Code') ?></th>
                            <th><?= __('Email Track Open') ?></th>
                            <th><?= __('Email Track Ip') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->emails as $emails) : ?>
                        <tr>
                            <td><?= h($emails->id) ?></td>
                            <td><?= h($emails->user_id) ?></td>
                            <td><?= h($emails->recipient) ?></td>
                            <td><?= h($emails->cc) ?></td>
                            <td><?= h($emails->from_name) ?></td>
                            <td><?= h($emails->from_email) ?></td>
                            <td><?= h($emails->subject) ?></td>
                            <td><?= h($emails->message) ?></td>
                            <td><?= h($emails->is_email_sent) ?></td>
                            <td><?= h($emails->status) ?></td>
                            <td><?= h($emails->retention_date) ?></td>
                            <td><?= h($emails->action_on) ?></td>
                            <td><?= h($emails->action_by) ?></td>
                            <td><?= h($emails->email_track_status) ?></td>
                            <td><?= h($emails->email_track_code) ?></td>
                            <td><?= h($emails->email_track_open) ?></td>
                            <td><?= h($emails->email_track_ip) ?></td>
                            <td><?= h($emails->created) ?></td>
                            <td><?= h($emails->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Emails', 'action' => 'view', $emails->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Emails', 'action' => 'edit', $emails->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Emails', 'action' => 'delete', $emails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $emails->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Recipients') ?></h4>
                <?php if (!empty($user->recipients)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Fullname') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->recipients as $recipients) : ?>
                        <tr>
                            <td><?= h($recipients->id) ?></td>
                            <td><?= h($recipients->user_id) ?></td>
                            <td><?= h($recipients->fullname) ?></td>
                            <td><?= h($recipients->email) ?></td>
                            <td><?= h($recipients->status) ?></td>
                            <td><?= h($recipients->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Recipients', 'action' => 'view', $recipients->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Recipients', 'action' => 'edit', $recipients->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Recipients', 'action' => 'delete', $recipients->id], ['confirm' => __('Are you sure you want to delete # {0}?', $recipients->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related User Email Recipients') ?></h4>
                <?php if (!empty($user->user_email_recipients)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Email Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Username') ?></th>
                            <th><?= __('Email') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->user_email_recipients as $userEmailRecipients) : ?>
                        <tr>
                            <td><?= h($userEmailRecipients->id) ?></td>
                            <td><?= h($userEmailRecipients->user_email_id) ?></td>
                            <td><?= h($userEmailRecipients->user_id) ?></td>
                            <td><?= h($userEmailRecipients->username) ?></td>
                            <td><?= h($userEmailRecipients->email) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'UserEmailRecipients', 'action' => 'view', $userEmailRecipients->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'UserEmailRecipients', 'action' => 'edit', $userEmailRecipients->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserEmailRecipients', 'action' => 'delete', $userEmailRecipients->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userEmailRecipients->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related User Emails') ?></h4>
                <?php if (!empty($user->user_emails)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Recipient') ?></th>
                            <th><?= __('Cc') ?></th>
                            <th><?= __('From Name') ?></th>
                            <th><?= __('From Email') ?></th>
                            <th><?= __('Subject') ?></th>
                            <th><?= __('Message') ?></th>
                            <th><?= __('Is Email Sent') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Retention Date') ?></th>
                            <th><?= __('Action On') ?></th>
                            <th><?= __('Action By') ?></th>
                            <th><?= __('Email Track Status') ?></th>
                            <th><?= __('Email Track Code') ?></th>
                            <th><?= __('Email Track Open') ?></th>
                            <th><?= __('Email Track Ip') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->user_emails as $userEmails) : ?>
                        <tr>
                            <td><?= h($userEmails->id) ?></td>
                            <td><?= h($userEmails->user_id) ?></td>
                            <td><?= h($userEmails->recipient) ?></td>
                            <td><?= h($userEmails->cc) ?></td>
                            <td><?= h($userEmails->from_name) ?></td>
                            <td><?= h($userEmails->from_email) ?></td>
                            <td><?= h($userEmails->subject) ?></td>
                            <td><?= h($userEmails->message) ?></td>
                            <td><?= h($userEmails->is_email_sent) ?></td>
                            <td><?= h($userEmails->status) ?></td>
                            <td><?= h($userEmails->retention_date) ?></td>
                            <td><?= h($userEmails->action_on) ?></td>
                            <td><?= h($userEmails->action_by) ?></td>
                            <td><?= h($userEmails->email_track_status) ?></td>
                            <td><?= h($userEmails->email_track_code) ?></td>
                            <td><?= h($userEmails->email_track_open) ?></td>
                            <td><?= h($userEmails->email_track_ip) ?></td>
                            <td><?= h($userEmails->created) ?></td>
                            <td><?= h($userEmails->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'UserEmails', 'action' => 'view', $userEmails->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'UserEmails', 'action' => 'edit', $userEmails->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserEmails', 'action' => 'delete', $userEmails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userEmails->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related User Logs') ?></h4>
                <?php if (!empty($user->user_logs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Action') ?></th>
                            <th><?= __('Useragent') ?></th>
                            <th><?= __('Os') ?></th>
                            <th><?= __('Ip') ?></th>
                            <th><?= __('Host') ?></th>
                            <th><?= __('Referrer') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->user_logs as $userLogs) : ?>
                        <tr>
                            <td><?= h($userLogs->id) ?></td>
                            <td><?= h($userLogs->user_id) ?></td>
                            <td><?= h($userLogs->action) ?></td>
                            <td><?= h($userLogs->useragent) ?></td>
                            <td><?= h($userLogs->os) ?></td>
                            <td><?= h($userLogs->ip) ?></td>
                            <td><?= h($userLogs->host) ?></td>
                            <td><?= h($userLogs->referrer) ?></td>
                            <td><?= h($userLogs->status) ?></td>
                            <td><?= h($userLogs->created) ?></td>
                            <td><?= h($userLogs->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'UserLogs', 'action' => 'view', $userLogs->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'UserLogs', 'action' => 'edit', $userLogs->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserLogs', 'action' => 'delete', $userLogs->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userLogs->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
