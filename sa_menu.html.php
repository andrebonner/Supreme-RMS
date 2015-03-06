
<script type="text/javascript">

//Initialize Arrow Side Menu:
ddaccordion.init({
	headerclass: "menuheaders", //Shared CSS class name of headers group
	contentclass: "menucontents", //Shared CSS class name of contents group
	revealtype: "clickgo", //Reveal content when user clicks or onmouseover the header? Valid value: "click", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["unselected", "selected"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["none", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: 500, //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

</script>

<style type="text/css">

.arrowsidemenu{
	width: 180px; /*width of menu*/
	border-style: solid solid none solid;
	border-color: #94AA74;
	border-size: 1px;
	border-width: 1px;
}
	
.arrowsidemenu div a{ /*header bar links*/
	font: bold 12px Verdana, Arial, Helvetica, sans-serif;
	display: block;
	background: transparent url(arrowgreen.gif) 100% 0;
  height: 24px; /*Set to height of bg image-padding within link (ie: 32px - 4px - 4px)*/
	padding: 4px 0 4px 10px;
	line-height: 24px; /*Set line-height of bg image-padding within link (ie: 32px - 4px - 4px)*/
	text-decoration: none;
}
	
.arrowsidemenu div a:link, .arrowsidemenu div a:visited{
	color: #26370A;
}

.arrowsidemenu div a:hover{
	background-position: 100% -32px;
}

.arrowsidemenu div.unselected a{ /*header that's currently not selected*/
	color: #6F3700;
}

	
.arrowsidemenu div.selected a{ /*header that's currently selected*/
	color: blue;
	background-position: 100% -64px !important;
}

.arrowsidemenu ul{
	list-style-type: none;
	margin: 0;
	padding: 0;
}

.arrowsidemenu ul li{
	border-bottom: 1px solid #a1c67b;
}


.arrowsidemenu ul li a{ /*sub menu links*/
	display: block;
	font: normal 12px Verdana, Arial, Helvetica, sans-serif;
	text-decoration: none;
	color: black;
	padding: 5px 0;
	padding-left: 10px;
	border-left: 10px double #a1c67b;
}

.arrowsidemenu ul li a:hover{
	background: #d5e5c1;
}

</style>

<body>

<div class="arrowsidemenu">

<div class="menuheaders"><a href="#" title="CSS">Prospecting</a></div>
	<ul class="menucontents">
	<li><a href="/svl/prospect_management?add">Add</a></li>
	<li><a href="/svl/prospect_management?search">Search</a></li>
	</ul>

	
	
	
	
<div class="menuheaders"><a href="#" title="Relocation">Relocation</a></div>
	<ul class="menucontents">
		<li><a href="/svl/relocation_management">Add</a></li>
		<li><a href="#">Search</a></li>
	</ul>
	
	
<div class="menuheaders"><a href="#" title="Relocation">Removal</a></div>
	<ul class="menucontents">
		<li><a href="#">Add</a></li>
		<li><a href="#">Search</a></li>
	</ul>
	
	
<div class="menuheaders"><a href="#" title="Reports">Reports</a></div>
	<ul class="menucontents">
		<li><a href="/svl/reports/performance_report">Performance </a></li>
		</ul>
	
	
	
<div class="menuheaders"><a href="#" title="Utilities">Utilities</a></div>
	<ul class="menucontents">
		<li><a href="/svl/application_types">Application Types</a></li>
		<li><a href="/svl/bdo_officers">BDO</a></li>
		<li><a href="/svl/business_analysis_results">Business Analysis</a></li>
		
		<li><a href= "/svl/business_registration_types">Registration types</a> </li>
		<li><a href= "/svl/cities">Cities</a> </li>
		<li><a href= "/svl/countries">Countries</a> </li>
		<li><a href= "/svl/csr_officers">CSRs</a> </li>
		<li><a href= "/svl/parish"> Parish </a> </li>
		<li><a href= "/svl/postal_code"> Postal codes </a> </li>
		<li><a href= "/svl/relocation_types"> Relocation Types </a></li>
		<li><a href= "/svl/security_provider"> Security Provider </a> </li>
		<li><a href= "/svl/status">Status</a> </li>
		<li><a href= "/svl/technical_service_provider">Technical Provider</a> </li>
		<li><a href= "/svl/business_trade_styles">Trade Styles</a> </li>
		<li><a href= "/svl/filestore"> File store </a> </li>
	
		
		
		
		
	</ul>
	
	
	
	
<div><a href= "/svl/users" title = "User Accounts"> User Accounts </a></div>




</div>

