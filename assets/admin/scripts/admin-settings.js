function themedev_copyTextData(FIledid){
	var FIledidData = document.querySelector("#"+FIledid);
	if(FIledidData){
		FIledidData.select();
		document.execCommand("copy");
	}
}

function themedev_show(dat){
	
	var target = event.getAttribute('nx-target');
	if(!target){
		return '';
	}
	
	var common = dat.getAttribute('nx-target-common');
	if(common){
		var commontDiv = document.querySelectorAll(target);
		if(commontDiv){
			for(var m = 0; m < commontDiv.length; m++){
				commontDiv[m].classList.remove('nx-show-target');
			}
		}
	}
	
	var targetDiv = document.querySelectorAll(target);
	if(targetDiv){
		for(var m = 0; m < targetDiv.length; m++){
			targetDiv[m].classList.toggle('nx-show-target');
		}
	}
}