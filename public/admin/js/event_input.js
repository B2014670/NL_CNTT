//label file name
const fileUpload = document.querySelector(".custom-file-input");
if (fileUpload){
	fileUpload.addEventListener("change", (event) => {
		const { files } = event.target;
		document.querySelector(".custom-file-label").innerHTML = files[0].name;
	})
}

//change input edit form for active button submit
var input1 = document.getElementById("cate");
var input2 = document.getElementById("name");
var input3 = document.getElementById("price");
var input4 = document.getElementById("weight");
var input5 = document.getElementById("exampleInputFile");
var input6 = document.getElementById("orig");
var button = document.querySelector(".btn-info");

if (input1)
input1.addEventListener("change", function () {
	button.disabled = false;
});

if (input2)
input2.addEventListener("change", function () {
	button.disabled = false;
});

if (input3)
input3.addEventListener("change", function () {
	button.disabled = false;
});

if (input4)
input4.addEventListener("change", function () {
	button.disabled = false;
});

if (input5)
input5.addEventListener("change", function () {
	button.disabled = false;
});

if (input6)
input6.addEventListener("change", function () {
	button.disabled = false;
});

