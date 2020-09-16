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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/form.js":
/*!******************************!*\
  !*** ./resources/js/form.js ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports) {

// var department = $("#department");
// var title = $("#title");
// var description = $("#description");
// var fees = $("#fees")
// var speaker = $("#speaker");
// var total_rows_of_dates = 0;
// var no_of_days = 0;
// document.addEventListener('DOMContentLoaded', function () {
//     $('select').formSelect();
// });
// $('select:not(.browser-default)').on('change', function (e) {
//     console.log(e.target.value);
// });
// function warning() {
//     if ($(this).val() == "") {
//         var parent = $(this).parent().parent();
//         var parent_classname = parent.attr('class');
//         if (parent.hasClass('department') || parent.hasClass('title') || parent.hasClass('description') || parent.hasClass('event_days'))
//             parent.append(`<label class="warning_message col s12 ${parent_classname} ">Please add ${parent_classname}.</label>`);
//         else if (parent.hasClass('fees') || parent.hasClass('stakeholders') || parent.hasClass('venue') || parent.hasClass('speaker') || parent.hasClass('certificate')) {
//             parent.parent().append(`<label class="warning_message col s12 ${parent_classname} ">Please add ${parent_classname}.</label>`);
//         }
//     }
// }
// function remove_warning() {
//     if ($(this).val() != "") {
//         var parent = $(this).parent();
//         if ($(this).is('#fees') || $(this).is('#stakeholders') || $(this).is('#venue') || $(this).is('#Speaker') || $(this).is('#Certificate')) {
//             var targetclass = parent.parent().attr('class');
//             var targetelement = parent.parent().siblings(`label.${targetclass}`);
//             console.log(targetelement);
//             targetelement.remove();
//         } else {
//             var targetclass = parent.parent().attr('class');
//             var targetelement = parent.siblings(`label.${targetclass}`);
//             targetelement.remove();
//         }
//     }
// }
// $("input[type=text]").blur(warning);
// $("input[type=text]").keydown(remove_warning);
// $("textarea").blur(warning);
// $("textarea").keydown(remove_warning);
// $("input[type=number]").blur(warning);
// $("input[type=number]").keydown(remove_warning);
// $("input[type=number]").mousedown(remove_warning);
// var venue;
// var time;
// $('#yes_venue').click(function () {
//     venue = true;
//     $('.single_venue').children().remove();
//     $('.date-time').parent().remove();
//     if (time == true)
//         yes_time();
//     else if (time == false)
//         no_time();
// })
// // var venue_options = ["Opt 1", "Opt 2", "Opt 3"];
// $('#no_venue').click(function (e) {
//     venue = false;
//     // console.log('clicked');
//     $('.date-time').parent().remove();
//     if (time == true)
//         yes_time();
//     else if (time == false)
//         no_time();
//     if ($('.venue').length == 0)
//         $('.single_venue').append(`<div class="venue">
//                         <div class="input-field col s12 m12 l12">
//                             <select id="select_venue">
//                                 <option value="" disabled>Select</option>
//                             </select>
//                             <label>Venue</label>
//                         </div>
//                     </div>`);
//     var select_venue = $('#select_venue');
//     const http = new extra;
//     http.get('http://somaiya_web.io/venues')
//         .then(data => updateUI(data, select_venue))
//         .catch(err => console.error(err));
// })
// $('#yes_time').click(yes_time);
// function yes_time() {
//     time = true;
//     no_of_days = $("#no_of_days").val();
//     total_rows_of_dates = no_of_days;
//     $('.date_time').parent().remove();
//     $('.btn-floating.btn-large').css("display", "block");
//     if (venue == true) {
//         for (var i = 0; i < no_of_days; i++) {
//             singledate_venue(i);
//         }
//         multiple_venue();
//     } 
//     else if (venue == false)
//         for (var i = 0; i < no_of_days; i++) {
//             singledate(i);
//         }
// }
// $('#no_time').click(no_time);
// function no_time() {
//     time = false;
//     no_of_days = $("#no_of_days").val();
//     total_rows_of_dates = no_of_days;
//     $('.date_time').parent().remove();
//     if (venue == true) {
//         for (var i = 0; i < no_of_days; i++) {
//             singledate_venue(i);
//         }
//         multiple_venue();
//     } else if (venue == false) {
//         multipledate(i);
//         $('.btn-floating.btn-large').css("display", "none");
//     }
// }
// function singledate(i) {
//     console.log("CLicked!");
//     $('.event-details').append(`<div class="row m-0">
//                     <div class="date_time">
//                         <div class="col mycol"></div>
//                         <div class="input-field col s12 l2">
//                             <input id="start_date${i}" type="text" class="datepicker">
//                             <label class="active" for="start_date">Date</label>
//                         </div>
//                         <div class="col mycol2"></div>
//                         <div class="input-field col s5 l2">
//                             <input id="start_time${i}" type="text" class="timepicker">
//                             <label class="active" for="start_time">Start Time</label>
//                         </div>
//                         <div class="col s2 m1 l1 center-align mt-20">
//                             <span class="">to</span>
//                         </div>
//                         <div class="input-field col s5 l2">
//                             <input id="end_time${i}" type="text" class="timepicker">
//                             <label class="active"  for="end_time">End Time</label>
//                         </div>
//                     </div>
//                 </div>`);
// }
// function singledate_venue(i) {
//     $('.event-details').append(`<div class="row m-0">
//                     <div class="date_time">
//                         <div class="input-field col s12 l2">
//                             <input id="start_date${i}" type="text" class="datepicker">
//                             <label class="active" for="start_date">Date</label>
//                         </div>
//                         <div class="col mycol"></div>
//                         <div class="input-field col s5 l2">
//                             <input id="start_time${i}" type="text" class="timepicker">
//                             <label class="active" for="start_time">Start Time</label>
//                         </div>
//                         <div class="col s2 m1 l1 center-align mt-20">
//                             <span class="">to</span>
//                         </div>
//                         <div class="input-field col s5 l2">
//                             <input id="end_time${i}" type="text" class="timepicker">
//                             <label class="active"  for="end_time">End Time</label>
//                         </div>
//                         <div class="col mycol"></div>
//                         <div class="venue">
//                         <div class="input-field col s12 m2 l2">
//                             <select multiple class="venue${i}" id="select_venue">
//                                 <option value="" disabled>Select</option>
//                             </select>
//                             <label>Venue</label>
//                         </div>
//                     </div>
//                     </div>
//                 </div>`);
//     $('.venue .input-field input[type=text]').css("width", "78%");
// }
// $('.btn-floating.btn-large').click(function () {
//     if (venue == true) {
//         for (var i = 0; i < no_of_days; i++) {
//             singledate_venue(i);
//         }
//         multiple_venue();
//     } else if (venue == false)
//         singledate();
//     total_rows_of_dates = total_rows_of_dates + 1;
// });
// function multipledate(i) {
//     console.log("CLicked!");
//     $('.event-details').append(`<div class="row m-0">
//                     <div class="date_time">
//                         <div class="input-field col s5 l2">
//                             <input id="start_date${i}" type="text" class="datepicker">
//                             <label class="active" for="start_date">Start Date</label>
//                         </div>
//                         <div class="col s2 m1 l1 center-align mt-20">
//                             <span class="">to</span>
//                         </div>
//                         <div class="input-field col s5 l2">
//                             <input id="end_date${i}" type="text" class="datepicker">
//                             <label class="active" for="end_date">End Date</label>
//                         </div>
//                         <div class="col mycol2"></div>
//                         <div class="input-field col s5 l2">
//                             <input id="start_time${i}" type="text" class="timepicker">
//                             <label class="active" for="start_time">Start Time</label>
//                         </div>
//                         <div class="col s2 m1 l1 center-align mt-20">
//                             <span class="">to</span>
//                         </div>
//                         <div class="input-field col s5 l2">
//                             <input id="end_time${i}" type="text" class="timepicker">
//                             <label class="active" for="end_time">End Time</label>
//                         </div>
//                     </div>
//                 </div>`);
// }
// $('body').on('focus', ".datepicker", function () {
//     console.log($(this));
//     $(this).datepicker();
// });
// $('body').on('focus', ".timepicker", function () {
//     $(this).timepicker();
// });
// $(document).ready(function () {
//     $('#slide-out').sidenav({
//         edge: 'right'
//     });
// });
// $(document).ready(function () {
//     $('#mobile-demo.sidenav').sidenav({
//         edge: 'left'
//     });
// });
// $('#pop').click(function(e) {
//     var start_dates = [];
//     var end_dates = [];
//     var start_times = [];
//     var end_times = [];
//     var no_of_days = $("#no_of_days").val();
//     for (var i = 0; i < total_rows_of_dates; i++) {
//         var start_date = $('#start_date' + i).val();
//         start_dates[i] = start_date;
//         var end_date = $("#end_date" + i).val();
//         end_dates[i] = end_date;
//         var start_time = $("#start_time" + i).val();
//         start_times[i] = start_time;
//         var end_time = $("#end_time" + i).val();
//         end_times[i] = end_time;
//         let current_date = new Date();
//         if (end_date < start_date || new Date(start_date) < current_date || new Date(end_date) < current_date) {
//             console.log('Please put different date');
//         }
//         if (start_time >= end_time) {
//             console.log('Please put different time');
//             e.preventDefault();
//         }
//         if (department.val() == "" || title.val() == "" || description.val() == "" || fees.val() == "" || speaker.val() == "") {
//             console.log("Please enter all details");
//             e.preventDefault();
//         }
//     }
//         console.log(start_dates);
//         console.log(end_dates);
//         console.log(start_times);
//         console.log(end_times);  
//         $.post("http://localhost/somaiya_web/public/events",
//   {
//     department: department,
//     description: description,
//     fees:fees,
//     speaker:speaker,
//     no_of_days:no_of_days,
//     total_rows_of_dates:total_rows_of_dates,
//     start_dates:start_dates, 
//     end_dates:end_dates, 
//     start_times:start_times,
//     end_times:end_times,
//   },
//   function(data, status){
//     alert("Data: " + data + "\nStatus: " + status);
//   });
//   e.preventDefault(); 
//     // var params  = "name="+name;"&department="+department;"&description="+description;"&fees="+fees;"&speaker="+speaker;"&no_of_days="+no_of_days;"&total_rows_of_dates="+total_rows_of_dates;"&start_dates="+start_dates;"&end_dates="+end_dates;"&start_times="+start_times;"&end_times="+end_times;
//     // event.preventDefault();
//     // xhr= new XMLHttpRequest();
//     // xhr.open('POST','http://localhost/somaiya_web/public/events',true);
//     // xhr.setRequestHeader("Content-type", "application/json");
//     // xhr.onload=function(){
//     //     console.log(start_dates);
//     //     console.log(end_dates);
//     //     console.log(start_times);
//     //     console.log(end_times);    } 
//     //     // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     //     var params  = {name:name, department: department, description: description, fees:fees, speaker:speaker, no_of_days:no_of_days, total_rows_of_dates:total_rows_of_dates, start_dates:start_dates, end_dates:end_dates, start_times:start_times, end_times:end_times};
//     //     xhr.send(JSON.stringify(params));
//         // $.ajax({
//         //     // headers: {
//         //     //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         //     //   },
//         //     url: "http://localhost/somaiya_web/public/events",
//         //     type:"POST",
//         //     data:{
//         //       "_token": "{{ csrf_token() }}",
//         //       title:title, 
//         //       department: department,
//         //        description: description,
//         //         fees:fees,
//         //          speaker:speaker,
//         //           no_of_days:no_of_days,
//         //            total_rows_of_dates:total_rows_of_dates,
//         //             start_dates:start_dates, 
//         //             end_dates:end_dates, 
//         //             start_times:start_times,
//         //              end_times:end_times,
//         //     },
//         //    });
//         // xhr.send(start_dates,end_dates,start_times,end_times);
// });
// class extra {
//     //Makes a GET Request
//     get(url) {
//         return new Promise((resolve, reject) => {
//             fetch(url)
//                 .then(res => {
//                     if (!res.ok)
//                         throw new Error(res.status);
//                     return res.json();
//                 })
//                 .then(data => resolve(data))
//                 .catch(err => reject(err));
//         })
//     }
// }
// function updateUI(data, class_name) {
//     for (var i = 1; i <= Object.keys(data).length; i++) {
//         var option = document.createElement("OPTION");
//         option.setAttribute("value", i);
//         var textnode = document.createTextNode(data[i]);
//         option.appendChild(textnode);
//         class_name.append(option);
//     }
//     $('select').formSelect();
// }
// function multiple_venue() {
//         const http = new extra;
//         http.get('http://somaiya_web.io/venues')
//             .then(data => update_venueUI(data))
//             .catch(err => console.error(err));
// }
// function update_venueUI(data){
//     for (var i = 0; i < no_of_days; i++) {
//         var select_venue = $('.venue' + i);
//         updateUI(data,select_venue);
//     }
// }
// // $.ajax({
// //     method: 'POST',
// //     url : events,
// //     data: { 
// //         start_dates: start_dates,
// //         end_dates: end_dates,
// //         start_times: start_times,
// //         end_times: end_times
// //     }
// // });

/***/ }),

/***/ 4:
/*!************************************!*\
  !*** multi ./resources/js/form.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\somaiya_web\resources\js\form.js */"./resources/js/form.js");


/***/ })

/******/ });