require('../scss/chart.scss');

function chartBook (data) {

    let divWeek = document.getElementById('currentWeek');

    let client2019 = [];
    let client2020 = [];

    for (let i = 0; i < data.length; i++) {

        if(data[i]['start'].substring(0, 4) === '2019') {
            client2019.push(data[i])
        } else  if(data[i]['start'].substring(0, 4) === '2020') {
            client2020.push(data[i])

        }
    }


    function calculDirection(array) {

        let object = {};

        object['lbc']     = 0;
        object['direct']  = 0;
        object['abritel'] = 0;

        for (let i = 0; i < array.length; i++) {
            if (data[i]['lbc']) {
                object['lbc']  += 1;

            } else if (data[i]['abritel']) {
                object['abritel'] += 1;

            } else {
                object['direct'] += 1;
            }
        }

        return object;
    }

    let nineteen  = calculDirection(client2019);
    let twenty    = calculDirection(client2020);
    let twentyOne = 0;

    //Second pie
    var ctx = document.getElementById('historique2019').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',

        data: {
            labels: ['Direct', 'Le bon coin', 'Abritel'],
            datasets: [{
                label: 'Flux de clientèle 2019',
                backgroundColor: ['rgb(255, 99, 132)', 'rgb(255,4,0)', 'rgb(158,255,0)'],
                data: [nineteen['direct'], nineteen['lbc'], nineteen['abritel']]
            }]
        },

        // Configuration options go here
        options: {}
    });

    var ctx = document.getElementById('historique2020').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',

        data: {
            labels: ['Direct', 'Le bon coin', 'Abritel'],
            datasets: [{
                label: 'Flux de clientèle 2020',
                backgroundColor: ['rgb(255, 99, 132)', 'rgb(255,4,0)', 'rgb(158,255,0)'],
                data: [twenty['direct'], twenty['lbc'], twenty['abritel']]
            }]
        },

        // Configuration options go here
        options: {}
    });

    let today = new Date();
    let currentWeek = getNumberOfWeek(today);

    let weeklyCustomers = [];

    for (let i = 0; i < data.length; i++) {
        let date = new Date(data[i]['start']);
        let targetWeek = getNumberOfWeek(date);

        if (currentWeek === targetWeek) {
            weeklyCustomers.push(data[i]);
        }
    }

    console.log(weeklyCustomers);

    for (let i = 0; i < weeklyCustomers.length; i++ ){

        let start = transform(new Date(weeklyCustomers[i]['start']));
        let end  = transform(new Date(weeklyCustomers[i]['end']));

        divWeek.innerHTML +=
            `<div class="col-12 m-2">
                <ul class="list-group col-12 ">
                    <li class="list-group-item">Nom : ${weeklyCustomers[i]['customer']}</li>
                    <li class="list-group-item">Linge de maison : ${ (weeklyCustomers[i]['laundry'] === "false") ? 'Non compris' : 'Compris'}</li>
                    <li class="list-group-item">Ménage : ${ (weeklyCustomers[i]['cleaning'] === "false") ? 'Non compris' : 'Compris'}</li>
                    <li class="list-group-item">Date de début : ${start}</li>
                    <li class="list-group-item">Date de fin : ${ end}</li>
                </ul>
            </div>`
    }
}



(function () {


    fetch(' http://www.gite.local/api/booking')
        .then(response => response.json())
        .then(data => chartBook(data))
    }
)();

function getNumberOfWeek(dateObject) {
    const firstDayOfYear = new Date(dateObject.getFullYear(), 0, 1);
    const pastDaysOfYear = (dateObject - firstDayOfYear) / 86400000;
    return Math.ceil((pastDaysOfYear + firstDayOfYear.getDay() + 1) / 7);
}

function transform(current_datetime) {
    return current_datetime.getDate() + "-" + (current_datetime.getMonth() + 1) +  "-"  +current_datetime.getFullYear()
}

