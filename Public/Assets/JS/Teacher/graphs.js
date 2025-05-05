
document.addEventListener('DOMContentLoaded', () => {
    const ctxPie = document.getElementById('canvas-1').getContext('2d'); // Declare ctx inside DOMContentLoaded
    
    
    const dataPie = {
      labels: ['Outstanding ', 'Satisfactory ', 'Needs Improvement', 'Unsatisfactory '], // Optional labels
      datasets: [{
        data: phpData, // Values
        backgroundColor: [
          '#46bd91',
          '#46a7f7',
          '#FDB45C',
          '#F7464A',
        ],
        hoverOffset: 2,
        cutout:60,
      }]
    };
  
    const configPie = {
      type: 'doughnut', // Specify chart type
      data: dataPie,
      options: {
        responsive: true,
        plugins: {
            datalabels:{
                formatter:(value) =>{
                    return value + '%';
                },
              },
          legend: {
            display:false
          },
          
        }
      }
    };
  
    new Chart(ctxPie, configPie); // Create chart



    const ctxLine = document.getElementById('canvas-2').getContext('2d');

    const dataLine = {
        labels: ['Jan ', 'Feb ', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Noc', 'Dec'], // Optional labels
        datasets: [{
          data: phpData2, // Values
          fillColor: "rgba(220,220,220,0.5)",
          borderColor: "rgba(35, 83, 167, 0.5)",
          strokeColor: "rgba(220,220,220,1)",
          pointColor: "rgba(220,220,220,1)",
          pointStrokeColor: "#fff",
          tension: 0.4
        },
      
    ]
      };

      const configLine = {
        type: 'line', // Specify chart type
        data: dataLine,
        options: {
          responsive: true,
          plugins: {
              
            legend: {
              display:false
            },
            
          },
          scales:{
            x:{
                grid:{
                    display:false
                }
            },
            y:{
                grid:{
                    display:true,
                    color:'rgba(200, 200, 200, 0.3)'
                }
            }
          }
        }
      };

      new Chart(ctxLine, configLine); // Create chart

  });
  