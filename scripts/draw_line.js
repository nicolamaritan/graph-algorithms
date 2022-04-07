
function draw_line(x1, y1, x2, y2, width = 1, stroke = 'black')
{
    canvas = document.getElementById("main_canvas");
    context = canvas.getContext("2d");

    if (stroke){context.strokeStyle = stroke;}
    
    if (width){context.lineWidth = width;}

    context.beginPath();
    context.moveTo(x1, y1);
    context.lineTo(x2, y2);
    context.stroke();
}

