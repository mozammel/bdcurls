<!DOCTYPE html>
<html lang"en">
<head>
<title>BDCyclists URL Shortener</title>
<link rel="stylesheet" href="/assets/css/styles.css" />

</head>

<script>
function selectText(element) {
    var doc = document;
    var text = doc.getElementById(element);    

    if (doc.body.createTextRange) { // ms
        var range = doc.body.createTextRange();
        range.moveToElementText(text);
        range.select();
    } else if (window.getSelection) { // moz, opera, webkit
        var selection = window.getSelection();            
        var range = doc.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
    }
}
</script>

<body onload="selectText('selectme')">
	<div id="container">
		<h2 align="center">BDCyclists URL Shortener</h2>

		@if(Session::has('errors'))
			<h3 class="error">{{$errors->first('link')}}</h3>
			<h3 class="error">{{$errors->first('alias')}}</h3>
		@endif

		@if(Session::has('message'))
			<h3 class="error">{{Session::get('message')}}</h3>
		@endif

		@if(Session::has('link'))
			<div id="selectme">
				<!--- Html::link throws error in php 5.3, using alternative to it with URL::to -->
				<h3 id="result" class="success">{{URL::to('/'.Session::get('link'))}}</h3>
			</div>
			<h4 class="copymsg"><small>Press Ctrl+C or Cmd+C to copy to clipboard</small></h4>

		@endif

		{{Form::open(array('url'=>'/','method'=>'post'))}}
			{{Form::text('link',Input::old('link'),array('placeholder'=>'Paste the URL you want to shorten and hit enter', 'autofocus'=>'autofocus'))}}

		<div id="alias">
			{{Form::text('alias',Input::old('alias'),array('placeholder'=>'alias (optional)'))}}
		</div>
		<div id="submit">
			{{Form::submit('Submit')}}
		</div>
		{{Form::close()}}
	</div>



</body>


</html>