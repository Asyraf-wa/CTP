


<div class="container mt-1">
<div class="card mb-3 shadow module-blue-big border borderless mt-3">
	<div class="pt-3 pb-3 px-3 py-3 icon-robot2 icon-robot-tangan mt-0 text-light">Contact Message Details
		<div class=" text-light panel_subs"><?php echo $system_name; ?></div>
	</div>
		<div class="card-body bg-light border borderless">
<div class="row">
	<div class="col-md-5">
		<div class="table-responsive">
            <table class="table table-hover text-secondary px-1 table-sm">
                <tr>
                    <th><?= __('Ticket') ?></th>
                    <td><?= h($contact->ticket) ?></td>
                </tr>
                <tr>
                    <th><?= __('Subject') ?></th>
                    <td><?= h($contact->subject) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($contact->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($contact->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ip') ?></th>
                    <td><?= h($contact->ip) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td>
					<?php if ($contact->status == 1){
						echo '<i class="fas fa-circle text-success"></i>';
					}else
						echo '<i class="fas fa-circle text-danger"></i>';
					?>
					</td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($contact->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Respond Date Time') ?></th>
                    <td>
					<?php if ($contact->respond_date_time == NULL) {
						echo '-';
					}else
						echo date('d M Y  (g:i a)', strtotime($contact->respond_date_time));
					?>
					</td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= date('d M Y  (g:i a)', strtotime($contact->created)); ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= date('d M Y  (g:i a)', strtotime($contact->modified)); ?></td>
                </tr>
            </table>
			</div>
	</div>
	<div class="col-md-7 text-secondary">
            <div class="text">
                <strong><?= __('Notes from ') ?><?= h($contact->name) ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($contact->notes)); ?>
                </blockquote>
            </div>
			<hr>
            <div class="text">
                <strong><?= __('Reply from admin') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($contact->note_admin)); ?>
                </blockquote>
			<?= $this->Form->create($contact) ?>
            <fieldset>

					<?php echo $this->Form->hidden('email', ['class' => 'form-control','required' => false]); ?>
					<?php echo $this->Form->hidden('name', ['class' => 'form-control','required' => false]); ?>
					<?php echo $this->Form->hidden('ticket', ['class' => 'form-control','required' => false]); ?>

				
				<div class="form-group">
					<?php echo $this->Form->control('note_admin', ['class' => 'form-control ckeditor','required' => false,'label'=>false]); ?>
				</div>

				<div class="form-group">
					<?php echo $this->Form->hidden('status', ['class' => 'form-control','required' => false, 'value' => '1']); ?>
				</div>
				<?php $currDateTime = date("Y-m-d H:i:s"); ?>
				<div class="form-group">
					<?php echo $this->Form->hidden('respond_date_time', ['class' => 'form-control','required' => false, 'value' => $currDateTime]); ?>
				</div>
            </fieldset>
<div class="text-end">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-primary btn-flat btn-sm']) ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary btn-flat btn-sm']) ?>
				  <?= $this->Form->end() ?>
</div>
            </div>
	</div>
</div>



		</div>
</div>
</div>
