String.prototype.trim=function() {  
    return this.replace(/(^\s*)|(\s*$)/g,'');  
};
function form_validate(form,initlimit,mustChange){
	var mustChange = (typeof mustChange==='undefined')?true:(!!mustChange);
	if(document.getElementById('name')){
		var value = document.getElementById('name').value;
		if (value.indexOf('admin')!=-1 || value.indexOf('管理员')!=-1) {
			return [false,'您的昵称有歧义！'];
		};
	}
	var change = false;
	var length = form.elements.length;
	for (var i = 0; i < length; i++) {
		var elem=form.elements[i];
		if(!elem.getAttribute('required')) continue;
		limit = initlimit || 's,1';
		if(!!elem.dataset && !!elem.dataset.limit)
			limit = elem.dataset.limit;
		limit = limit.split(',');
		if(!isFilled(elem, limit)){
			return [false,elem.getAttribute('placeholder')];
		}
		if(elem.value != elem.defaultValue){
			change = true;//这里可以用数字，change+=1;来统计个数
		}
	}
	if(mustChange && !change){
		return [false,'您没有输入任何内容。'];
	}
	return [true,''];
}
function isFilled(elem, limit){
	var min = true;
	switch(limit[0]){
		case 's':
			var length = elem.value.trim().length;
			if(!!limit[1]){
				min = length >= limit[1];
				if (min && !!limit[2]) {
					return min && length <= limit[2]
				}
				return min;
			}
			return length > 0;
			break;
		case 'i':
			var value = '';
			value = elem.value = parseInt(elem.value);
			if(!!limit[1]){
				min = value >= limit[1];
				if (min && !!limit[2]) {
					return min && value <= limit[2]
				}
				return min;
			}
			break;
		default:
			return true;
	}
}