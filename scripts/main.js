key('l', 'main', function(){
	window.location = document.getElementById("login").getAttribute("href");
	return false;
});
key('e', 'main', function(){
	window.location = window.location.href + "?edit=page";
	return false;
});
key('s', 'main', function(){
	window.location = window.location.href + "?edit=sidebar";
});
key('a', 'main', function(){
	window.location = window.location.href + "?add=page";
});

if(key.getScope() === 'all'){
	key.setScope('main');
}