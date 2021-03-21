
/*General Functions*/
(function($) {
	//Device detection
	if(Browser.platform==='android'||Browser.platform==='ios'){
		document.html.addClass('touch');
	}else document.html.addClass('no-touch');

	document.html.addClass(Browser.name.toLowerCase());
	document.html.addClass('v'+Browser.version);
	document.html.addClass(Browser.platform.toLowerCase());

	var initialWidth = window.getSize().x,
		devClass = '',
		rawClass = '';

	if(initialWidth>639&&initialWidth<960) devClass = 'tablet';
	else if(initialWidth>959) devClass = 'desktop';
	else devClass = 'mobile';

	document.html.addClass(devClass);
	document.html.addClass('w-'+Math.round(initialWidth)+'px');

	//Reset on resize
	window.addEvent('resize',function(){
		if(resizeTO) clearTimeout(resizeTO);
		var resizeTO = setTimeout(function(){
			//DEBUG console.info('applying resets...');
			if(initialWidth!=this.getSize().x) {
				initialWidth = this.getSize().x;
				if(initialWidth>639&&initialWidth<960) devClass = 'tablet';
				else if(initialWidth>959) devClass = 'desktop';
				else devClass = 'mobile';
				document.html
					.removeClass('desktop')
					.removeClass('tablet')
					.removeClass('mobile')
					.addClass(devClass);
				rawClass = document.html.get('class');
				document.html.set('class',rawClass.replace(/w-.*px/,'w-'+Math.round(initialWidth)+'px'));
			}
		},500);
	});

	//Reset on orientation change
	var mql = window.matchMedia("(orientation: portrait)");
	var prevOrientation = '';
	if(mql.matches) prevOrientation = 'portrait';
	else prevOrientation = 'landscape';
	mql.addListener(function(m) {
		if(m.matches){
			if(prevOrientation=='landscape'){
				if(initialWidth!==window.getSize().x){
					//DEBUG console.info('changed to portait');
					prevOrientation = 'portrait';
					if(initialWidth>639) devClass = 'tablet';
					else if(initialWidth>959) devClass = 'desktop';
					else devClass = 'mobile';
					document.html
						.removeClass('desktop')
						.removeClass('tablet')
						.removeClass('mobile')
						.addClass(devClass);
					rawClass = document.html.get('class');
					document.html.set('class',rawClass.replace(/w-.*px/, 'w-'+Math.round(window.getSize().x)+'px'));
				}
			}
		}else{
			if(prevOrientation=='portrait'){
				if(initialWidth!==window.getSize().x){
					//DEBUG console.info('changed to landscape');
					prevOrientation = 'landscape';
					if(initialWidth>639) devClass = 'tablet';
					else if(initialWidth>959) devClass = 'desktop';
					else devClass = 'mobile';
					document.html
						.removeClass('desktop')
						.removeClass('tablet')
						.removeClass('mobile')
						.addClass(devClass);
					rawClass = document.html.get('class');
					document.html.set('class',rawClass.replace(/w-.*px/, 'w-'+Math.round(window.getSize().x)+'px'));
				}
			}
		}
	});
	
})(document.id);

