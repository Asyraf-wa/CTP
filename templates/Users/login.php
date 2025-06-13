<?php echo $this->Html->css('animate.min'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Morphext/2.4.4/morphext.css" integrity="sha256-iwSnUqgAndMlZnwFWAAzto9R/6Un2RBguZEITMb0Olk=" crossorigin="anonymous" />
<style>
	.form-control--otp {
		line-height: 2.5;
		height: 3.5rem;
		font-size: 1.5rem;
		font-weight: bold;
		text-align: center;
		padding-left: 0.5rem;
		padding-right: 0.5rem;
	}

	@media (min-width: 375px) {
		.form-control--otp {
			line-height: 3;
			height: 4.5rem;
			font-size: 2rem;
			font-weight: bold;
			text-align: center;
			max-width: 3.5rem;
		}
	}
</style>

<div class="mx-auto my-auto p-2 col-md-4">
	<div class="card bg-body-tertiary border-0 shadow mb-4">
		<div class="card-body">
			<div class="my-4 text-center">
				<h1 class="my-0 page_title">OTP verification</h1>
				<?php $email = isset($_GET['email']) ? $_GET['email'] : ''; ?>
				Please enter the one time password to verify your account<br />
				A code has been sent to <?= $email ?>
				<div id="countdown" class="countdown-timer"></div>
				<script>
					function startCountdown(duration, display) {
						let timer = duration,
							minutes, seconds;
						const interval = setInterval(() => {
							minutes = parseInt(timer / 60, 10);
							seconds = parseInt(timer % 60, 10);

							minutes = minutes < 10 ? "0" + minutes : minutes;
							seconds = seconds < 10 ? "0" + seconds : seconds;

							display.textContent = minutes + ":" + seconds;

							if (--timer < 0) {
								clearInterval(interval);
								display.textContent = "EXPIRED";
								document.querySelector('form').querySelectorAll('input, button').forEach(el => el.disabled = true);
								const redirectLink = document.createElement('a');
								redirectLink.href = "<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'auth']); ?>";
								redirectLink.textContent = "Click here to re-authenticate";
								display.appendChild(document.createElement('br'));
								display.appendChild(redirectLink);
							}
						}, 1000);
					}

					window.onload = function() {
						const threeMinutes = 60 * 3,
							display = document.querySelector('#countdown');
						startCountdown(threeMinutes, display);
					};
				</script>
			</div>
			<div class="tricolor_line mb-3"></div>
			<?= $this->Form->create() ?>
			<?php
			$email = isset($_GET['email']) ? $_GET['email'] : '';
			echo $this->Form->hidden('email', [
				'required' => true,
				'class' => 'form-control border-0',
				'autocomplete' => 'off',
				'value' => $email,
				'readonly' => true,
			]);
			?>
			<?php //echo $this->Form->control('email', ['required' => true, 'class' => 'form-control border-0', 'autocomplete' => 'off']) 
			?>
			<div class="otp-input justify-content-center d-flex">
				<?php for ($i = 1; $i <= 6; $i++): ?>
					<input type="text" id="password-<?= $i ?>" maxlength="1" class="form-control border-1 text-center rounded-0 form-control--otp" style="width: 60px;" required pattern="\d*">
				<?php endfor; ?>
				<input type="hidden" name="password" id="password" required>
			</div>
			<script>
				document.querySelectorAll('.otp-input input[type="text"]').forEach((input, index, inputs) => {
					input.addEventListener('input', () => {
						if (!/^\d$/.test(input.value)) {
							input.value = '';
							input.focus();
							return;
						}
						if (input.value.length === 1 && index < inputs.length - 1) {
							inputs[index + 1].focus();
						}
						let password = '';
						inputs.forEach(input => password += input.value);
						document.getElementById('password').value = password;

						if (index === inputs.length - 1 && input.value.length === 1) {
							document.querySelector('form').submit();
						}
					});
					input.addEventListener('keydown', (e) => {
						if (e.key === 'Backspace' && input.value.length === 0 && index > 0) {
							inputs[index - 1].focus();
						}
					});
					input.addEventListener('input', () => {
						input.value = input.value.replace(/\D/, '');
					});
					input.addEventListener('focus', () => {
						input.select();
					});
				});

				document.querySelector('.otp-input').addEventListener('paste', (e) => {
					const paste = (e.clipboardData || window.clipboardData).getData('text');
					const pasteArray = paste.split('').filter(char => /\d/.test(char));
					if (pasteArray.length === 6) {
						document.querySelectorAll('.otp-input input[type="text"]').forEach((input, index) => {
							input.value = pasteArray[index] || '';
						});
						let password = '';
						document.querySelectorAll('.otp-input input[type="text"]').forEach(input => password += input.value);
						document.getElementById('password').value = password;
						e.preventDefault();
						document.querySelector('form').submit();
					}
				});

				document.querySelector('form').addEventListener('submit', () => {
					let password = '';
					document.querySelectorAll('.otp-input input[type="text"]').forEach(input => password += input.value);
					document.getElementById('password').value = password;
				});
			</script>
			<?= $this->Form->end() ?>

			<hr>
			<div id="supported" align="center">
				<b class="gradient-animate-tiny"><b class="logo-small">&lt;/&gt;</b> <?php echo $system_abbr; ?></b>
				&nbsp;&nbsp;&nbsp;
				<?php echo $this->Html->link($this->Html->image(
					'ctp.png',
					array('alt' => 'Code The Pixel', 'class' => 'gambar',  'width' => '78px', 'height' => '22px')
				) . '' . (''), 'https://codethepixel.com', array('target' => 'blank', 'escape' => false)); ?>
				&nbsp;&nbsp;&nbsp;
				<?php echo $this->Html->link($this->Html->image(
					'github.png',
					array('alt' => 'Github', 'class' => 'gambar',  'width' => '78px', 'height' => '22px')
				) . '' . (''), 'https://github.com/', array('target' => 'blank', 'escape' => false)); ?>
				&nbsp;&nbsp;&nbsp;
				<?php echo $this->Html->link($this->Html->image(
					'gitlab.png',
					array('alt' => 'GitLab', 'class' => 'gambar',  'width' => '78px', 'height' => '22px')
				) . '' . (''), 'https://gitlab.com/', array('target' => 'blank', 'escape' => false)); ?>
			</div>

			<br />
			<div class="">
				<p class="text-center">
					Leading The CRUD Evolution<br>
					<?= $system_name; ?> (<?= $system_abbr; ?>)<br>
					<SCRIPT LANGUAGE="JavaScript">
						today = new Date();
						y0 = today.getFullYear();
					</SCRIPT>
					Copyright &copy; 2022-<SCRIPT LANGUAGE="JavaScript">
						document.write(y0);
					</SCRIPT> <?= $system_abbr; ?>. All rights reserved. [V <?= $version; ?>] <br>
					<br>
				</p>
			</div>

		</div>
	</div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/Morphext/2.4.4/morphext.min.js" integrity="sha256-qG3zvg7/f5CZHwV8IeaQfBY5Hm+M0KR3PMk9lAHp39s=" crossorigin="anonymous"></script>
<script>
	$("#js-rotating").Morphext({
		animation: "fadeInDown",
		complete: function() {
			console.log("This is called after a phrase is animated in! Current phrase index: " + this.index);
		}
	});
</script>