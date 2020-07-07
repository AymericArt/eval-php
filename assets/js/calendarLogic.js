import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import listPlugin from '@fullcalendar/list';
import frLocale from '@fullcalendar/core/locales/fr';
import enLocale from '@fullcalendar/core/locales/en-gb';

if (local === 'fr') {
    var language = frLocale;
} else {
    var language = enLocale

}

function transform() {
    let fcEnd = document.getElementsByClassName('fc-end');
    let fcStart = document.getElementsByClassName('fc-start');

    let tdWidth = $('#calendar').width() / 14;

    for (let i = 0; i < fcEnd.length; i++) {
        let width   = $(fcEnd[i]).width();

        let target = width - tdWidth;

        fcEnd[i].style.width =  target + 'px';
    }

    for (let i = 0; i < fcStart.length; i++) {
        let width   = $(fcStart[i]).width();

        let target = width - tdWidth;

        fcStart[i].style.width =  target + 'px';
        fcStart[i].style.marginLeft =  tdWidth + 'px';
    }
}

(function () {
    let booking = [];

    if (local === 'fr') {
        var booked = "Réservé"
    } else {
        var booked = "Booked"

    }

    // http://www.aymeric.tech/api/booking
    //
    fetch(' http://www.gite.local/api/booking')
    // fetch('http://www.aymeric.tech/api/booking')
        .then(res => res.json())
        .then(data => {
            for (let i = 0; i < data.length; i++) {
                let objectBooking = {};
                let end = new Date(data[i].end);

                objectBooking['title'] = booked;
                objectBooking['start'] = data[i].start;
                objectBooking['end'] =  end.setDate( end.getDate() +1 );

                booking.push(objectBooking);
            }

            let calendarEl = document.getElementById('calendar');

            let calendar = new Calendar(calendarEl, {
                plugins: [ dayGridPlugin, listPlugin ],
                timeZone: 'local',
                defaultDate: new Date(),
                locale: language,
                header: {
                    left: 'title',
                    right: 'prev,next'
                },
                events: booking

            });
            calendar.render();
        })
        .then(function () {
            transform();
            let nextButton = document.getElementsByClassName('fc-button-group');

            nextButton[0].addEventListener('click', transform);

        })
    ;
})();

