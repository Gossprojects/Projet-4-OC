(function($) {

	var deleteBtns = document.getElementsByClassName('deleteBtn');

	function askConfirm() {

		if(confirm("Êtes-vous sûr de vouloir supprimer cet élément ?") == true) {
			return true;
		}
		else
			return false;
	}

	if(deleteBtns) {
		for(var i = 0; i < deleteBtns.length; i++) {

			deleteBtns[i].onclick = askConfirm;
		}
	}

})(jQuery);