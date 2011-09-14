key('e', 'main', function(){
	window.location = window.location.href + "?edit=page";
	return false;
});

if(key.getScope() !== 'edit'){
	key.setScope('main');
}