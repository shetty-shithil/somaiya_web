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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/abc.js":
/*!*****************************!*\
  !*** ./resources/js/abc.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

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

/***/ }),

/***/ 2:
/*!***********************************!*\
  !*** multi ./resources/js/abc.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\somaiya_web\resources\js\abc.js */"./resources/js/abc.js");


/***/ })

/******/ });