$(document).ready(function(){

	$.ajax({
		url:'http://php.weather.sina.com.cn/iframe/index/w_cl.php?code=js&day=0&dfc=1&charset=utf-8',
		dataType:'script',
		scriptCharset:'utf-8',
		success:function(){
			if (SWther.add.error==0) {
				for(var k in SWther.w){
					var wea = SWther.w[k][0];
					wea['city'] = k;	
				}
				for(var k in SWther.add){
					wea[k] = SWther.add[k];	
				}
			};

			var now = new Date();

			if (now.getHours()>17||now.getHours()<6) {
				wea.s = wea.s2;
				wea.d = wea.d2;
				wea.p = wea.p2;
				wea.img = 'http://php.weather.sina.com.cn/images/yb3/78_78/'+wea.f2+'_1.png';
			}else{
				wea.s = wea.s1;
				wea.d = wea.d1;
				wea.p = wea.p1;
				wea.img = 'http://php.weather.sina.com.cn/images/yb3/78_78/'+wea.f1+'_0.png';
			}

			$('.wea_city').html(wea.city);
			$('.wea_s').html(wea.s);
			$('.wea_t').html(function(){
				return wea.t2+' ~ '+wea.t1+$('.wea_t').html();
			});
			$('.wea_w').html(function(){
				return wea.d+' '+wea.p+$(this).html();
			});
			$('.wea_img').attr('src',wea.img);


		}
	});

	
	
});