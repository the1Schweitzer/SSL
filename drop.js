function dragEnter() {
	return false;
};

function dragOver() {
	return false;
};

function drop(e) {
	filereader(e.dataTransfer.files,this);
	return false;
};
function filereader(files,obj){
	var reader=new FileReader();
	reader.readAsText(files[0]);
	reader.onload = function (e) {
		obj.value=reader.result;
		obj.onchange();
	}
	reader.onerror=function(){alert("error");}
	reader.onabort=function(){alert("abort");}
}
function acceptDrop(obj){
	obj.ondragenter=dragEnter;
	obj.ondragover=dragOver;
	obj.ondrop=drop;
}