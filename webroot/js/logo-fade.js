logoFade = document.getElementById("logoFade");

var myScrollFunc = function () {
	var y = window.scrollY;
	if (y >= 60) {
		logoFade.className = "logo-fade show"
	} else {
		logoFade.className = "logo-fade hide"
	}
};

window.addEventListener("scroll", myScrollFunc);