var menuTabs = document.getElementsByClassName('menuTab');

for(var i = 0; i < menuTabs.length; i++) {

	if(menuTabs[i].childNodes[0].innerText.toLowerCase() == current.toLowerCase()) {
		menuTabs[i].classList.add('current');
	}
	else if(menuTabs[i].childNodes[0].classList.contains('current')) {
		menuTabs[i].remove('current');
	}
}
