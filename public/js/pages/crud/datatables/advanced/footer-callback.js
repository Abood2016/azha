/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/metronic/js/pages/crud/datatables/advanced/footer-callback.js":
/*!*********************************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/datatables/advanced/footer-callback.js ***!
  \*********************************************************************************/
/***/ (() => {

eval("\n\nvar KTDatatablesAdvancedFooterCalllback = function () {\n  var _init = function init() {\n    var table = $('#kt_datatable'); // begin first table\n\n    table.DataTable({\n      responsive: true,\n      pageLength: 5,\n      lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],\n      footerCallback: function footerCallback(row, data, start, end, display) {\n        var column = 6;\n        var api = this.api(),\n            data; // Remove the formatting to get integer data for summation\n\n        var intVal = function intVal(i) {\n          return typeof i === 'string' ? i.replace(/[\\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;\n        }; // Total over all pages\n\n\n        var total = api.column(column).data().reduce(function (a, b) {\n          return intVal(a) + intVal(b);\n        }, 0); // Total over this page\n\n        var pageTotal = api.column(column, {\n          page: 'current'\n        }).data().reduce(function (a, b) {\n          return intVal(a) + intVal(b);\n        }, 0); // Update footer\n\n        $(api.column(column).footer()).html('$' + KTUtil.numberString(pageTotal.toFixed(2)) + '<br/> ( $' + KTUtil.numberString(total.toFixed(2)) + ' total)');\n      }\n    });\n  };\n\n  return {\n    //main function to initiate the module\n    init: function init() {\n      _init();\n    }\n  };\n}();\n\njQuery(document).ready(function () {\n  KTDatatablesAdvancedFooterCalllback.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvY3J1ZC9kYXRhdGFibGVzL2FkdmFuY2VkL2Zvb3Rlci1jYWxsYmFjay5qcy5qcyIsIm1hcHBpbmdzIjoiQUFBYTs7QUFDYixJQUFJQSxtQ0FBbUMsR0FBRyxZQUFXO0FBRXBELE1BQUlDLEtBQUksR0FBRyxTQUFQQSxJQUFPLEdBQVc7QUFDckIsUUFBSUMsS0FBSyxHQUFHQyxDQUFDLENBQUMsZUFBRCxDQUFiLENBRHFCLENBR3JCOztBQUNBRCxJQUFBQSxLQUFLLENBQUNFLFNBQU4sQ0FBZ0I7QUFDZkMsTUFBQUEsVUFBVSxFQUFFLElBREc7QUFFZkMsTUFBQUEsVUFBVSxFQUFFLENBRkc7QUFHZkMsTUFBQUEsVUFBVSxFQUFFLENBQUMsQ0FBQyxDQUFELEVBQUksQ0FBSixFQUFPLEVBQVAsRUFBVyxFQUFYLEVBQWUsQ0FBQyxDQUFoQixDQUFELEVBQXFCLENBQUMsQ0FBRCxFQUFJLENBQUosRUFBTyxFQUFQLEVBQVcsRUFBWCxFQUFlLEtBQWYsQ0FBckIsQ0FIRztBQUlmQyxNQUFBQSxjQUFjLEVBQUUsd0JBQVNDLEdBQVQsRUFBY0MsSUFBZCxFQUFvQkMsS0FBcEIsRUFBMkJDLEdBQTNCLEVBQWdDQyxPQUFoQyxFQUF5QztBQUV4RCxZQUFJQyxNQUFNLEdBQUcsQ0FBYjtBQUNBLFlBQUlDLEdBQUcsR0FBRyxLQUFLQSxHQUFMLEVBQVY7QUFBQSxZQUFzQkwsSUFBdEIsQ0FId0QsQ0FLeEQ7O0FBQ0EsWUFBSU0sTUFBTSxHQUFHLFNBQVRBLE1BQVMsQ0FBU0MsQ0FBVCxFQUFZO0FBQ3hCLGlCQUFPLE9BQU9BLENBQVAsS0FBYSxRQUFiLEdBQXdCQSxDQUFDLENBQUNDLE9BQUYsQ0FBVSxRQUFWLEVBQW9CLEVBQXBCLElBQTBCLENBQWxELEdBQXNELE9BQU9ELENBQVAsS0FBYSxRQUFiLEdBQXdCQSxDQUF4QixHQUE0QixDQUF6RjtBQUNBLFNBRkQsQ0FOd0QsQ0FVeEQ7OztBQUNBLFlBQUlFLEtBQUssR0FBR0osR0FBRyxDQUFDRCxNQUFKLENBQVdBLE1BQVgsRUFBbUJKLElBQW5CLEdBQTBCVSxNQUExQixDQUFpQyxVQUFTQyxDQUFULEVBQVlDLENBQVosRUFBZTtBQUMzRCxpQkFBT04sTUFBTSxDQUFDSyxDQUFELENBQU4sR0FBWUwsTUFBTSxDQUFDTSxDQUFELENBQXpCO0FBQ0EsU0FGVyxFQUVULENBRlMsQ0FBWixDQVh3RCxDQWV4RDs7QUFDQSxZQUFJQyxTQUFTLEdBQUdSLEdBQUcsQ0FBQ0QsTUFBSixDQUFXQSxNQUFYLEVBQW1CO0FBQUNVLFVBQUFBLElBQUksRUFBRTtBQUFQLFNBQW5CLEVBQXNDZCxJQUF0QyxHQUE2Q1UsTUFBN0MsQ0FBb0QsVUFBU0MsQ0FBVCxFQUFZQyxDQUFaLEVBQWU7QUFDbEYsaUJBQU9OLE1BQU0sQ0FBQ0ssQ0FBRCxDQUFOLEdBQVlMLE1BQU0sQ0FBQ00sQ0FBRCxDQUF6QjtBQUNBLFNBRmUsRUFFYixDQUZhLENBQWhCLENBaEJ3RCxDQW9CeEQ7O0FBQ0FuQixRQUFBQSxDQUFDLENBQUNZLEdBQUcsQ0FBQ0QsTUFBSixDQUFXQSxNQUFYLEVBQW1CVyxNQUFuQixFQUFELENBQUQsQ0FBK0JDLElBQS9CLENBQ0MsTUFBTUMsTUFBTSxDQUFDQyxZQUFQLENBQW9CTCxTQUFTLENBQUNNLE9BQVYsQ0FBa0IsQ0FBbEIsQ0FBcEIsQ0FBTixHQUFrRCxXQUFsRCxHQUFnRUYsTUFBTSxDQUFDQyxZQUFQLENBQW9CVCxLQUFLLENBQUNVLE9BQU4sQ0FBYyxDQUFkLENBQXBCLENBQWhFLEdBQXdHLFNBRHpHO0FBR0E7QUE1QmMsS0FBaEI7QUE4QkEsR0FsQ0Q7O0FBb0NBLFNBQU87QUFFTjtBQUNBNUIsSUFBQUEsSUFBSSxFQUFFLGdCQUFXO0FBQ2hCQSxNQUFBQSxLQUFJO0FBQ0o7QUFMSyxHQUFQO0FBU0EsQ0EvQ3lDLEVBQTFDOztBQWlEQTZCLE1BQU0sQ0FBQ0MsUUFBRCxDQUFOLENBQWlCQyxLQUFqQixDQUF1QixZQUFXO0FBQ2pDaEMsRUFBQUEsbUNBQW1DLENBQUNDLElBQXBDO0FBQ0EsQ0FGRCIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL3Jlc291cmNlcy9tZXRyb25pYy9qcy9wYWdlcy9jcnVkL2RhdGF0YWJsZXMvYWR2YW5jZWQvZm9vdGVyLWNhbGxiYWNrLmpzP2Q0NzIiXSwic291cmNlc0NvbnRlbnQiOlsiXCJ1c2Ugc3RyaWN0XCI7XHJcbnZhciBLVERhdGF0YWJsZXNBZHZhbmNlZEZvb3RlckNhbGxsYmFjayA9IGZ1bmN0aW9uKCkge1xyXG5cclxuXHR2YXIgaW5pdCA9IGZ1bmN0aW9uKCkge1xyXG5cdFx0dmFyIHRhYmxlID0gJCgnI2t0X2RhdGF0YWJsZScpO1xyXG5cclxuXHRcdC8vIGJlZ2luIGZpcnN0IHRhYmxlXHJcblx0XHR0YWJsZS5EYXRhVGFibGUoe1xyXG5cdFx0XHRyZXNwb25zaXZlOiB0cnVlLFxyXG5cdFx0XHRwYWdlTGVuZ3RoOiA1LFxyXG5cdFx0XHRsZW5ndGhNZW51OiBbWzIsIDUsIDEwLCAxNSwgLTFdLCBbMiwgNSwgMTAsIDE1LCAnQWxsJ11dLFxyXG5cdFx0XHRmb290ZXJDYWxsYmFjazogZnVuY3Rpb24ocm93LCBkYXRhLCBzdGFydCwgZW5kLCBkaXNwbGF5KSB7XHJcblxyXG5cdFx0XHRcdHZhciBjb2x1bW4gPSA2O1xyXG5cdFx0XHRcdHZhciBhcGkgPSB0aGlzLmFwaSgpLCBkYXRhO1xyXG5cclxuXHRcdFx0XHQvLyBSZW1vdmUgdGhlIGZvcm1hdHRpbmcgdG8gZ2V0IGludGVnZXIgZGF0YSBmb3Igc3VtbWF0aW9uXHJcblx0XHRcdFx0dmFyIGludFZhbCA9IGZ1bmN0aW9uKGkpIHtcclxuXHRcdFx0XHRcdHJldHVybiB0eXBlb2YgaSA9PT0gJ3N0cmluZycgPyBpLnJlcGxhY2UoL1tcXCQsXS9nLCAnJykgKiAxIDogdHlwZW9mIGkgPT09ICdudW1iZXInID8gaSA6IDA7XHJcblx0XHRcdFx0fTtcclxuXHJcblx0XHRcdFx0Ly8gVG90YWwgb3ZlciBhbGwgcGFnZXNcclxuXHRcdFx0XHR2YXIgdG90YWwgPSBhcGkuY29sdW1uKGNvbHVtbikuZGF0YSgpLnJlZHVjZShmdW5jdGlvbihhLCBiKSB7XHJcblx0XHRcdFx0XHRyZXR1cm4gaW50VmFsKGEpICsgaW50VmFsKGIpO1xyXG5cdFx0XHRcdH0sIDApO1xyXG5cclxuXHRcdFx0XHQvLyBUb3RhbCBvdmVyIHRoaXMgcGFnZVxyXG5cdFx0XHRcdHZhciBwYWdlVG90YWwgPSBhcGkuY29sdW1uKGNvbHVtbiwge3BhZ2U6ICdjdXJyZW50J30pLmRhdGEoKS5yZWR1Y2UoZnVuY3Rpb24oYSwgYikge1xyXG5cdFx0XHRcdFx0cmV0dXJuIGludFZhbChhKSArIGludFZhbChiKTtcclxuXHRcdFx0XHR9LCAwKTtcclxuXHJcblx0XHRcdFx0Ly8gVXBkYXRlIGZvb3RlclxyXG5cdFx0XHRcdCQoYXBpLmNvbHVtbihjb2x1bW4pLmZvb3RlcigpKS5odG1sKFxyXG5cdFx0XHRcdFx0JyQnICsgS1RVdGlsLm51bWJlclN0cmluZyhwYWdlVG90YWwudG9GaXhlZCgyKSkgKyAnPGJyLz4gKCAkJyArIEtUVXRpbC5udW1iZXJTdHJpbmcodG90YWwudG9GaXhlZCgyKSkgKyAnIHRvdGFsKScsXHJcblx0XHRcdFx0KTtcclxuXHRcdFx0fSxcclxuXHRcdH0pO1xyXG5cdH07XHJcblxyXG5cdHJldHVybiB7XHJcblxyXG5cdFx0Ly9tYWluIGZ1bmN0aW9uIHRvIGluaXRpYXRlIHRoZSBtb2R1bGVcclxuXHRcdGluaXQ6IGZ1bmN0aW9uKCkge1xyXG5cdFx0XHRpbml0KCk7XHJcblx0XHR9LFxyXG5cclxuXHR9O1xyXG5cclxufSgpO1xyXG5cclxualF1ZXJ5KGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcclxuXHRLVERhdGF0YWJsZXNBZHZhbmNlZEZvb3RlckNhbGxsYmFjay5pbml0KCk7XHJcbn0pO1xyXG4iXSwibmFtZXMiOlsiS1REYXRhdGFibGVzQWR2YW5jZWRGb290ZXJDYWxsbGJhY2siLCJpbml0IiwidGFibGUiLCIkIiwiRGF0YVRhYmxlIiwicmVzcG9uc2l2ZSIsInBhZ2VMZW5ndGgiLCJsZW5ndGhNZW51IiwiZm9vdGVyQ2FsbGJhY2siLCJyb3ciLCJkYXRhIiwic3RhcnQiLCJlbmQiLCJkaXNwbGF5IiwiY29sdW1uIiwiYXBpIiwiaW50VmFsIiwiaSIsInJlcGxhY2UiLCJ0b3RhbCIsInJlZHVjZSIsImEiLCJiIiwicGFnZVRvdGFsIiwicGFnZSIsImZvb3RlciIsImh0bWwiLCJLVFV0aWwiLCJudW1iZXJTdHJpbmciLCJ0b0ZpeGVkIiwialF1ZXJ5IiwiZG9jdW1lbnQiLCJyZWFkeSJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/crud/datatables/advanced/footer-callback.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/metronic/js/pages/crud/datatables/advanced/footer-callback.js"]();
/******/ 	
/******/ })()
;