<!--
// please do not use " or ' characters in the click_for_live_support variable or it
// will produce errors and PHP Live! will not function properly
var click_for_live_support = "Click for Live Support" ;


// copyright OSI Codes, PHP Live! Support
// http://www.osicodesinc.com
function dounique() { var date = new Date() ; return date.getTime() ; }
var chatwindow_loaded = 0 ;
var popblock_action_id = 1 ;
var tracker_refresh = 10000 ; // 1000 = 1 second
var btn = 9308196 ;
var do_tracker_flag_9308196 = 1 ;
var start_tracker = dounique() ;
var time_elapsed ;
var refer = escape( document.referrer ) ;
var phplive_base_url = 'https://www.webhostgalaxy.com' ;
var initiate = chat_opened = 0 ;
var pullimage_9308196 = new Image ;
var date = new Date() ;
var unique = dounique() ;
var chat_width = 450 ;
var chat_height = 360 ;
var url = escape( location.toString() ) ;
var phplive_image_9308196 = "https://www.webhostgalaxy.com/image.php?l=0&x=0&deptid=0&pagex="+url+"&unique="+unique+"&refer="+refer+"&text=" ;


var scriptpad = "" ;
var ns=(document.layers);
var ie=(document.all);
var w3=(document.getElementById && !ie);

/********************************************/
/***** proactive image settings: begin ******/
var ProactiveDiv ;
var browser_width ;
var backtrack = 0 ;
var isclosed = 0 ;
var repeat = 1 ;
var timer = 20 ;
var halt = 0 ;

// browser detection
var browser_ua = navigator.userAgent.toLowerCase() ;
var browser_type, tempdata ;
function phplive_detect_ua( text )
{
	stringposition = browser_ua.indexOf(text) + 1 ;
	tempdata = text ;
	return stringposition ;
}

if (  phplive_detect_ua( "firefox" ) )
{
	chat_width = 461 ;
	chat_height = 360 ;
}

// write external style here.. it won't work if we put it directly in the DIV
style = "<style type=\"text/css\">" ;
style += "<!--" ;
style += "#ProactiveSupport_9308196 {visibility:hidden; position:absolute; height:1; width:1; top:0; left:0;}" ;
style += "-->" ;
style += "</style>" ;
document.write( style ) ;
if (ie||w3)
	browser_width = document.body.offsetWidth ;
else
	browser_width = window.outerWidth ;

function toggleMotion( flag )
{
	if ( flag )
		halt = 1 ;
	else
		halt = 0 ;
}

function initializeProactive_9308196()
{

	if(!ns && !ie && !w3) return ;
	if(ie)		ProactiveDiv = eval('document.all.ProactiveSupport_9308196.style') ;
	else if(ns)	ProactiveDiv = eval('document.layers["ProactiveSupport_9308196"]') ;
	else if(w3)	ProactiveDiv = eval('document.getElementById("ProactiveSupport_9308196").style') ;

	if (ie||w3)
		ProactiveDiv.visibility = "visible" ;
	else
		ProactiveDiv.visibility = "show" ;

	backtrack = 0 ;
	isclosed = 0 ;
	repeat = 1 ;
	moveIt(20) ;
}

function moveIt( h )
{
	if (ie)
	{
		documentHeight = document.body.offsetHeight/2+document.body.scrollTop-20 ;
		documentWidth = document.body.offsetWidth ;
	}
	else if (ns)
	{
		documentHeight = window.innerHeight/2+window.pageYOffset-20 ;
		documentWidth = window.innerWidth ;
	}
	else if (w3)
	{
		documentHeight = self.innerHeight/2+window.pageYOffset-20 ;
		documentWidth = self.innerWidth ;
	}
	ProactiveDiv.top = documentHeight-100 ;
	ProactiveDiv.left = documentWidth/2 ; // mod

	ProactiveDiv.left = h ;
	if ( h > ( browser_width - 350 ) )
		backtrack = 1 ;
	if ( backtrack && repeat && !halt )
		h -= 2 ;
	else if ( !backtrack && repeat && !halt )
		h += 2 ;

	if ( halt )
	{
		setTimeout("moveIt("+h+")",timer) ;
	}
	else if ( ( !backtrack || ( backtrack && ( h >= 20 ) ) ) && ( ( ProactiveDiv.visibility == "visible" ) || ( ProactiveDiv.visibility == "show" ) ) && repeat && !isclosed )
		setTimeout("moveIt("+h+")",timer) ;
	else if ( !isclosed )
	{
		backtrack = 0 ;
		repeat = 0 ;
		setTimeout("moveIt("+h+")",timer) ;
	}
	else
	{
		// incase it is closed during when it's off the page, set the position
		// back to the page so the horizontal scrollbars disappear (IE only)
		ProactiveDiv.left = h ;
	}
}

function DoClose(){
	if (ie||w3)
		ProactiveDiv.visibility = "hidden" ;
	else
		ProactiveDiv.visibility = "hide" ;
	isclosed = 1 ;
	halt = 0 ;
}

/********************************************/
/********************************************/


function checkinitiate_9308196()
{
	initiate = pullimage_9308196.width ;
	if ( ( initiate == 2 ) && !chat_opened )
	{
		chat_opened = 1 ;
		popblock_action_id = 2 ;
		launch_support_9308196() ;
	}
	else if ( ( initiate == 3 ) && !chat_opened )
	{
		chat_opened = 1 ;
		initializeProactive_9308196() ;
	}
	else if ( initiate == 100 )
	{
		do_tracker_flag_9308196 = 0 ;
	}

	if ( ( initiate == 1 ) && chat_opened )
		chat_opened = 0 ;
}
function do_tracker_9308196()
{
	// check to make sure they are not idle for more then 1 hour... if so, then
	// they left window open and let's stop the tracker to save server load time.
	// (1000 = 1 second)
	var unique = dounique() ;
	time_elapsed = unique - start_tracker ;
	if ( time_elapsed > 3600000 )
		do_tracker_flag_9308196 = 0 ;

	pullimage_9308196 = new Image ;
	pullimage_9308196.src = "https://www.webhostgalaxy.com/image_tracker.php?l=0&x=0&deptid=0&pagex="+url+"&unique="+unique ;

	pullimage_9308196.onload = checkinitiate_9308196 ;
	if ( do_tracker_flag_9308196 == 1 )
		setTimeout("do_tracker_9308196()",tracker_refresh) ;
}

function start_timer_9308196( c )
{
	if ( c == 0 )
	{
		if ( !chatwindow_loaded && ( popblock_action_id == 1 ) )
			alert( "Popup blocker prevented the loading of the chat window.  Please press <SHIFT> while clicking the chat image." ) ;
		else if ( !chatwindow_loaded && ( popblock_action_id == 2 ) )
		{
			NotifyPopupBlocker_9308196() ;
			chat_opened = 1 ;
			popblock_action_id = 1 ;
			initializeProactive_9308196() ;
		}
		else
			chatwindow_loaded = 0 ;
	}
	else
	{
		--c ;
		var temp = setTimeout( "start_timer_9308196("+c+")", 1000 ) ;
	}
}

function launch_support_9308196()
{
	start_timer_9308196( 2 ) ;
	var request_url_9308196 = "https://www.webhostgalaxy.com/request.php?l=0&x=0&deptid=0&pagex="+url ;
	var newwin_chat = window.open( request_url_9308196, unique, 'scrollbars=no,menubar=no,resizable=0,location=no,screenX=50,screenY=100,width='+chat_width+',height='+chat_height+'' ) ;
	if ( newwin_chat )
	{
		newwin_chat.focus() ;
		DoClose() ;
		chatwindow_loaded = 1 ;
	}
}

function WriteChatDiv()
{
	var scroll_image = new Image ;
	scroll_image.src = "https://www.webhostgalaxy.com/scroll_image.php?x=0&l=0&"+unique ;

	output = "<div id=\"ProactiveSupport_9308196\">" ;
	output += "<table cellspacing=0 cellpadding=0 border=0>" ;
	output += "<tr><td align=right><table cellspacing=0 cellpadding=0 border=0><tr><td bgColor=#E1E1E1><a href='JavaScript:RejectInitiate();' OnMouseOver=\"toggleMotion(1)\" OnMouseOut=\"toggleMotion(0)\"><font color=#828282 size=1 face=arial>&nbsp;close window</font>&nbsp;<img src=\"https://www.webhostgalaxy.com/images/initiate_close.gif\" width=10 height=10 border=0></a></td></tr></table></td></tr>" ;
	output += "<tr><td align=center>" ;
	output += "<a href=\"JavaScript:launch_support_9308196()\" OnMouseOver=\"toggleMotion(1)\" OnMouseOut=\"toggleMotion(0)\"><img src=\""+scroll_image.src+"\" border=0></a>" ;
	output += "</td></tr></table>" ;
	output += "</div>" ;
	document.writeln( output ) ;

	if(ie)		ProactiveDiv = eval('document.all.ProactiveSupport_9308196.style') ;
	else if(ns)	ProactiveDiv = eval('document.layers["ProactiveSupport_9308196"]') ;
	else if(w3)	ProactiveDiv = eval('document.getElementById("ProactiveSupport_9308196").style') ;

	if (ie||w3)
		ProactiveDiv.visibility = "hidden" ;
	else
		ProactiveDiv.visibility = "hide" ;
}

function RejectInitiate()
{
	var rejectimage_9308196 = new Image ;
	rejectimage_9308196.src = "https://www.webhostgalaxy.com/image_tracker.php?l=0&x=0&deptid=0&unique="+unique+"&action=reject" ;
	DoClose() ;
	chat_opened = 0 ;
}

function NotifyPopupBlocker_9308196()
{
	var notifyimage_9308196 = new Image ;
	notifyimage_9308196.src = "https://www.webhostgalaxy.com/image_tracker.php?l=0&x=0&deptid=0&unique="+unique+"&action=notifypopup" ;
}

var status_image_9308196_0 = "<a href='JavaScript:void(0)' onMouseOver='window.status=\""+click_for_live_support+"\"; return true;' onMouseOut='window.status=\"\"; return true;' OnClick='launch_support_9308196()'><img src="+phplive_image_9308196+" border=0 alt='"+click_for_live_support+"' title='"+click_for_live_support+"'></a>" ;
document.write( status_image_9308196_0 ) ;

if ( !phplive_loaded )
{
	WriteChatDiv() ;
	do_tracker_9308196() ;
}
var phplive_loaded = 1 ;
//-->