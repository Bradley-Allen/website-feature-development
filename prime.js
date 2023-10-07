// prime.js
// Bradley Allen
// June 14, 2022
// Test 1
// Grade A


// Initialize the counters and arrays
var primeNumbers = new Array();
var counter_prime = 0;
var nonPrimeNumbers = new Array();
var counter_nonPrime = 0;
var colorChangeSelector = 0;
var colorList = ["#c9b93c", "#7fbf47", "#4287f5", "#bb73ff", "#ff69b6",
	"#ff333a", "#55d5e0", "#4dd182", "#82725c"];
	
// Changes list text colors every 5 seconds
setInterval(changeColors, 5000);

// Reads number entered in form, generates two lists, 
// prime and non-prime numbers up to the range of the number entered
function generatePrimeList() {
	// Gets the number entered
	theNumber=document.theform.enteredNumber.value;
	
	// Reinitialize variables to clear previous lists
	primeNumbers = new Array();
	counter_prime = 0;
	nonPrimeNumbers = new Array();
	counter_nonPrime = 0;
	document.getElementById("primeSumDisplay").innerHTML = null;
	document.getElementById("nonPrimeSumDisplay").innerHTML = null;
	
	// Prevents duplicate SUM buttons
	if (document.getElementById("btn_primeSum") != null){
		document.getElementById("btn_primeSum").remove();
	}
	if (document.getElementById("btn_nonPrimeSum") != null){
		document.getElementById("btn_nonPrimeSum").remove();
	}

	// Adds integers to the respective lists up to the number
	for (var i = 1; i <= theNumber; ++i){
		if (isPrime(i)){
			// Number is prime
			primeNumbers[counter_prime++] = i;
		} else {
			// Number is not prime
			nonPrimeNumbers[counter_nonPrime++] = i;
		}
	}
	
	// Displays lists
	displayLists();
}

// Determines if a given number is prime
function isPrime(n) {
	if (n <= 1) {
		return false;
	}
	for (var i=2; i<n; i++){
		if (n%i==0){
			return false;
		}
	}
	return true;
}

// Displays prime and non-prime lists
function displayLists(){
	
	// Prints all prime numbers in range
	document.getElementById("leftSideContent").innerHTML += "<button id=\"btn_primeSum\" onclick=\"primeSum();\">SUM</button>"
	document.getElementById("primeList").innerHTML = "<h2>Prime Numbers:</h2>"
	for (var i=0; i<primeNumbers.length; ++i){
		if (i==primeNumbers.length-1){
			document.getElementById("primeList").innerHTML += primeNumbers[i]
		} else {
			document.getElementById("primeList").innerHTML += primeNumbers[i] + "<br>";
		}
	}
	
	
	// Prints all non-prime numbers in range
	document.getElementById("rightSideContent").innerHTML += "<button id=\"btn_nonPrimeSum\" onclick=\"nonPrimeSum();\">SUM</button>"
	document.getElementById("nonPrimeList").innerHTML = "<h2>Non-prime Numbers:</h2>"
	for (var i=0; i<nonPrimeNumbers.length; ++i){
		if (i==nonPrimeNumbers.length-1){
			document.getElementById("nonPrimeList").innerHTML += nonPrimeNumbers[i]
		} else {
			document.getElementById("nonPrimeList").innerHTML += nonPrimeNumbers[i] + "<br>";
		}
	}
}

// Changes the colors of the lists
function changeColors(){
	var primeList = document.getElementById("primeList");
	var nonPrimeList = document.getElementById("nonPrimeList");
	primeList.style.color = colorList[colorChangeSelector];
	nonPrimeList.style.color = colorList[(colorChangeSelector+4)%colorList.length];
	colorChangeSelector = (colorChangeSelector + 1) % colorList.length;
}

// Calculates and displays the sum of prime numbers
function primeSum(){
	var sum = 0;
	for (var i=0; i<primeNumbers.length; ++i){
		sum += primeNumbers[i];
	}
	document.getElementById("primeSumDisplay").innerHTML = "<h3>" + sum + "</h3>";
}

// Calculates and diplays the sum of non-prime numbers
function nonPrimeSum(){
	var sum = 0;
	for (var i=0; i<nonPrimeNumbers.length; ++i){
		sum += nonPrimeNumbers[i];
	}
	document.getElementById("nonPrimeSumDisplay").innerHTML = "<h3>" + sum + "</h3>";
}