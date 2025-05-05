
console.log("pie-chart")

document.addEventListener("DOMContentLoaded", showPieChart)

function showPieChart() {
    console.log("pie-chart-on-load")

    let sliceA = {size:100, color:"#003396"}
    let sliceB = {size:900, color:"#17b9ee"}

    const values = [sliceA.size , sliceB.size]

    const total = values.reduce((acc,val) =>  acc + val,0);

    let startAngle = Math.PI;

    const canvas =  document.getElementById("piechart")
    const ctx = canvas.getContext("2d")

    values.forEach((value,index)=>{
        const angle = (value / total) * Math.PI ;
        const outerRadius = canvas.width / 2; // Outer radius for the donut
        const innerRadius = canvas.width*3/8 ; // Inner radius for the hole
        

        ctx.beginPath();
        ctx.moveTo(canvas.width / 2, canvas.height/2);
        ctx.arc(
            canvas.width / 2,
            canvas.height / 2,
            outerRadius, 
            startAngle,
            startAngle + angle
        );
        ctx.arc(
            canvas.width / 2,
            canvas.height / 2,
            innerRadius, 
            startAngle + angle,
            startAngle ,
            true
        );
        
        ctx.closePath();
        ctx.fillStyle = index === 0 ? sliceA.color :sliceB.color;
        ctx.fill();
        startAngle +=angle;

    })
        
}


