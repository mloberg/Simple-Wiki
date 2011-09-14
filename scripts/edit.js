document.getElementsByTagName("textarea")[0].focus();

key('command+s,ctrl+s', 'edit', function(){
	document.getElementById("submit").click();
	return false;
});
key('tab', 'edit', function(){
	var input = document.getElementsByTagName("textarea")[0];
	var value = input.value;
	var start = input.value.length;
	var end = start;
	if(input.selectionStart !== undefined){
		start = input.selectionStart;
		end = input.selectionEnd;
	}else if(document.selection !== undefined){
		value = value.split('\r').join('');
		start = end = value.length;
		var range = document.selection.createRange();
		if(range.parentElement() === input){
			var start = -range.moveStart('character', -10000000);
			var end = -range.moveEnd('character', -10000000);
			range.moveToElementText(input);
			var error = -range.moveStart('character', -10000000);
			start-= error;
			end-= error;
		}
	}
	input.value = value.substring(0, start) + "\t" + value.substring(end);
	if(input.setSelectionRange !== undefined){
		input.focus();
		input.setSelectionRange(start + 1, end + 1);
	}else if(input.createTextRange !== undefined){
		var range = input.createTextRange();
		range.collapse(true);
		range.moveStart('character', start + 1);
		range.moveEnd('character', end + 1);
		range.select();
	}
	return false;
});

key.setScope('edit');

function deletePage(){
	if(confirm("Are you sure you want to delete this page?")){
		document.forms["delete"].submit();
	}
}