/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/_app.js":
/*!******************************!*\
  !*** ./resources/js/_app.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

// let today = new Date();
// console.log(today);
// let dayInt = today.getDate();
// console.log(dayInt);
// let month = today.getMonth();
// console.log(month);
// let year = today.getFullYear();
// console.log(year);
// console.log(new Date(year, month+1, 0).getDate());
// var j=document.getElementById('abc').innerHTML;
// console.log(j);
// let calendarContainer = document.querySelector('.calendar-container');
// let calendarBody = document.querySelector('.date-list');
// console.log(calendarBody);
// let nextBtn = document.getElementById('next');
// let prevBtn = document.getElementById('prev');
// let months = [
//     'January',
//     'February',
//     'March',
//     'April',
//     'May',
//     'June',
//     'July',
//     'August',
//     'September',
//     'October',
//     'November',
//     'December'
// ];
// // functions start from here
// // Show calendar
//     const showCalendar = (month , year) => {
//     let firstDay = new Date(year , month).getDay();
//     console.log(firstDay);
//     let lastDay = new Date(year,month + 1 , 0).getDay();
//     console.log(lastDay);
//     extraDays = 6-lastDay;
//     console.log(extraDays);
//     calendarBody.innerHTML = "";
//     let totalDays = daysInMonth(month , year);
//     console.log(totalDays);
//     console.log(totalDays-firstDay)
//     // extra dates before firstday
//     blankDates(firstDay);
//     // Create the boxes with dates written
//     for(let day = 1 ; day<=totalDays ; day++){
//         let cell = document.createElement('li');
//         cell.className = 'date';
//         let cellSpan = document.createElement('span');
//         cellSpan.className = 'dateEl'
// 		let cellText = document.createTextNode(day);
//         cellSpan.appendChild(cellText);
//         // if(
//         //     dayInt === day && 
//         //     month === today.getMonth() &&
//         //     year === today.getFullYear()
//         //     ){
//         //         cell.classList.add('active');
//         // }
//         cell.setAttribute('data-day' , day);
//         cell.setAttribute('data-month' , month);
//         cell.setAttribute('data-year' , year);
//         cell.appendChild(cellSpan);
//         calendarBody.appendChild(cell);
//     }
//     let weeks = getWeeksInMonth(month , year);
//     console.log(weeks); 
//     // Extra days after last day
//     if(weeks===5){
//         extraDays+=7
//     }
//     extraDates(extraDays);
//     // Display month and year
//     document.getElementById('month').innerHTML = `${months[month]} ${year}`;
// }
// // Weeks in a month
// const getWeeksInMonth = (month_number , year) => {
//   var firstOfMonth = new Date(year, month_number, 1);
//   var lastOfMonth  = new Date(year, month_number, 0);
//   var used         = firstOfMonth.getDay() + lastOfMonth.getDate();
//   return Math.ceil( used / 7);    
//   }
// // No of days in that month
// const daysInMonth = (month , year) => {
//     return new Date(year, month+1, 0).getDate(); 
// }
// // boxes for days before 1st day
// const blankDates = (count)=>{
//     daysInPrevMonth = daysInMonth(month - 1 , year);
//     console.log(daysInPrevMonth);
//     for(let x=0 , y = (daysInPrevMonth -count) + 1 ; x < count ; x++ , y++){
//         let cell = document.createElement("li");
// 		let cellText = document.createTextNode(y);
//         cell.appendChild(cellText);
//         cell.classList.add('extra-date');
// 		calendarBody.appendChild(cell);
//     }
// }
// // Boxes for days after last day
// const extraDates = (count) => {
//     for(let x = count , y=1 ; x>0 ; x-- , y++){
//         let cell = document.createElement("li");
// 		let cellText = document.createTextNode(y);
//         cell.appendChild(cellText);
//         cell.classList.add('extra-date');
// 		calendarBody.appendChild(cell);
//     }
// }
// // for next month
// const next = () => {
//     year = month === 11 ? year + 1 : year;
//     month = (month + 1) % 12;
//     showCalendar(month , year);
// }
// // for Prev month
// const prev = () => {
//     year = month === 0 ? year - 1 : year;
// 	month = month === 0 ? 11 : month - 1;
// 	showCalendar(month, year);
// }
// showCalendar(month, year);
// let dates = document.querySelectorAll('.date');
// console.log(dates);
// function getLink(e) {
//     // console.log(1223);
//     console.log(e.target);
// } 
// // Event listeners
// // calendarBody.addEventListener('click',getLink);
// dates.forEach(date => {
//     date.addEventListener('click' , getLink)
// }); 
// nextBtn.addEventListener('click' , next);
// prevBtn.addEventListener('click' , prev)

/***/ }),

/***/ 1:
/*!************************************!*\
  !*** multi ./resources/js/_app.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\somaiya_web\resources\js\_app.js */"./resources/js/_app.js");


/***/ })

/******/ });