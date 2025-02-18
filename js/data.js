const trafficCtx = document.getElementById('trafficChart').getContext('2d');
 new Chart(trafficCtx, {
     type: 'doughnut',
     data: {
         labels: ['Organic', 'Referral'],
         datasets: [{
             data: [60, 40],
             backgroundColor: ['#0d6efd', '#ffc0cb']
         }]
     },
     options: {
         responsive: true,
         maintainAspectRatio: false,
         cutout: '70%',
         plugins: {
             legend: {
                 position: 'bottom',
                 labels: {
                     font: {
                         size: 11
                     }
                 }
             }
         }
     }
 });