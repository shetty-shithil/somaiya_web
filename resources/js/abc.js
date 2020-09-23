// //let today = new Date();
// //console.log(today);
// //let dayInt = today.getDate();
// //console.log(dayInt);
// //let month = today.getMonth();
// //console.log(month);
// //let year = today.getFullYear();
// //console.log(year);
// //
// //
// //var nextBtn = document.getElementById('next');
// //var prevBtn = document.getElementById('prev');
// //
// //let months = [
// //    'January',
// //    'February',
// //    'March',
// //    'April',
// //    'May',
// //    'June',
// //    'July',
// //    'August',
// //    'September',
// //    'October',
// //    'November',
// //    'December'
// //];
// //
// //
// //const showCalendar = (month, year) => {
// //    document.getElementById('month').innerHTML = `${months[month]} ${year}`;
// //}
// //const next = () => {
// //    year = month === 11 ? year + 1 : year;
// //    month = (month + 1) % 12;
// //    showCalendar(month, year);
// //}
// //
// //
// //// for Prev month
// //const prev = () => {
// //    year = month === 0 ? year - 1 : year;
// //    month = month === 0 ? 11 : month - 1;
// //    showCalendar(month, year);
// //}
// //
// //
// //nextBtn.addEventListener('click', next);
// //prevBtn.addEventListener('click', prev);

// var href = "file:///C:/Users/Krisha%20B%20Nagda/Desktop/college/College_Project/html/index.html/events/30/5/2020";
// let result = href.match(/(.*)events\/(.*)\/(.*)\/(.*)/);

// var original_url = result[1];
// var date = result[2];
// var month = result[3];
// var year = result[4];

// var date = new Date(year, month, date);

// console.log(date);
// $('#next').click(function () {
//     var nextDay = new Date(date);
//     nextDay.setDate(date.getDate() + 1);
//     var nextdate = nextDay.getDate();
//     var nextmonth = nextDay.getMonth();
//     var nextyear = nextDay.getFullYear();
//     console.log(original_url + "events/" + nextdate + "/" + nextmonth + "/" + nextyear );
//     date = nextDay;
// });

// $('#prev').click(function(){
//     var prevDay = new Date(date);
//     prevDay.setDate(date.getDate() - 1);
//     var prevdate = prevDay.getDate();
//     var prevmonth = prevDay.getMonth();
//     var prevyear = prevDay.getFullYear();
//     console.log(original_url + "events/" + prevdate + "/" + prevmonth + "/" + prevyear );
//     date = prevDay;
// })
