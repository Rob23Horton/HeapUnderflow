// Javascript Document

window.addEventListener("load", () => {

    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");

    const rect = canvas.getBoundingClientRect();

    canvas.width = 1280;
    canvas.height = 550;

    let painting = false;

    function startPosition(e)
    {
        painting = true;
        draw(e);
    }

    function finishPosition(){
        painting = false;
        ctx.beginPath();
    }

    function draw(e)
    {
        if (!painting) return;

        ctx.lineWidth = 10;
        ctx.lineCap = "round";

        ctx.lineTo(e.clientX, e.clientY - rect.top);
        ctx.stroke();
        ctx.beginPath();
        ctx.moveTo(e.clientX, e.clientY - rect.top);
    }

    canvas.addEventListener("mousedown", startPosition);
    canvas.addEventListener("mouseup", finishPosition);
    canvas.addEventListener("mousemove", draw);

});

function fitToContainer(canvas){
    // Make it visually fill the positioned parent
    canvas.style.width ='100%';
    canvas.style.height='100%';
    // ...then set the internal size to match
    canvas.width  = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;
  }