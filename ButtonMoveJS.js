var startbtn = document.getElementById("makeButton");
startbtn.addEventListener("click",  generateBtn);
var numBtn = 0;
var numChangedSum = 0;

function generateBtn(){
	var color = document.getElementById("Colors").value;
	var btn = document.createElement("button");
	var buttonCanvas = document.getElementById("buttonCanvas");
	buttonCanvas.appendChild(btn);
	//alert("Creating a button...");
	
	btn.innerHTML = Math.floor((Math.random() * 100) + 1); // Changes button text to be 1-99
	btn.style.position = "absolute";
	var x_pos = Math.floor(Math.random() * 87) + 5;
	var y_pos = Math.floor(Math.random() * 64) + 20;
	btn.style.left = x_pos + "%";
	btn.style.top = y_pos + "%";
	btn.style.backgroundColor = color;
	btn.style.color = "black";
	btn.className = "btn btnMadeButton";
	btn.id = numBtn++;
	//alert("Button created!");
	
	btn.onclick = function() {
		console.log(this.id);
		//this.innerHTML = Math.floor((Math.random() * 100) + 1); // Changes button text to be 1-99
		this.style.backgroundColor = document.getElementById("Colors").value;
		numChangedSum += parseInt(this.innerHTML, 10);
		document.getElementById("sumDisplay").innerHTML = numChangedSum;
	}
}