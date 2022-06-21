function dragOver(e){
		e.preventDefault();
}
	
function drop(e){
	e.preventDefault();
	var data = e.dataTransfer.getData("data");
	
	window.location = "download.php?image_id="+data;
}

function drag(e){
	e.dataTransfer.setData("data", e.target.id);
}
