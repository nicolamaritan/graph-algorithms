alert("init.js loaded");

function init()
{
    alert("init called");
    canvas = document.getElementById("main_canvas");
    canvas.width = document.body.clientWidth;
    canvas.height = document.body.clientHeight;
}