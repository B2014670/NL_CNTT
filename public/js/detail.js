function dscFunction() {
    document.querySelector("#ds").style.color = "black";
    document.querySelector("#bn").style.color = "grey";
    document.querySelector("#inf").style.color = "grey";
    document.querySelector("#ds").style.u = "green";
    document.querySelector("#bn").style.u = "none";
    document.querySelector("#inf").style.u = "none";
    // document.querySelector("#inf").innerHTML
}
function benFunction() {
    document.querySelector("#ds").style.color = "grey";
    document.querySelector("#bn").style.color = "black";
    document.querySelector("#inf").style.color = "grey";
    document.querySelector("#ds").style.u = "none";
    document.querySelector("#bn").style.u = "green";
    document.querySelector("#inf").style.u = "none";
}
function infoFunction() {
    document.querySelector("#ds").style.color = "grey";
    document.querySelector("#bn").style.color = "grey";
    document.querySelector("#inf").style.color = "black";
    document.querySelector("#ds").style.u = "none";
    document.querySelector("#bn").style.u = "none";
    document.querySelector("#inf").style.u = "green";
}