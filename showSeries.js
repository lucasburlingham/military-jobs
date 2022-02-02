window.onload = function () {
	document.getElementById("seriesSection").style.display = "none";
	document.getElementById("army").onclick = toggleURLInput;
	document.getElementById("airforce").onclick = toggleURLInput;
};

function toggleURLInput() {
	document.getElementById("seriesSection").style.display = (document.getElementById("army").checked) ? "block" : "none";
}