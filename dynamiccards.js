// dynamiccards.js

// Initializes card array and count of cards
cards = new Array();
var i = 0;
var cardcount = 0;

// Create a new card, prompting required information
function newCard() {
	name = prompt("Enter the name", "");
	email = prompt("Enter the email", "");
	address = prompt("Enter the address", "");
	phone = prompt("Enter the phone number", "");
	birthdate = prompt("Enter the birthdate", "");
	cards[cardcount++] = new Card(name, email, address, phone, birthdate);
}

// Display all entered cards
function displayAllCards() {
	document.getElementById("cardlist").innerHTML = null;
	for (i in cards) {
		cards[i].printCard();
	}
}

// Formats card printing
function printCard() {
	var nameLine = "<strong>Name: </strong>" + this.name + "<br>";
	var emailLine = "<strong>Email: </strong>" + this.email + "<br>";
	var addressLine = "<strong>Address: </strong>" + this.address + "<br>";
	var phoneLine = "<strong>Phone: </strong>" + this.phone + "<br>";
	var birthdate = "<strong>Birthdate: </strong>" + this.birthdate + "<hr>"
	document.getElementById("cardlist").innerHTML += nameLine + emailLine + addressLine + phoneLine + birthdate;
}

// Card object
function Card(name,email,address,phone,birthdate) {
	this.name = name;
	this.email = email;
	this.address = address;
	this.phone = phone;
	this.printCard = printCard;
	this.birthdate = birthdate;
}