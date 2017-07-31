var getDataUrl = "http://127.0.0.1/fileViewer/controller/getContents.php";
$( document ).ready(function() {
	bindClickToGetFile();
});
function bindClickToGetFile() {
	$("#showFile").click(function() {
                firstPage();
        });
}
function firstPage(){
	var pos = 0;
	var type = "first";
	getData(type);
}
function prevPage(){
        var type = "prev";
        getData(type);
}
function nextPage(){
        var type = "next";
        getData(type);
}
function lastPage(){
        var type = "last";
        getData(type);
}
function getData(type,pos){
	var postData = {};
	postData['path'] = $('#fileInput').val(); 
	postData['type'] = type;
	postData['page'] = $('#page').val();
	$.ajax({
		type: 'POST',
		url: getDataUrl,
		data: postData,
		dataType: "json",
		success:displayAndSaveData,
		error:displayError
	});
}
function displayError() {
	alert("some error occured");
}
function displayAndSaveData(data) {
	if(data['status']) {
		displayPageContent(data['content']['lines']);
		$('#page').val(data['content']['newPage']);
	}
	else{
		displayError();
	}
}
function displayPageContent(content){
	var htmlCont = '';
	for(var i=0;i<content.length;i++){
		htmlCont += content[i]['lineNo'] +"    "+ content[i]['line']+"<br />";
	}
	console.log(htmlCont);
	$('#cont').html(htmlCont);
}
