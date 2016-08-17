<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link href="https://cdn.quilljs.com/1.0.0-beta.11/quill.snow.css" rel="stylesheet">
	<script src="https://cdn.quilljs.com/1.0.0-beta.11/quill.js"></script>
	<link rel="stylesheet" type="text/css" href="{$css}" />
	<script src='moment.min.js'></script>
	<script src='reply.js'></script>
</head>
<body>
	<div class = 'mailHead'>
		<p><span class = 'vars'>Subject:</span><span><b>{$subject}</b></span></p>
		<p><span class = 'vars'>From:</span><span>{$from}</span></p>
		<p><span class = 'vars'>Date:</span><span id='now'>{$date}</span></p>
		<p><span class = 'vars'>To:</span><span>{$to}</span></p>
		{$cc}
		<form action='reply_post.php' method='post' enctype='multipart/form-data'>
			<p id='attachments'><span class = 'vars'>Attachments:</span><span id='attach-names'></span></p>
			<span id='attach-container'></span>
			<input type="hidden" name="id" value='{$id}' />
			<input type="hidden" name="key" value='{$key}' />
			<input type="hidden" name="index" value='{$index}' />
			<input type="hidden" name="reply" value='{$reply}' />
		</form>
		<p class='options'><span class = 'vars'>Options:</span>
			<span id='print-page'><a href="#" onclick='window.print()'>Print This Page</a></span>
			<span id='add-attach'><a href="#" onclick="addAttach()">Add Attachment</a></span>
			<span id='remove-attach'><a href="#" onclick="removeAttach()">Remove Attachments</a></span>
			<span><a href="#" onclick="send();">Send</a></span>
		</p>
	</div>
	<div class='mailBody'>
		<span class = "mailMessage"></span>
		<input type="hidden" id="message" value='{$message}'/>
	
		<!-- Create the editor container -->
		<div id="editor"></div>
	</div>
</body>
</html>