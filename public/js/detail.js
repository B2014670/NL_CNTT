function dscFunction($origin) {
    document.querySelector("#ds").style.color = "black";
    document.querySelector("#inf").style.color = "grey";
    document.querySelector("#ds").style.u = "green";
    document.querySelector("#inf").style.u = "none";
    document.querySelector("#th").innerHTML = $origin;
}
function infoFunction($place) {
    document.querySelector("#ds").style.color = "grey";
    document.querySelector("#inf").style.color = "black";
    document.querySelector("#ds").style.u = "none";
    document.querySelector("#inf").style.u = "green";
    // document.querySelector("#th").createEle
    document.querySelector("#th").innerHTML = $place;
}
