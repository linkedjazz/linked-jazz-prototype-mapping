<?
	
	if (isset($_REQUEST['askWhy'])){
	
		header("content-type: text/plain");
		
		$_REQUEST['askWhy'] = str_replace("..",'',$_REQUEST['askWhy']);
		
 
		
		$_REQUEST['askWhy'] = urlencode($_REQUEST['askWhy']);
		
		$results = shell_exec('grep "' . $_REQUEST['askWhy'] . '" /var/www/data/allJazz.nt');
		echo $results;
		
		die();
		
		
	}
	
	
	if (isset($_REQUEST['dbpedia'])){		
		$dbp = $_REQUEST['dbpedia'];
		$loc = $_REQUEST['loc'];			
		
		$fh = fopen("/var/www/data/verified.nt", 'a') or die('error opening file');
		fwrite($fh, "<$dbp> <http://www.w3.org/2002/07/owl#sameAs> <$loc> .\n");		
		fclose($fh);
		
		
		die();
	}
	
	if (isset($_REQUEST['deldbpedia'])){
		
		$dbp = $_REQUEST['deldbpedia'];
 
		
		$fh = fopen("/var/www/data/deleted.nt", 'a') or die('error opening file');
		fwrite($fh, "<$dbp> <http://www.w3.org/2002/07/owl#sameAs> <none> .\n");		
		fclose($fh);
		 
		
		die();
	}	
	
	if (isset($_REQUEST['undeldbpedia'])){
		
		$dbp = $_REQUEST['undeldbpedia'];
 
		
		
		$removeLine = "<$dbp> <http://www.w3.org/2002/07/owl#sameAs> <none> .";		
		$results = shell_exec('grep -v "' . $removeLine . '" /var/www/data/deleted.nt> /var/www/data/deleted.tmp.nt');
		$results = shell_exec('mv /var/www/data/deleted.tmp.nt /var/www/data/deleted.nt');
		 
		  
		die();
	}		
	
	if (isset($_REQUEST['undbpedia'])){
		
		$dbp = $_REQUEST['undbpedia'];
		$loc = $_REQUEST['unloc'];		
		
		$removeLine = "<$dbp> <http://www.w3.org/2002/07/owl#sameAs> <$loc> .";		
		$results = shell_exec('grep -v "' . $removeLine . '" /var/www/data/verified.nt > /var/www/data/verified.tmp.nt');
		$results = shell_exec('mv /var/www/data/verified.tmp.nt /var/www/data/verified.nt');
		
		
		//echo 'grep -v "' . $removeLine . '" data/verified.txt > data/verified.tmp.txt';
		//echo 'mv data/verified.tmp.txt data/verified.txt';
		
		
		die();
	}	
	
	
	 



?>
<? header('Content-type: text/html; charset=utf-8'); ?>
<!doctype html>
<html>
<head>

  <meta charset="utf-8">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.  More info: h5bp.com/i/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title></title>
  <meta name="description" content="">

  <!-- Mobile viewport optimized: h5bp.com/viewport -->
  <meta name="viewport" content="width=device-width">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/font-awesome.css">
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="js/jquery.rdfquery.core.min-1.0.js"></script>  
    <script src="js/bootstrap.min.js"></script>  


 
 
	<style type="text/css">
	
		body{
			background-image:url(img/gplaypattern.png);
			background-repeat:repeat;
		}
	
	
		#logo{
			height:40px; width:auto; margin:2px; float:left;
			padding-right:25px;
			
		}
	
		.menuItem{
			height:40px;
			line-height:60px;
			font-size:14px;
			float:left;
			margin-right:10px;
			
			
			
		}
		
		.menuItem img{
			height:25px;
			width:25px;
			
		}
		
		.askWhy{
			border: solid 1px #CCC;
			font-family:"Courier New", Courier, monospace;
			font-size:12px;
			margin-top:10px;
			
		}

		
		.personListItem{

			width:98%;
 			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			margin:5px;
			padding:10px;
			border-radius: 10px;
			border: solid 1px #CCC;
			background-image:url(img/trans.png);
			background-repeat:repeat;
			position:relative;
			
			
			-webkit-transition: all 1s ease-in-out;
			-moz-transition: all 1s ease-in-out;
			-o-transition: all 1s ease-in-out;
			-ms-transition: all 1s ease-in-out;
			transition: all 1s ease-in-out;
 		 	
			
		}
		
		.personListItem:hover{
			border-color:#F00;
		}
				
		.personListItemTitle{
			font-size:18px;
			display:inline-block;
			overflow:hidden;
 			
		}
		.iconsToolsImg{
 			font-size:30px;
			top:0px;
			position:absolute;
			color:#999;
			cursor:pointer;
			opacity:0.55;
 
		}	
		.iconsToolsImg:hover{			
			opacity:1;
		}
		.iconsTools{
 			font-size:30px;
			top:14px;
			position:absolute;
			color:#999;
			cursor:pointer;
 
		}
		.iconsTools:hover{
			color:#333;
			
		}
		
		#contentDetailDisplay{
			position:fixed;
			min-height:400px;
			display:none; 
 			padding:10px;
			margin:5px;
			width:38%;
			border-radius: 10px;
			border: solid 1px #CCC;
			background-image:url(img/trans.png);
			background-repeat:repeat;			
			
			
		}
		
		#locDetails{
			font-family:"Courier New", Courier, monospace;
			font-size:12px;
			max-height:400px;
			overflow:auto;
			
			
		}
		#locDetails hr{
			margin:5px;
		}
		
		#overlay{
			height:1000px;
			width:100%;
			position:absolute;
			display:none;
			left:0px;
			top:0px;
			background-color:#333;
			opacity:0.5;
			z-index:999999;
			color:#FFF;
			font-size:76px;
			padding-top:100px;
			text-align:center;
			text-shadow: 5px 5px 3px #000;


			
		}
			
	 
	</style>
 
 
 
 
 
 
 	<script type="text/javascript">
	
	
		var dataFiles = [
							
							['verified.nt','verified'],
							['deleted.nt','deleted'],
							['sameAs_perfect.nt','sameAsPerfect'],
							['sameAs_high.nt','sameAsHigh'],
							['sameAs_medium.nt','sameAsMedium'],
							['sameAs_low.nt','sameAsLow'],
							['sameAs_none.nt','sameAsNone'],
							['sameAs_many.nt','sameAsMany'],
							['jazzData.nt','jazzData']
													
							 
							
						];
						
		var dataObjects = {};
	
		var peopleIndex = [];
		
		var detailTimer = null;
		
		var activeDataset = null
	
		//$.ajaxSetup({ cache: false });
	
		jQuery(document).ready(function($) {
			
 				$('#overlay').css('display','block');	
			
			 
				
				for (x in dataFiles){
					
					
					//$.get('/data/' + dataFiles[x][0], function(data) {
					$.ajax({ 
					url: '/data/' + dataFiles[x][0],
					type: "GET",
					dataType: "text",
					success: function(data) {
						//console.log('here',data);
						
						var filename = this.url.replace('/data/','');						
						for (x in dataFiles){if (dataFiles[x][0] == filename){ var dataName = dataFiles[x][1];  }}
					
						//give the UI some breathing room, a chance to render
						setTimeout(function(){
						 
							var tripleStore = $.rdf.databank([]);	  
				
							/***********
							* 	The file we are loading is expected to be a triple store in the format '<object> <predicate> <object> .\n'
							*   Note the space after the final object and the '.' and the \n only
							************/	  
							
							
							data = data.replace(/@EN/gi,'');
							var triples = data.split("\n");
							
							//rdf query is kind of out of date, cannot support this format.
							var counter = 0;
							
							//console.time('text spliting data');
							for (x in triples){			
								if (triples[x].length > 0){		
									try{
										
										
										counter=counter+1;
										tripleStore.add(triples[x]);
	 
										
									}
									catch(err){
										//if it cannot load one of the triples it is not a total failure, keep going
										console.log('There was an error processing the data file:');
										console.log(err);										
									}
								}
							}			
							//console.timeEnd('text spliting data');
							
	
							dataObjects[dataName] = tripleStore.dump();
							
 							
							
							if (dataName != 'verified' && dataName != 'jazzData' && dataName != 'deleted'){
							
								for (key in dataObjects['verified']){
									
									delete dataObjects[dataName][key];
									
								}
								
								for (key in dataObjects['deleted']){
									
									delete dataObjects[dataName][key];
									
								}								
								
							}
							
							
							
							
							//need to update the count and bind
							if ($("#" + dataName)){
								

								$("#" + dataName + ' a span').html('(' + numberWithCommas(Object.size(dataObjects[dataName])) + ')'); 
								
								$("#" + dataName + ' a').data("dataName",dataName);
								$("#" + dataName + ' a').click(function(event){
									
							 
									activeDataset = dataName;
						
									//reset 
									$(".menuItem a").each(function(index) {
										$(this).css("background-color","#fff");										 
									})
									
									
									$("#sameAsPerfect a").css("color","#08C");
									$("#sameAsHigh a").css("color","#090");
									$("#sameAsMedium a").css("color","#F60");
									$("#sameAsLow a").css("color","#900");
									$("#sameAsMany a").css("color","#C09");
									$("#sameAsNone a").css("color","#333");
									$("#verified a").css("color","#006");
									$("#deleted a").css("color","#F00");

									
									$(this).css("background-color",$(this).css("color"));
									$(this).css("color","#fff");									
									
									
									buildList($(this).data('dataName'));
							
									event.preventDefault();
									return false;									
									
								});
								
								
								
								
							}
							
							if (dataName == 'jazzData'){								
							
								$('#overlay').css('display','none');								
 							}
							 
						
						}, 500, [dataName]);
						
					}});
			  
				}
			
			

 
			$("#searchLink").click(function(){
				
				var value=prompt("Search For?","Search");
				if (value==null || value==""){
					return false;	
				}
				value=value.toLowerCase();
				
				if (dataObjects.hasOwnProperty('search')){
					delete 	dataObjects['search'];
				}
				
				dataObjects['search'] = {};
 				 
				var hits = {};
				//now look through all the jazzData and see if we get any hits
				for (key in dataObjects['jazzData']){
					
					
					for (key2 in dataObjects['jazzData'][key]){
					
						for (x in dataObjects['jazzData'][key][key2]){
							
							if ((dataObjects['jazzData'][key][key2][x].value + '').toLowerCase().search(value)!= -1 || key2.toLowerCase().search(value)!= -1){
								hits[key]=1;
								
							}
							
						}
						
						
					}			
					
					
				 
				}
 				
				
				for (key in dataObjects){
				
					if (key!='jazzData'){
					
						for (key2 in dataObjects[key]){
						
							if (hits.hasOwnProperty(key2)){
								//console.log(key2, dataObjects[key][key2]);
								dataObjects['search'][key2] = dataObjects[key][key2]
							}
							
						} 
						
					}					
				}
				
	
				$(".menuItem a").each(function(index) {
					$(this).css("background-color","#fff");										 
				})
				
				
				$("#sameAsPerfect a").css("color","#08C");
				$("#sameAsHigh a").css("color","#090");
				$("#sameAsMedium a").css("color","#F60");
				$("#sameAsLow a").css("color","#900");
				$("#sameAsMany a").css("color","#C09");
				$("#sameAsNone a").css("color","#333");
				$("#verified a").css("color","#006");
				$("#deleted a").css("color","#F00");
				
				activeDataset = 'search';
								
				buildList('search');
				
				
						
			});					
			
			 
			
		});
	
	
	
		
	
	
		//builds the content list
		function buildList(source){
			
 			peopleIndex = []


			
			if (typeof dataObjects[source] != "undefined"){
				
				
				 
 				
				//build array of the people
				for (x in dataObjects[source]){
				
				
					var person = {}
				 
					 
					person.dbpediaURI = x
					
					for (var key in dataObjects[source][x]){
						
						
						
						if (dataObjects[source][x][key].length==1){
						
							person.locURI = [];
							person.viafURI = [];							
						
							if (dataObjects[source][x][key][0].value.search('loc.gov')!=-1){
								person.locURI  = [dataObjects[source][x][key][0].value];		
							}
							if (dataObjects[source][x][key][0].value.search('viaf.org')!=-1){
								person.viafURI  = [dataObjects[source][x][key][0].value];		
							}							
						
							
							
						}else{
						
							person.locURI = [];
							person.viafURI = [];
							
							for (y in dataObjects[source][x][key]){
								
								if (dataObjects[source][x][key][0].value.search('loc.gov')!=-1){
 									person.locURI.push(dataObjects[source][x][key][y].value);
								}
								if (dataObjects[source][x][key][0].value.search('viaf.org')!=-1){
 									person.viafURI.push(dataObjects[source][x][key][y].value);		
								}							
															
								
							}
							
						}
					}
					
					
					
					if (dataObjects['jazzData'].hasOwnProperty(person.dbpediaURI)){
						

						if (dataObjects['jazzData'][person.dbpediaURI].hasOwnProperty('http://xmlns.com/foaf/0.1/name')){
							person.nameFull = 	dataObjects['jazzData'][person.dbpediaURI]['http://xmlns.com/foaf/0.1/name'][0].value;
 						}else{
							person.nameFull = "";							
						}
						
						var names = person.nameFull.split(' ');

						person.nameLastFirst = names[names.length-1];
						
						for(var i = 0; i <= names.length-2; i++){
							
							person.nameLastFirst = person.nameLastFirst + ' ' + names[i];
							
						}						
						

						if (dataObjects['jazzData'][person.dbpediaURI].hasOwnProperty('http://dbpedia.org/ontology/birthDate')){
							person.birthDate = 	dataObjects['jazzData'][person.dbpediaURI]['http://dbpedia.org/ontology/birthDate'][0].value.substring(0,4);
						}else{
							person.birthDate = "";							
						}	

						if (dataObjects['jazzData'][person.dbpediaURI].hasOwnProperty('http://dbpedia.org/ontology/deathDate')){
							person.deathDate = 	dataObjects['jazzData'][person.dbpediaURI]['http://dbpedia.org/ontology/deathDate'][0].value.substring(0,4);
						}else{
							person.deathDate = "";							
						}												
						
						if (dataObjects['jazzData'][person.dbpediaURI].hasOwnProperty('http://www.w3.org/2000/01/rdf-schema#comment')){
							person.comment = 	dataObjects['jazzData'][person.dbpediaURI]['http://www.w3.org/2000/01/rdf-schema#comment'][0].value;
						}else{
							person.comment = "";							
						}							
												
						if (dataObjects['jazzData'][person.dbpediaURI].hasOwnProperty('http://dbpedia.org/ontology/thumbnail')){
							person.image = 	dataObjects['jazzData'][person.dbpediaURI]['http://dbpedia.org/ontology/thumbnail'][0].value;
						}else{
							person.image = "";							
						}	
						
						if (dataObjects['jazzData'][person.dbpediaURI].hasOwnProperty('http://dbpedia.org/ontology/birthPlace')){
							
							person.birthPlace = "";	
							
 							
							for (bp in dataObjects['jazzData'][person.dbpediaURI]['http://dbpedia.org/ontology/birthPlace']){
								person.birthPlace = person.birthPlace + ' ' + dataObjects['jazzData'][person.dbpediaURI]['http://dbpedia.org/ontology/birthPlace'][bp].value;
							}
							
							 
						}else{
							person.birthPlace = "";							
						}							
												
						
						 
						
					}
					
					
					person.viafData  = {};
					
					for (viaf in person.viafURI){
						
						if(dataObjects['jazzData'].hasOwnProperty(person.viafURI[viaf])){
							
							
							person.viafData[person.viafURI[viaf]] = {};
						
							if (dataObjects['jazzData'][person.viafURI[viaf]].hasOwnProperty('http://xmlns.com/foaf/0.1/name')){
							
							
								person.viafData[person.viafURI[viaf]].foafName = [];	
								
								for (aFoaf in dataObjects['jazzData'][person.viafURI[viaf]]['http://xmlns.com/foaf/0.1/name']){									
									person.viafData[person.viafURI[viaf]].foafName.push(dataObjects['jazzData'][person.viafURI[viaf]]['http://xmlns.com/foaf/0.1/name'][aFoaf].value);									
								}
								
								
							}
						
							
						}
					}
					
					
					person.locData  = {};
					
					for (loc in person.locURI){
					
						 
						if (dataObjects['jazzData'].hasOwnProperty(person.locURI[loc])){
							
							person.locData[person.locURI[loc]] = {};
							
	
							if (dataObjects['jazzData'][person.locURI[loc]].hasOwnProperty('http://www.w3.org/2004/02/skos/core#altLabel')){
								
								person.locData[person.locURI[loc]].altLabel = [];	
								
								
								for (aAlt in dataObjects['jazzData'][person.locURI[loc]]['http://www.w3.org/2004/02/skos/core#altLabel']){
									person.locData[person.locURI[loc]].altLabel.push(dataObjects['jazzData'][person.locURI[loc]]['http://www.w3.org/2004/02/skos/core#altLabel'][aAlt].value);
								}
								
								 
							}else{
								person.locData[person.locURI[loc]].altLabel = [];						
							}							
							
							
							if (dataObjects['jazzData'][person.locURI[loc]].hasOwnProperty('http://www.w3.org/2004/02/skos/core#prefLabel')){
								
								person.locData[person.locURI[loc]].prefLabel = [];	
								
								
								for (aAlt in dataObjects['jazzData'][person.locURI[loc]]['http://www.w3.org/2004/02/skos/core#prefLabel']){
									person.locData[person.locURI[loc]].prefLabel.push(dataObjects['jazzData'][person.locURI[loc]]['http://www.w3.org/2004/02/skos/core#prefLabel'][aAlt].value);
								}
								
								 
							}else{
								person.locData[person.locURI[loc]].prefLabel = [];						
							}								
							
							
							
							
						}
						
							
					}
					//
					
					
					peopleIndex.push(person)
					
					
				}
				
				
				
				
			}


			$('#contentList').empty().hide();
			
 			
			//sort by lastname
			peopleIndex.sort(function(a,b) {

				 var nameA=a.nameLastFirst.toLowerCase(), nameB=b.nameLastFirst.toLowerCase()
				 if (nameA < nameB) //sort string ascending
				  return -1 
				 if (nameA > nameB)
				  return 1
				 return 0 //default return value (no sorting)
			});	
						
				
			 
 			
			
			for (x in peopleIndex){
				
				$('#contentList').append(
				
					$("<div>")
						.addClass('personListItem')
						.attr('id', 'person' + x)
						.data("dbpediaURI",	peopleIndex[x].dbpediaURI)
						.data("index",	x)
						.append(
							$("<div>")
								.addClass('personListItemTitle')
								.text(peopleIndex[x].nameFull)
								.css("width","200px")
								
						
						)
						.append(
							$("<div>")
								.addClass('personListItemTitle')
								.text(peopleIndex[x].birthDate + ' - ' + peopleIndex[x].deathDate)
								.css("width","100px")								
						
						)
						.append(
							$("<div>")
								.addClass('iconsToolsImg')
								.css("left","315px")
								.css("top","-2px")
								.data("dbpediaURI",	peopleIndex[x].dbpediaURI)
								.click(function(){window.open($(this).data("dbpediaURI"))})
								.attr("title","Goto DBPedia Page")								
								.append(
									$("<img>")
										.attr("src", "img/wikipedia.png")
										.css("height","40px")
										.css("width","auto")										
									 

								)
						)
						.append(
							$("<div>")
								.addClass('iconsToolsImg')
								.css("left","358px")
								.data("locURI",	peopleIndex[x].locURI)
								.css("opacity", function(){
								
									if ($(this).data("locURI").length!=1 || $(this).data("locURI")[0].search('/None') != -1){
										return "0.08";
									}else{
										return "auto";
									}
									
									
								})
								.css("cursor", function(){
								
									if ($(this).data("locURI").length!=1 || $(this).data("locURI")[0].search('/None') != -1){
										return "not-allowed";
									}else{
										return "pointer";
									}
									
									
								})								
								.click(function(){
								
									if ($(this).data("locURI").length==1 && $(this).data("locURI")[0].search('/None') == -1){
										window.open($(this).data("locURI")[0] + '.html')	
									}else{
										return false;
									}
									
									
								})							
 								.attr("title", function(){
								
									if ($(this).data("locURI").length!=1 || $(this).data("locURI")[0].search('/None') != -1){
										return '';
									}else{
										return "Goto LOC Page";
									}
									
									
								})																
								.append(
									$("<img>")
										.attr("src", "img/loc.png")
										.css("height","40px")
										.css("width","auto")

								)				 							
						)
						.append(
							$("<div>")
								.addClass('iconsToolsImg')
								.css("left","398px")
								.data("locURI",	peopleIndex[x].locURI)
								.data("viafURI",peopleIndex[x].viafURI)								
								.css("opacity", function(){
								
									if ($(this).data("locURI").length==1 || $(this).data("viafURI").length==1){
										return "auto";
									}else{
										return "0.08";
									}
									
									
								})
								.css("cursor", function(){
								
									if ($(this).data("locURI").length==1 || $(this).data("viafURI").length==1){
										return "pointer";
									}else{
										return "not-allowed";										
									}
									
									
								})								
								.click(function(){
									
									console.log($(this).data("viafURI"), $(this).data("locURI"));
								
									if ($(this).data("locURI").length==1 || $(this).data("viafURI").length==1){
										
										if ($(this).data("viafURI").length==1){
										
											window.open($(this).data("viafURI")[0])	
											
										}else{
											
											var locSplit = $(this).data("locURI")[0].split("/");
											
											window.open('http://viaf.org/viaf/sourceID/LC|' + locSplit[locSplit.length-1])												
											
										}
										
										
										
									}else{
										return false;
									}
									
									
								})							
 								.attr("title", function(){
								
									if ($(this).data("locURI").length!=1 || $(this).data("locURI")[0].search('/None') != -1 || $(this).data("viafURI").length!=1){
										return '';
									}else{
										return "Goto VIAF Page";
									}
									
									
								})																
								.append(
									$("<img>")
										.attr("src", "img/viaf.png")
										.css("height","40px")
										.css("width","auto")

								)				 							
						)						
						.append(
							$("<div>")
								.addClass('iconsTools')
								.css("left","440px")
								.data("dbpediaURI",	peopleIndex[x].dbpediaURI)
								.data("index",	x)
								.click(function(){
									
									askWhy($(this).data("dbpediaURI"),$(this).data("index"));
									
									
								})
								.attr("title","Why is this person in the Jazz Directory?")								
								.append(
									$("<i>")
										.addClass("icon-question-sign")
										.addClass("icon-large")

								)
						).append(
							$("<div>")
								.addClass('iconsTools')
								.css("left","480px")
								.data("dbpediaURI",	peopleIndex[x].dbpediaURI)
								.data("locURI",	peopleIndex[x].locURI)
								.data("index",	x)
								.click(function(){
									
									
									if (activeDataset != 'sameAsMany' && activeDataset != 'sameAsNone' && activeDataset != 'verified' && activeDataset != 'deleted'){									
										verified($(this).data("dbpediaURI"), $(this).data("locURI")[0], $(this).data("index"));
									}
									
									
									
								})
								.css("color", function(){
								
									if (activeDataset != 'sameAsMany' && activeDataset != 'sameAsNone' && activeDataset != 'verified' && activeDataset != 'deleted'){									
										return "auto";
									}else{
										return "whitesmoke";
									}
									
									
								})
								.css("cursor", function(){
								
									if (activeDataset != 'sameAsMany' && activeDataset != 'sameAsNone' && activeDataset != 'verified' && activeDataset != 'deleted'){									
										return "pointer";
									}else{
										return "not-allowed";
									}
																		
								})					
								.attr("title", function(){
								
 									if (activeDataset != 'sameAsMany' && activeDataset != 'sameAsNone' && activeDataset != 'verified' && activeDataset != 'deleted'){									
										return "This DBPedia -> LOC sameAa is correct!";
									}else{
										return "";
									}
																		
								})																
								.append(
									$("<i>")
										.addClass("icon-thumbs-up")
										.addClass("icon-large")

								)
						).append(
							$("<div>")
								.addClass('iconsTools')
								.css("left","520px")
								.data("dbpediaURI",	peopleIndex[x].dbpediaURI)
								.data("locURI",	peopleIndex[x].locURI)
								.data("index",	x)
								.click(function(){
									
									
									if (activeDataset == 'verified'){									
										unverified($(this).data("dbpediaURI"), $(this).data("locURI")[0], $(this).data("index"));
									}
									
									
									
								})
								.css("color", function(){
								
									if (activeDataset == 'verified'){									
										return "auto";
									}else{
										return "whitesmoke";
									}
									
									
								})
								.css("cursor", function(){
								
									if (activeDataset == 'verified'){									
										return "pointer";
									}else{
										return "not-allowed";
									}
																		
								})					
								.attr("title", function(){
								
 									if (activeDataset == 'verified'){									
										return "This DBPedia -> LOC sameAa is INCORRECT";
									}else{
										return "";
									}
																		
								})																
								.append(
									$("<i>")
										.addClass("icon-warning-sign")
										.addClass("icon-large")

								)
						).append(
							$("<div>")
								.addClass('iconsTools')
								.css("left","540px")
								.data("dbpediaURI",	peopleIndex[x].dbpediaURI)
								.data("locURI",	peopleIndex[x].locURI)
								.data("index",	x)
								.click(function(){
									
									
									if (activeDataset != 'deleted' && activeDataset != 'verified'){									
										markeDeleted($(this).data("dbpediaURI"), $(this).data("index"));
									}
									
									
									
								})
								.css("color", function(){
								
									if (activeDataset != 'deleted' &&  activeDataset != 'verified' ){									
										return "auto";
									}else{
										return "whitesmoke";
									}
									
									
								})
								.css("cursor", function(){
								
									if (activeDataset != 'deleted' && activeDataset != 'verified'){									
										return "pointer";
									}else{
										return "not-allowed";
									}
																		
								})					
								.attr("title", function(){
								
 									if (activeDataset != 'deleted' && activeDataset != 'verified'){									
										return "This indvidual should not be in the Jazz Directory";
									}else{
										return "";
									}
																		
								})																
								.append(
									$("<i>")
										.addClass("icon-trash")
										.addClass("icon-large")

								)
						).append(
							$("<div>")
								.addClass('iconsTools')
								.css("left","580px")
								.data("dbpediaURI",	peopleIndex[x].dbpediaURI)
								.data("locURI",	peopleIndex[x].locURI)
								.data("index",	x)
								.click(function(){
									
									
									if (activeDataset == 'deleted'){									
										unmarkeDeleted($(this).data("dbpediaURI"), $(this).data("index"));
									}
									
									
									
								})
								.css("color", function(){
								
									if (activeDataset == 'deleted' ){									
										return "auto";
									}else{
										return "whitesmoke";
									}
									
									
								})
								.css("cursor", function(){
								
									if (activeDataset == 'deleted'){									
										return "pointer";
									}else{
										return "not-allowed";
									}
																		
								})					
								.attr("title", function(){
								
 									if (activeDataset == 'deleted'){									
										return "This indvidual should be put back into the Directory";
									}else{
										return "";
									}
																		
								})																
								.append(
									$("<i>")
										.addClass("icon-bolt")
										.addClass("icon-large")

								)
						)						
							
							 
				
				
				
				);
				  
				
			}		
			
			$('.personListItem').mouseenter(function(){
			
			
				window.clearTimeout(detailTimer);
				
				index = $(this).data("index");
				
				detailTimer = window.setTimeout(showDetail,550,[index]); 
				
				
				
			});
			
			$('.personListItem').mouseleave(function(){
			
			
				window.clearTimeout(detailTimer);
				 
			});			
			
				
	
			
			
			$('#contentList').fadeIn(500);
			
		}
	

		function showDetail(index){
			
			$("#contentDetailDisplay").css("display","block");
			
 			
			$("#contentDetailDisplay").empty();
			
			$("#contentDetailDisplay").append(
					$("<div>")
						.text(peopleIndex[index].nameFull)
						.css("font-size","20px")				
				)
				.append(				
				$("<div>")
					.attr("id","contentDetailDisplayId")
					.append(
						$("<img>")
							.attr("src",function(){
								
								if (peopleIndex[index].image!=''){
									return 	peopleIndex[index].image;
								}else{
									return "img/trans.png";	
								}
									
							})	
							.css("width","150px")
							.css("height","auto")
							.css("float","left")
							.css("margin","0 4px 4px 0")
							.css("border","solid 1px #CCC")
					).append(
						$("<span>")
							.text(function(){
							
								var desc = peopleIndex[index].comment;
								var r = /\\u([\d\w]{4})/gi;
								desc = desc.replace(r, function (match, grp) {
									return String.fromCharCode(parseInt(grp, 16)); } );
								desc = unescape(desc); 
								var descText = decodeURIComponent(desc);
								descText = descText.replace(/&ndash;/gi,'-');
								descText = descText.replace(/&amp;/gi,'&');									
								
								return descText;
								
							})

					
					).append(
						$("<br>")									
					).append(
						$("<div>")
							.text(peopleIndex[index].birthPlace)					
					).append($("<hr>").css("clear","both")
					)
					
			
			
			);
			
			if (peopleIndex[index].locURI.length>0){
				
			
				$("#contentDetailDisplay").append(				
							$("<div>")
								.attr("id","locDetails")
								.append(
									$("<img>")
										.attr("src",'img/logo-loc.png')
										.css('width','75px')
										.css('height','auto')						
								)	
							)		
							
			}
			
			
			for (x in peopleIndex[index].locURI){
				
				if (peopleIndex[index].locData.hasOwnProperty(peopleIndex[index].locURI[x])){
					
					console.log(activeDataset);
					
					$("#locDetails")
						.append(
							$("<div>")
								.append(
									$("<a>")
										.attr("target","_blank")
										.attr("href",peopleIndex[index].locURI[x] + '.html')
										.text(peopleIndex[index].locURI[x])
										
								
								).append(
									$("<span>")
										.text(" | ")
										.css("display",function(){
											
											if (activeDataset == 'sameAsMany' || (activeDataset == 'search' && peopleIndex[index].locURI.length > 1)){
												return "inline";												
											}else{
												return "none";	
											}
											
										})										
								).append(
									$("<a>")										
 										.attr("href",peopleIndex[index].locURI[x] + '.html')
										.data("dbpediaURI",	peopleIndex[index].dbpediaURI)
										.data("locURI",	peopleIndex[index].locURI[x])
										.data("index",	index)
										.css("display",function(){
											
											if (activeDataset == 'sameAsMany' || (activeDataset == 'search' && peopleIndex[index].locURI.length > 1)){
												return "inline";												
											}else{
												return "none";	
											}
											
										})
										.attr("href","#")
										.click(function(event){
											
											 
											 
											verified($(this).data("dbpediaURI"), $(this).data("locURI"), $(this).data("index"));											
											
											event.preventDefault();
											return false;
											
										})
										.text("Use This URI")
										
								
								)
							
							
						)	
							
					
					for (y in peopleIndex[index].locData[peopleIndex[index].locURI[x]]){
					
					
						//wowwwwwwww....
						for (z in peopleIndex[index].locData[peopleIndex[index].locURI[x]][y]){
							
							$("#locDetails").append($("<div>").text(y + " | " + peopleIndex[index].locData[peopleIndex[index].locURI[x]][y][z]));							
						
							//console.log(peopleIndex[index].locURI[x], y, peopleIndex[index].locData[peopleIndex[index].locURI[x]][y][z]);	
							
								
							
						}
						
						
					}
					if (x<peopleIndex[index].locURI.length){
						$("#locDetails").append($("<hr>"));
					}
					
					
				}		
				
			}		
				
				
				
			if (peopleIndex[index].viafURI.length>0){
				
			
				$("#contentDetailDisplay").append(				
							$("<div>")
								.attr("id","viafDetails")
								.append(
									$("<img>")
										.attr("src",'img/viaf.png')
										.css('width','auto')
										.css('height','25px')						
								)	
							)	
							
								
							
			}				 
			
			console.log(peopleIndex[index])
			
			for (x in peopleIndex[index].viafURI){
				
				
				
				
				if (peopleIndex[index].viafData.hasOwnProperty(peopleIndex[index].viafURI[x])){
					
					
					$("#viafDetails")
						.append(
							$("<div>")
								.append(
									$("<a>")
										.attr("target","_blank")
										.attr("href",peopleIndex[index].viafURI[x])
										.text(peopleIndex[index].viafURI[x])
										
								
								).append(
									$("<span>")
										.text(" | ")
										.css("display",function(){
											
											if (activeDataset == 'sameAsMany' || activeDataset == 'search'){
												return "inline";												
											}else{
												return "none";	
											}
											
										})										
								).append(
									$("<a>")										
 										.attr("href",peopleIndex[index].viafURI[x] + '.html')
										.data("dbpediaURI",	peopleIndex[index].dbpediaURI)
										.data("locURI",	peopleIndex[index].viafURI[x])
										.data("index",	index)
										.css("display",function(){
											
											if (activeDataset == 'sameAsMany' || activeDataset == 'search'){
												return "inline";												
											}else{
												return "none";	
											}
											
										})
										.attr("href","#")
										.click(function(event){
											
											 
											 
											verified($(this).data("dbpediaURI"), $(this).data("viafURI"), $(this).data("index"));											
											
											event.preventDefault();
											return false;
											
										})
										.text("Use This URI")
										
								
								)
							
							
						)	
							
					
					for (y in peopleIndex[index].viafData[peopleIndex[index].viafURI[x]]){
					
						console.log(peopleIndex[index].viafData);
					
						//wowwwwwwww....
						for (z in peopleIndex[index].viafData[peopleIndex[index].viafURI[x]][y]){
							
							
							
							$("#viafDetails").append($("<div>").text(y + " | " + peopleIndex[index].viafData[peopleIndex[index].viafURI[x]][y][z]));							
						
							//console.log(peopleIndex[index].locURI[x], y, peopleIndex[index].locData[peopleIndex[index].locURI[x]][y][z]);	
							
								
							
						}
						
						
					}
					if (x<peopleIndex[index].viafURI.length){
						$("#viafDetails").append($("<hr>"));
					}
					
					
				}		
				
			}
			
						
			
			
		}
	
		function askWhy(uri,index){
		
			uri = uri.split('/resource/');

			

			
			
			
			
			$.get('?askWhy=' + uri[1], function(data) {
				
 				
				
				

				
				data = data.replace(/</g,"&lt;");
				data = data.replace(/>/g,"&gt;");								
				//data = data.replace(uri[1], "<span style=\"color:#fff\">" + uri[1] + "</span>");
				
				var safeName = uri[1].replace("_","\\_");
				
				var re = new RegExp(safeName,"g");
				
				data = data.replace(re, "<span style=\"color:#00F; font-size:16px\">" + uri[1] + "</span>");
				
					
				$("#person" + index)
					.append(
						$("<div>")
							.addClass('askWhy')
							.html(data)
					
					);				
				
			})
			
			
		}
	
	
	
	
		function unmarkeDeleted(dbpURI,index){
		
			$("#person"+index).css("transition","none");
			$("#person"+index).css("-ms-transition","none");
			$("#person"+index).css("-o-transition","none");
			$("#person"+index).css("-moz-transition","none");
			$("#person"+index).css("-webkit-transition","none");												
			
			$("#person"+index).fadeOut(500);
			
			dataObjects['sameAsLow'][dbpURI] = dataObjects['deleted'][dbpURI];
			
			delete dataObjects['deleted'][dbpURI]; 
			 
			
			$.get('?', { undeldbpedia: dbpURI}, function(data) {
				
				
			})
			
			
			updateCounts();
			
			
			
		}		
	
		function markeDeleted(dbpURI,index){
		
			$("#person"+index).css("transition","none");
			$("#person"+index).css("-ms-transition","none");
			$("#person"+index).css("-o-transition","none");
			$("#person"+index).css("-moz-transition","none");
			$("#person"+index).css("-webkit-transition","none");												
			
			$("#person"+index).fadeOut(500);
			
			dataObjects['deleted'][dbpURI]	 = dataObjects[activeDataset][dbpURI];
			
			delete dataObjects[activeDataset][dbpURI]; 
			 
			
			$.get('?', { deldbpedia: dbpURI}, function(data) {
				
				
			})
			
			
			updateCounts();
			
			
			
		}	
	
		function verified(dbpURI,locURI,index){
		
			$("#person"+index).css("transition","none");
			$("#person"+index).css("-ms-transition","none");
			$("#person"+index).css("-o-transition","none");
			$("#person"+index).css("-moz-transition","none");
			$("#person"+index).css("-webkit-transition","none");												
			
			$("#person"+index).fadeOut(500);
			
			dataObjects['verified'][dbpURI]	 = dataObjects[activeDataset][dbpURI];
			
			delete dataObjects[activeDataset][dbpURI];
			
			
			
			
			
			$.get('?', { dbpedia: dbpURI, loc: locURI }, function(data) {
				
				
			})
			
			
			updateCounts();
			
			
			
		}
		

		function unverified(dbpURI,locURI,index){
		
			$("#person"+index).css("transition","none");
			$("#person"+index).css("-ms-transition","none");
			$("#person"+index).css("-o-transition","none");
			$("#person"+index).css("-moz-transition","none");
			$("#person"+index).css("-webkit-transition","none");												
			
			$("#person"+index).fadeOut(500);
			
			dataObjects['sameAsLow'][dbpURI] = dataObjects['verified'][dbpURI];
			
			delete dataObjects['verified'][dbpURI]; 
			
			$.get('?', { undbpedia: dbpURI, unloc: locURI }, function(data) {
				
				
			})
			
			
			updateCounts();
			
			
			
		}
				
		function updateCounts(){
			for (x in dataFiles){
				if ($("#" + dataFiles[x][1])){
					$("#" + dataFiles[x][1] + ' a span').html('(' + numberWithCommas(Object.size(dataObjects[dataFiles[x][1]])) + ')'); 			
				}
			}				
		}
	
	 

			
	 
	 

		//Utility functions

		
		function numberWithCommas(x) {
			return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		}	
			
		Object.size = function(obj) {
			var size = 0, key;
			for (key in obj) {
				if (obj.hasOwnProperty(key)) size++;
			}
			return size;
		};	
		
		
	</script>
 
 
 
 
 


</head>
<body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
  		
        
            <div class="container-fluid">
     
                  <img src="img/logo.png" id="logo">
    
    
                <div class="menuItem" id="sameAsPerfect"><a href="#">Perfect <span>(<img src="img/ljspinner.gif">)</span></a></div>
                <div class="menuItem" id="sameAsHigh"><a href="#" style="color:#090">High <span>(<img src="img/ljspinner.gif">)</span></a></div>
                <div class="menuItem" id="sameAsMedium"><a href="#" style="color:#F60">Medium <span>(<img src="img/ljspinner.gif">)</span></a></div>            
                <div class="menuItem" id="sameAsLow"><a href="#" style="color:#900">Low <span>(<img src="img/ljspinner.gif">)</span></a></div>            
                <div class="menuItem" id="sameAsMany"><a href="#" style="color:#C09">Many <span>(<img src="img/ljspinner.gif">)</span></a></div>            
                <div class="menuItem" id="sameAsNone"><a href="#" style="color:#333">None <span>(<img src="img/ljspinner.gif">)</span></a></div>
                <div class="menuItem"> | </div>
                <div class="menuItem" id="verified"><a href="#" style="color:#006">Verified <span>(<img src="img/ljspinner.gif">)</span></a></div>                            
				<div class="menuItem" id="deleted"><a href="#" style="color:#F00">Deleted<span>(<img src="img/ljspinner.gif">)</span></a></div>                                            
                <div class="menuItem"> | </div>
                <div class="menuItem"><a href="#" id="searchLink"><i class="icon-search"></i></a></div>                                    
                
            </div>        
        
        
      </div>
    </div>
 

<div class="container-fluid" style="margin-top:54px;">
    <div class="row-fluid">      
      <div class="span7" id="contentList"></div>
      <div class="span5" id="contentDetail">
      	
        <div id="contentDetailDisplay"></div>
      
      </div>
    </div>
</div>
  
<div id="overlay">Processing Data</div>
    
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34282776-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
    
</body>
</html>
