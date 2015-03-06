

function doCommand(com, grid) {
	if(com == 'Edit'){
		$('.trSelected', grid).each(function(){
			var id = $(this).attr('id');
			id = id.substring(id.lastIndexOf('row')+(3));
			alert("Edit row " + id);
		})
	}
	if(com == 'Delete'){
		$('.trSelected', grid).each(function(){
			var id = $(this).attr('id');
			id = id.substring(id.lastIndexOf('row')+(3));
			alert("Delete row " + id);
		})
	}
}