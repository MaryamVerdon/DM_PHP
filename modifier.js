var tabBtnModifs, tabLine;
var nameList = ['nom_etab','pays','nom_form','niveau','dateDeb','dateFin'];
var idFiche;

function genInputs(e)
{
	tabLine = document.getElementById("tr_"+e.target.getAttribute("id")).childNodes;

	var tmpInput;
	for(var i=2;i<tabLine.length-2;i++)
	{
		tmpInput = document.createElement("input");
		// L'input est un nombre uniquement pour le niveau d'étude.
		if(i == 5) tmpInput.setAttribute("type","number");
		else tmpInput.setAttribute("type","text")
		tmpInput.setAttribute("name",nameList[i-2]);
		tmpInput.value = tabLine[i].innerHTML;

		tabLine[i].innerHTML ="";
		tabLine[i].appendChild(tmpInput);
	}

	tmpInput = document.createElement("input");
	tmpInput.setAttribute("type","submit");
	tmpInput.setAttribute("name","modId");
	tmpInput.setAttribute("value","Valider");
	var btnParent = tabLine[tabLine.length-2];
	btnParent.innerHTML="";
	btnParent.appendChild(tmpInput);

	idFiche = tabLine[tabLine.length-1].childNodes[0].getAttribute("id");
	tmpInput = document.createElement("input");
	tmpInput.setAttribute("type","hidden");
	tmpInput.setAttribute("name","id_fiche");
	tmpInput.setAttribute("value",idFiche);
	btnParent.appendChild(tmpInput);
}

function init()
{
	tabBtnModifs = document.getElementsByClassName("btnModif");
	for(var i=0;i<tabBtnModifs.length;i++)
	{
		tabBtnModifs[i].addEventListener("click",genInputs,false);
	}
	
}

window.addEventListener("load",init,false);