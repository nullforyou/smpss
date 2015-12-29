function getprovince(rid,pid) {
	 $.ajax({
		url:'/ajax/getregion',
		data:'exce=1&parent_id='+rid,
		success:function(json) {
			for(i=0;i<json.length;i++) {
				if(json[i].region_id == pid) {
					var slt;
					slt = document.getElementById('province');
					slt.options.add(new Option(json[i].region_name,json[i].region_id));
					slt.options[slt.options.length-1].selected='selected';
				} else {
					slt = document.getElementById('province');
					slt.options.add(new Option(json[i].region_name,json[i].region_id));
				}
			}
		}
	 });
 }
function getcity(rid,cid) {
	 $.ajax({
		url:'/ajax/getregion',
		data:'parent_id='+rid,
		success:function(json) {
			document.getElementById('city').options.length = 0;
			document.getElementById('city').options.add(new Option('---请选择城市---',''));
			for(i=0;i<json.length;i++) {
				if(json[i].region_id == cid) {
					var slt;
					slt = document.getElementById('city');
					slt.options.add(new Option(json[i].region_name,json[i].region_id));
					slt.options[slt.options.length-1].selected='selected';
				} else {
					slt = document.getElementById('city');
					slt.options.add(new Option(json[i].region_name,json[i].region_id));
				}
			}
		}
	 });
}