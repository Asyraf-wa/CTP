<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>

<div class="position-fixed top-0 end-0 p-3" style="z-index: 1021" id="toastbtn">
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header bg-danger text-light">
    <strong class="me-auto">Error</strong>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    <?= $message ?>
  </div>
</div>
</div>

<script>
	window.onload = (event) => {
		let myAlert = document.querySelector('.toast');
		let bsAlert = new bootstrap.Toast(myAlert);
		bsAlert.show();
	}
</script>