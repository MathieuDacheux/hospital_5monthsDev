/******************************************** *********************************************/
/************* Using chart.js librart to show how many patients added per day *************/
/******************************************** *********************************************/

let patientsFromLastSevenDays = JSON.parse(document.querySelector('.hidden').textContent);
        // Sort patient per day
        let patientsPerDay = [];
        for (let i = 0; i < 7; i++) {
            patientsPerDay.push(0);
        }
        for (let i = 0; i < patientsFromLastSevenDays.length; i++) {
            let date = new Date(patientsFromLastSevenDays[i].creationDate);
            let day = date.getDay();
            patientsPerDay[day]++;
        }
        console.log(patientsPerDay);
        // Create chart
        const ctx = document.querySelector('.chartPatients').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                datasets: [{
                    label: 'Patients',
                    data: patientsPerDay,
                    backgroundColor: 'rgba(82, 117, 236, 1)',
                    borderColor: 'rgba(227, 231, 247, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

