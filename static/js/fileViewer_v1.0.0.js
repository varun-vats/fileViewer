//var getDataUrl = "http://127.0.0.1/fileViewer/controller/getContents.php";
$( document ).ready(function() {
	bindClickToGetFile();
	$('#fileInput').bind("enterKey",function(e)	{
		changePage("first");
	});
	$('#fileInput').keyup(function(e){
		if(e.keyCode == 13)
	{
		$(this).trigger("enterKey");
	}
	});
});

function bindClickToGetFile() {
	$("#showFile").click(function() {
		changePage("first");
	});
}
function changePage(type){
	var postData = {};
	postData['path'] = $('#fileInput').val(); 
	if(!postData['path']) {
		displayErrMessage("Enter correct file path to continue ");
		return false;
	}
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
function displayError(errMsg) {
	if(!errMsg) {
		errMsg = "some  unknown error occured "
	}
	displayErrMessage(errMsg);
}
function displayAndSaveData(data) {
	if(data['status']) {
		displayPageContent(data['content']['lines']);
		$('#page').val(data['content']['newPage']);
		disableEnableButtons(data['content']['type'],data['content']['newPage']);
	}
	else{
		displayError(data['reason']);
	}
}
function disableEnableButtons(type,newPage) {
	if(newPage==1) {
		disable('first');
		disable('prev');
		enable("next");
		enable("last");
	}
	else if(type=="last"){
		disable('last');
		disable('next');
		enable("first");
                enable("prev");
	}
	else{
		enable("first");
		enable("prev");
		enable("next");
		enable("last");
	}
}
function enable(id){
	var changePage = 'changePage("'+id+'")'; 
	$('#'+id).attr('onClick',changePage);
	$('#'+id).css({'cursor' :"pointer"});
}
function disable(id) {
	$('#'+id).removeAttr('onclick');
	$('#'+id).css({'cursor' :"default"});
}
function displayPageContent(content){
	var htmlCont = '<table width="920px" align="center">';
	for(var i=0;i<content.length;i++){
		htmlCont += '<tr class="spaceUnder"><td bgcolor="#E8E8EE" align="center" width="60px">' + content[i]['lineNo'] +'</td> <td>'+content[i]['line']+'</td> </tr>' ;
	}
	htmlCont += '</table>';
	$('#cont').html(htmlCont);
}

function displayErrMessage(errMsg){
	var errHtml = "<p style='color:red;font-size:20px' align=center> "+errMsg+"</p>";
	$('#cont').html(errHtml);
}
