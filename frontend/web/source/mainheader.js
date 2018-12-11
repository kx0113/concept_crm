	var t = n = 0, count;
	$(document).ready(function(){	
		count=$("#mainheader_list span").length;
		$("#mainheader_list span:not(:first-child)").hide();
		$("#mainheader_info").html($("#mainheader_list span:first-child").find("img").attr('alt'));
		$("#mainheader li").click(function() {
			var i = $(this).text() - 1;
			n = i;
			if (i >= count) return;
			$("#mainheader_info").html($("#mainheader_list span").eq(i).find("img").attr('alt'));
			$("#mainheader_list span").filter(":visible").fadeOut(500).parent().children().eq(i).fadeIn(1000);
			document.getElementById("mainheader").style.background="";
			$(this).toggleClass("on");
			$(this).siblings().removeAttr("class");
		});
		t = setInterval("showAuto()", 8000);
		$("#mainheader").hover(function(){clearInterval(t)}, function(){t = setInterval("showAuto()", 8000);});
	})
	
	function showAuto()
	{
		n = n >=(count - 1) ? 0 : ++n;
		$("#mainheader li").eq(n).trigger('click');
	}