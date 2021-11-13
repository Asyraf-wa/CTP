<?php

return [

    'errorClass' => 'form-control is-invalid', //vendor\cakephp\cakephp\src\View\Helper\FormHelper.php 
	//for 'errorClass', letak 'form-control is-invalid'
	
	'error' => '<div class="error-message text-danger"><small>{{content}}</small></div>',
	'formGroup' => '{{label}}{{input}}',
	'input' => '<input type="{{type}}" name="{{name}}"{{attrs}} class="form-control"/>', //ada placeholder auto, tapi masalah kalau tak nak pakai placeholder tu. susah nak buang. guna yg bawah kena letak manually placeholder.
	//'input' => '<input type="{{type}}" name="{{name}}"{{attrs}} class="form-control"/>',
	'inputContainer' => '<div class="mb-3">{{content}}</div>',
	//'inputContainer' => '{{content}}',
	'inputContainerError' => '<div class="mb-3 input {{type}}{{required}} is-invalid">{{content}}{{error}}</div>',
	//'label' => '<label for="floatingInput">{{text}}</label>',
	//'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}}>{{text}}</label>', //move label out from input
	//'select' => '<select class="form-select" name="{{name}}"{{attrs}}>{{content}}</select>', //ada simbol dropdown, tapi bila error xhighlight merah	
	'nestingLabel' => '{{hidden}}{{input}}<label{{attrs}} class="btn-check">{{text}}</label>',
	'radio' => '<input type="radio" name="{{name}}" class="btn-check" value="{{value}}" {{attrs}}>',  //letak ni kalau tak nak radio 'required' attributes: <?php echo $this->Form->create($article, ['type' => 'file', 'novalidate' => true]);

];

?>