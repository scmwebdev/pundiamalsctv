// popup image
function openFile(strFrm,strId,strMod){
	var newWind=window.open("/incs/popfile.php?idFrm="+strFrm+"&idField="+strId+"&mod="+strMod,"lookinpop","height=200,width=400,left=150,top=100,directories=no,toolbar=no,menubar=no,scrollbars=yes,location=relative; top:-3px");
}