
function init()
{
    x_offset = 50;
    y_offset = 100;
    canvas = document.getElementById("main_canvas");
    canvas.width = document.body.clientWidth - x_offset;
    canvas.height = document.body.clientHeight - y_offset;
}