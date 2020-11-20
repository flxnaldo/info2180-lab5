window.onload = function(){
	var lookupCountry = document.getElementById("lookup");
	var lookupCities = document.getElementById("lookupcities");
	var xhttp = new XMLHttpRequest();
	
		
		lookupCountry.addEventListener("click", function(e){
			e.preventDefault();
			
			var country = document.getElementById("country").value;
			var result = document.getElementById("result");
			
			xhttp.open("GET", "world.php?country="+country, true);
			
			xhttp.onreadystatechange = function(){
				if(xhttp.readyState == 4){
					if (xhttp.status == 200){
						var info = xhttp.responseText;
						result.innerHTML = info;
					}
				}
			}
			xhttp.send();			
		});	
		
		lookupCities.addEventListener("click", function(e){
			e.preventDefault();
			
			var country = document.getElementById("country").value;
			// var xhttp = new XMLHttpRequest();
			var result = document.getElementById("result");
			// result.innerHTML = "";
			
			xhttp.open("GET", "world.php?country="+country+"&all=cities", true);
			
			xhttp.onreadystatechange = function(){
				if(xhttp.readyState == 4){
					if (xhttp.status == 200){
						var info = xhttp.responseText;
						result.innerHTML = info;
					}
				}
			}
			xhttp.send();
		});
	
};