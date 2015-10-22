<html>
<head>
	<meta charset="utf-8">
	<link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href="CSS/mainStyles.css" rel="stylesheet" type="text/css" />
	<link href="CSS/filterStyles.css" rel="stylesheet" type="text/css" />
</head>
<body>			
<div id="_div_BBR_IFR">
	<p>
	Filter Options
	</p>
	
	<div id="_div_FTR_BOX">
	Filter by Text:
	<p>
	<input name="INP_TXT" id="_inp_TXT_2">
	</div>
	
	<div id="_div_FTR_BOX">
	Filter by Date Added (DD/MM/YYYY):
	<p>
	<input type="text" name="INP_DD" id="_inp_TXT_DATE" maxlength="2" size="2">
	
	<input type="text" name="INP_MM" id="_inp_TXT_DATE" maxlength="2" size="2">
	
	<input type="text" name="INP_YY" id="_inp_TXT_DATE" maxlength="4" size="4">
	</div>
	
	<div id="_div_FTR_BOX">
	Filter by Color Tag:<p>
	
	<div name="INP_COL" class="_N_SEL" id="_inp_TAG_RED"  onclick="tagColSet('0',this)"></div>
	<div name="INP_COL" class="_N_SEL" id="_inp_TAG_ORANGE" onclick="tagColSet('1',this)"></div>
	<div name="INP_COL" class="_N_SEL" id="_inp_TAG_YELLOW" onclick="tagColSet('2',this)"></div>
	<div name="INP_COL" class="_N_SEL" id="_inp_TAG_GREEN" onclick="tagColSet('3',this)"></div>
	<div name="INP_COL" class="_N_SEL" id="_inp_TAG_AQUA" onclick="tagColSet('4',this)"></div>
	<div name="INP_COL" class="_N_SEL" id="_inp_TAG_NAVY" onclick="tagColSet('5',this)"></div>
	<div name="INP_COL" class="_N_SEL" id="_inp_TAG_PURPLE" onclick="tagColSet('6',this)"></div>
	<div name="INP_COL" class="_N_SEL" id="_inp_TAG_PINK" onclick="tagColSet('7',this)"></div>
	<div name="INP_COL" class="_SEL" id="_inp_TAG_NONE" onclick="tagColSet('8',this)"></div>
	<br><br>
	</div>
	
	<div id="_div_FTR_BOX">
	Filter by File Type:
	<p>
	<img name="INP_FLE" class="_N_SEL" id="_div_FLE_IMG_INP" src="images/F_picture.fw.png" onclick="tagFleTyp('PIC',this)">
	<img name="INP_FLE" class="_N_SEL" id="_div_FLE_IMG_INP" src="images/F_text.fw.png" onclick="tagFleTyp('TXT',this)">
	<img name="INP_FLE" class="_N_SEL" id="_div_FLE_IMG_INP" src="images/F_video.fw.png" onclick="tagFleTyp('VID',this)">
	<img name="INP_FLE" class="_N_SEL" id="_div_FLE_IMG_INP" src="images/F_music.fw.png" onclick="tagFleTyp('MSC',this)">
	<img name="INP_FLE" class="_N_SEL" id="_div_FLE_IMG_INP" src="images/F_unknown.fw.png" onclick="tagFleTyp('UNK',this)">
	<img name="INP_FLE" class="_SEL" id="_div_FLE_IMG_INP" src="" onclick="tagFleTyp('NNE',this)">
	<br><br>
	</div>
	
	<input id="_inp_BTN_2" type="submit" onclick="filterFiles()" value="Filter">  <input id="_inp_BTN_2" type="submit" onclick="flushFilters()" value="Reset">
	</div>
</body>

<script>
var commonFileID = "dsadasddsad";
var filterDD = "";
var filterMM = "";
var filterYYYY = "";
var filterCOL = "8";
var filterTXT = "";
var filterFLE = "NNE";
//onclick="mouseOverThisThing()"
 function mouseOverThisThing() { 
	window.alert(commonFileID);
 }
 
 function tagColSet(col,item) { 
	for (i = 0; i <= 8; i ++) {
		document.getElementsByName("INP_COL")[i].className = "_N_SEL";
	}
	filterCOL = col;
	item.className = '_SEL';
 }
 
 function tagFleTyp(fle,item) { 
	
	for (i = 0; i <= 5; i ++) {
		document.getElementsByName("INP_FLE")[i].className = "_N_SEL";
	}
	filterFLE = fle;
	item.className = '_SEL';
 }
 
 function filterFiles() { 
	filterDD = document.getElementsByName("INP_DD")[0].value;
	filterMM = document.getElementsByName("INP_MM")[0].value;
	filterYYYY = document.getElementsByName("INP_YY")[0].value;
	filterTXT = document.getElementsByName("INP_TXT")[0].value;
	parent.sendParameters(filterDD,filterMM,filterYYYY,filterTXT,filterFLE,filterCOL);
 }
 
 function flushFilters() { 
	filterDD = "";
	filterMM = "";
	filterYYYY = "";
	filterCOL = "8";
	filterTXT = "";
	filterFLE = "NNE";
	for (i = 0; i <= 5; i ++) {
		document.getElementsByName("INP_FLE")[i].className = "_N_SEL";
	}
	
	document.getElementsByName("INP_FLE")[5].className = "_SEL";
	
	for (i = 0; i <= 8; i ++) {
		document.getElementsByName("INP_COL")[i].className = "_N_SEL";
	}
	
	document.getElementsByName("INP_COL")[8].className = "_SEL";
	
	document.getElementsByName("INP_DD")[0].value = "";
	document.getElementsByName("INP_MM")[0].value = "";
	document.getElementsByName("INP_YY")[0].value = "";
	document.getElementsByName("INP_TXT")[0].value = "";
	parent.sendParameters(filterDD,filterMM,filterYYYY,filterTXT,filterFLE,filterCOL);
 }
</script>