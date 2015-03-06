

<script type="text/javascript">


ddaccordion.init({
	headerclass: "silverheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "mouseover", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: true, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "selected"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})


</script>


<style type="text/css">

.applemenu{
margin: 5px 0;
padding: 0;
width: 170px; /*width of menu*/
border: 1px solid #9A9A9A;
}

.applemenu div.silverheader a{
background: black url(silvergradient.gif) repeat-x center left;
font: normal 12px Tahoma, "Lucida Grande", "Trebuchet MS", Helvetica, sans-serif;
color: white;
display: block;
position: relative; /*To help in the anchoring of the ".statusicon" icon image*/
width: auto;
padding: 5px 0;
padding-left: 8px;
text-decoration: none;
}


.applemenu div.silverheader a:visited, .applemenu div.silverheader a:active{
color: white;
}


.applemenu div.selected a, .applemenu div.silverheader a:hover{
background-image: url(silvergradientover.gif);
color: white;
}

.applemenu div.submenu{ /*DIV that contains each sub menu*/
background: white;
padding: 5px;
height: 300px; /*Height that applies to all sub menu DIVs. A good idea when headers are toggled via "mouseover" instead of "click"*/
}

</style>

</head>

<body>

<div class="applemenu">

<div class="silverheader"><a href="#">Prospecting</a></div>
	
	<div class="submenu">
	
				<a href="/svl/prospect_management?add">Add </a><br/>
				<a href="/svl/prospect_management?search">Search </a>
		</div>
		
		

<div class="silverheader"><a href="#" >Relocation</a></div>
	<div class="submenu">
	<a href= "/svl/relocation_management">Relocation Management</a>	<br />
	</div>
	
	
<div class="silverheader"><a href="#">Removal</a></div>
	<div class="submenu">
	<a href= "/svl/removal_management">Removal Management</a>	
	</div>
	
	<div class="silverheader"><a href="#">Reports</a></div>
	<div class="submenu">
				
				<a href="/svl/reports/performance_report">Performance </a><br/>
				<a href="/svl/reports/technical_evaluations">Evaluations </a>
	</div>
	
	
	
<div class="silverheader"><a href="#">Utilities</a></div>
	<div class="submenu">
	<a href= "/svl/application_types">Application Types</a> <br/>
		<a href= "/svl/bdo_officers">BDOs</a> <br/>
		<a href= "/svl/business_analysis_results">Business Result</a> <br/>
		<a href= "/svl/business_registration_types">Registration types</a> <br/>
		<a href= "/svl/cities">Cities</a> <br/>
		<a href= "/svl/countries">Countries</a> <br/>
		<a href= "/svl/csr_officers">CSRs</a> <br/>
		<a href= "/svl/parish"> Parish </a> <br/>
		<a href= "/svl/postal_code"> Postal codes </a> <br/>
		<a href= "/svl/relocation_types"> Relocation Types </a>
		<a href= "/svl/security_provider"> Security Provider </a> <br/>
		<a href= "/svl/status">Status</a> <br/>
		<a href= "/svl/technical_service_provider">Technical Provider</a> <br/>
		<a href= "/svl/business_trade_styles">Trade Styles</a> <br/>
		<a href= "/svl/filestore"> File store </a> <br/>
	
	</div>
	
	
<div class="silverheader"><a href="#">Users</a></div>
	<div class="submenu">
	<a href= "/svl/users"> User Accounts </a>	
	</div>		
</div>
