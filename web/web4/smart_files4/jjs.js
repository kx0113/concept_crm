// JavaScript Document
$(function($){
	var _m=3;//��ҳ����
	var $showPic=$("#bannerShow li");
	var $smallPic=$("#bannerRoll li");
	var $btonPicL=$("#bannerBtonL");
	var $btonPicR=$("#bannerBtonR");
	var _imgLen=$showPic.length;
/*	if(_imgLen==0){alert("NoImages");return false;}*/
	var lastLen=_imgLen%_m==0?_m:_imgLen%_m;
	var timer;
	var _n=0;
	var _time=3000;
	var b=(_imgLen-lastLen)*($smallPic.width());
	//��ť�¼�
	$btonPicL.click(function(){
		clearInterval(timer);
		if(_n==0){
			_n=_imgLen-1;
			$("#bannerRoll").stop(true,true).animate({
						left:'-'+b+'px'
					});	
		}else if(_n%_m==0){
			_n=_n-1;
			$("#bannerRoll").stop(true,true).animate({
						left:'+='+_m*$smallPic.width()+'px'
					});	
		}else{
			_n=_n-1;
		}
		showImg(_n);
		timer=setInterval(auto,_time);
	});
	$btonPicR.click(function(){
		clearInterval(timer);
		if(_n==_imgLen-1){
			_n=0;
			$("#bannerRoll").stop(true,true).animate({
						left:'0px'
					});	
		}else{
			_n=_n+1;
			rollList(_n-1);	
		}
		showImg(_n);
		timer=setInterval(auto,_time);
	});
	//����¼�
	$showPic.hover(function(){
			clearInterval(timer);
		},function(){
			timer=setInterval(auto,_time);
		});
	$smallPic.each(function(e){
			$(this).hover(function(){
					clearInterval(timer)
					showImg(e);
				},function(){
					_n=e;
					timer=setInterval(auto,_time);
					});
		})
	//��������
	var rollList=function(n){
		if(n==_imgLen-1){
			$("#bannerRoll").stop(true,true).animate({
						left:'0px'
					});
			}else if((n+1)%_m==0&&n!=0){
				$("#bannerRoll").stop(true,true).animate({
						left:'-='+$smallPic.width()*_m +'px'
					});
				}
	}
	//ͼƬ�ֻ�
	var showImg= function(n){
		$showPic.stop(true,true).eq(n).fadeIn(1000).siblings().fadeOut(1000);
		$smallPic.eq(n).addClass("up").siblings("li").removeClass("up");
	}
	//auto
	var auto=function(){
				_n++;
				rollList(_n-1);	
				if(_n==_imgLen){_n=0;}
				showImg(_n)
			}
	timer=setInterval(auto,_time);
	showImg(_n);
});

var ulRoll= function(id,dir,vt){
	var ScrollBox=document.getElementById(id);//��������ڵ����
	if(!ScrollBox) return false;
	var OldContent=ScrollBox.getElementsByTagName("ul")[0];//UL index=0;
	if(!OldContent) return false;
	var domeOne=ScrollBox.getElementsByTagName("li");// li
	if(!domeOne.length) return false;
	var domeOneLen = domeOne.length;
	var OldLong=0;//���ܳ�
	var NewLong=0;//���ܳ�-����ܳ���
	var NewContent=OldContent.innerHTML;
	if(dir=="1"){
		for(var i=0;i<domeOneLen;i++){
			OldLong+=domeOne[i].offsetWidth;
		}
		while(NewLong<(ScrollBox.offsetWidth)){	
			NewContent+=OldContent.innerHTML;
			NewLong+=OldLong;
			}
	}else if(dir=="2"){
		for(var i=0;i<domeOneLen;i++){
			OldLong+=domeOne[i].offsetHeight;
		}
		while(NewLong<(ScrollBox.offsetHeight)){	
			NewContent+=OldContent.innerHTML;
			NewLong+=OldLong;
			}
	}//�ж���UL���ܳ�
	OldContent.innerHTML=NewContent;//�����µ�Ul
	var domeTwo= ScrollBox.getElementsByTagName("li")[domeOneLen];//��������λ��
	var myRoll = function(){
		if(dir=="1"){
			if(ScrollBox.scrollLeft == domeTwo.offsetLeft){
				ScrollBox.scrollLeft=0;
				}else{
					ScrollBox.scrollLeft++;
				}
			}else if(dir=="2"){
				if(ScrollBox.scrollTop >= domeTwo.offsetTop){
					ScrollBox.scrollTop=0;
				}else{
					ScrollBox.scrollTop++;
				}
			}
		}//����
	var timer = setInterval(myRoll,vt);//�����Ե��ù���
	ScrollBox.onmouseover=function(){clearInterval(timer)}
	ScrollBox.onmouseout=function(){timer=setInterval(myRoll,vt)}
}// id=������ڵ����id ,������ʽdir=1��2 �ֱ��Ӧ�� ��,vt�����ٶȣ�