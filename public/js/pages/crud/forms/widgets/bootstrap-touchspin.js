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

/***/ "./resources/metronic/js/pages/crud/forms/widgets/bootstrap-touchspin.js":
/*!*******************************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/forms/widgets/bootstrap-touchspin.js ***!
  \*******************************************************************************/
/***/ (() => {

eval(" // Class definition\n\nvar KTKBootstrapTouchspin = function () {\n  // Private functions\n  var demos = function demos() {\n    // minimum setup\n    $('#kt_touchspin_1, #kt_touchspin_2_1').TouchSpin({\n      buttondown_class: 'btn btn-secondary',\n      buttonup_class: 'btn btn-secondary',\n      min: 0,\n      max: 100,\n      step: 0.1,\n      decimals: 2,\n      boostat: 5,\n      maxboostedstep: 10\n    }); // with prefix\n\n    $('#kt_touchspin_2, #kt_touchspin_2_2').TouchSpin({\n      buttondown_class: 'btn btn-secondary',\n      buttonup_class: 'btn btn-secondary',\n      min: -1000000000,\n      max: 1000000000,\n      stepinterval: 50,\n      maxboostedstep: 10000000,\n      prefix: '$'\n    }); // vertical button alignment:\n\n    $('#kt_touchspin_3, #kt_touchspin_2_3').TouchSpin({\n      buttondown_class: 'btn btn-secondary',\n      buttonup_class: 'btn btn-secondary',\n      min: -1000000000,\n      max: 1000000000,\n      stepinterval: 50,\n      maxboostedstep: 10000000,\n      postfix: '$'\n    }); // vertical buttons with custom icons:\n\n    $('#kt_touchspin_4, #kt_touchspin_2_4').TouchSpin({\n      buttondown_class: 'btn btn-secondary',\n      buttonup_class: 'btn btn-secondary',\n      verticalbuttons: true,\n      verticalup: '<i class=\"ki ki-plus\"></i>',\n      verticaldown: '<i class=\"ki ki-minus\"></i>'\n    }); // vertical buttons with custom icons:\n\n    $('#kt_touchspin_5, #kt_touchspin_2_5').TouchSpin({\n      buttondown_class: 'btn btn-secondary',\n      buttonup_class: 'btn btn-secondary',\n      verticalbuttons: true,\n      verticalup: '<i class=\"ki ki-arrow-up\"></i>',\n      verticaldown: '<i class=\"ki ki-arrow-down\"></i>'\n    });\n  };\n\n  var validationStateDemos = function validationStateDemos() {\n    // validation state demos\n    $('#kt_touchspin_1_validate').TouchSpin({\n      buttondown_class: 'btn btn-secondary',\n      buttonup_class: 'btn btn-secondary',\n      min: -1000000000,\n      max: 1000000000,\n      stepinterval: 50,\n      maxboostedstep: 10000000,\n      prefix: '$'\n    }); // vertical buttons with custom icons:\n\n    $('#kt_touchspin_2_validate').TouchSpin({\n      buttondown_class: 'btn btn-secondary',\n      buttonup_class: 'btn btn-secondary',\n      min: 0,\n      max: 100,\n      step: 0.1,\n      decimals: 2,\n      boostat: 5,\n      maxboostedstep: 10\n    });\n    $('#kt_touchspin_3_validate').TouchSpin({\n      buttondown_class: 'btn btn-secondary',\n      buttonup_class: 'btn btn-secondary',\n      verticalbuttons: true,\n      verticalupclass: 'ki ki-plus',\n      verticaldownclass: 'ki ki-minus'\n    });\n  };\n\n  return {\n    // public functions\n    init: function init() {\n      demos();\n      validationStateDemos();\n    }\n  };\n}();\n\njQuery(document).ready(function () {\n  KTKBootstrapTouchspin.init();\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvbWV0cm9uaWMvanMvcGFnZXMvY3J1ZC9mb3Jtcy93aWRnZXRzL2Jvb3RzdHJhcC10b3VjaHNwaW4uanMuanMiLCJtYXBwaW5ncyI6IkNBQ0E7O0FBQ0EsSUFBSUEscUJBQXFCLEdBQUcsWUFBVztBQUVuQztBQUNBLE1BQUlDLEtBQUssR0FBRyxTQUFSQSxLQUFRLEdBQVc7QUFDbkI7QUFDQUMsSUFBQUEsQ0FBQyxDQUFDLG9DQUFELENBQUQsQ0FBd0NDLFNBQXhDLENBQWtEO0FBQzlDQyxNQUFBQSxnQkFBZ0IsRUFBRSxtQkFENEI7QUFFOUNDLE1BQUFBLGNBQWMsRUFBRSxtQkFGOEI7QUFJOUNDLE1BQUFBLEdBQUcsRUFBRSxDQUp5QztBQUs5Q0MsTUFBQUEsR0FBRyxFQUFFLEdBTHlDO0FBTTlDQyxNQUFBQSxJQUFJLEVBQUUsR0FOd0M7QUFPOUNDLE1BQUFBLFFBQVEsRUFBRSxDQVBvQztBQVE5Q0MsTUFBQUEsT0FBTyxFQUFFLENBUnFDO0FBUzlDQyxNQUFBQSxjQUFjLEVBQUU7QUFUOEIsS0FBbEQsRUFGbUIsQ0FjbkI7O0FBQ0FULElBQUFBLENBQUMsQ0FBQyxvQ0FBRCxDQUFELENBQXdDQyxTQUF4QyxDQUFrRDtBQUM5Q0MsTUFBQUEsZ0JBQWdCLEVBQUUsbUJBRDRCO0FBRTlDQyxNQUFBQSxjQUFjLEVBQUUsbUJBRjhCO0FBSTlDQyxNQUFBQSxHQUFHLEVBQUUsQ0FBQyxVQUp3QztBQUs5Q0MsTUFBQUEsR0FBRyxFQUFFLFVBTHlDO0FBTTlDSyxNQUFBQSxZQUFZLEVBQUUsRUFOZ0M7QUFPOUNELE1BQUFBLGNBQWMsRUFBRSxRQVA4QjtBQVE5Q0UsTUFBQUEsTUFBTSxFQUFFO0FBUnNDLEtBQWxELEVBZm1CLENBMEJuQjs7QUFDQVgsSUFBQUEsQ0FBQyxDQUFDLG9DQUFELENBQUQsQ0FBd0NDLFNBQXhDLENBQWtEO0FBQzlDQyxNQUFBQSxnQkFBZ0IsRUFBRSxtQkFENEI7QUFFOUNDLE1BQUFBLGNBQWMsRUFBRSxtQkFGOEI7QUFJOUNDLE1BQUFBLEdBQUcsRUFBRSxDQUFDLFVBSndDO0FBSzlDQyxNQUFBQSxHQUFHLEVBQUUsVUFMeUM7QUFNOUNLLE1BQUFBLFlBQVksRUFBRSxFQU5nQztBQU85Q0QsTUFBQUEsY0FBYyxFQUFFLFFBUDhCO0FBUTlDRyxNQUFBQSxPQUFPLEVBQUU7QUFScUMsS0FBbEQsRUEzQm1CLENBc0NuQjs7QUFDQVosSUFBQUEsQ0FBQyxDQUFDLG9DQUFELENBQUQsQ0FBd0NDLFNBQXhDLENBQWtEO0FBQzlDQyxNQUFBQSxnQkFBZ0IsRUFBRSxtQkFENEI7QUFFOUNDLE1BQUFBLGNBQWMsRUFBRSxtQkFGOEI7QUFHOUNVLE1BQUFBLGVBQWUsRUFBRSxJQUg2QjtBQUk5Q0MsTUFBQUEsVUFBVSxFQUFFLDRCQUprQztBQUs5Q0MsTUFBQUEsWUFBWSxFQUFFO0FBTGdDLEtBQWxELEVBdkNtQixDQStDbkI7O0FBQ0FmLElBQUFBLENBQUMsQ0FBQyxvQ0FBRCxDQUFELENBQXdDQyxTQUF4QyxDQUFrRDtBQUM5Q0MsTUFBQUEsZ0JBQWdCLEVBQUUsbUJBRDRCO0FBRTlDQyxNQUFBQSxjQUFjLEVBQUUsbUJBRjhCO0FBRzlDVSxNQUFBQSxlQUFlLEVBQUUsSUFINkI7QUFJOUNDLE1BQUFBLFVBQVUsRUFBRSxnQ0FKa0M7QUFLOUNDLE1BQUFBLFlBQVksRUFBRTtBQUxnQyxLQUFsRDtBQU9ILEdBdkREOztBQXlEQSxNQUFJQyxvQkFBb0IsR0FBRyxTQUF2QkEsb0JBQXVCLEdBQVc7QUFDbEM7QUFDQWhCLElBQUFBLENBQUMsQ0FBQywwQkFBRCxDQUFELENBQThCQyxTQUE5QixDQUF3QztBQUNwQ0MsTUFBQUEsZ0JBQWdCLEVBQUUsbUJBRGtCO0FBRXBDQyxNQUFBQSxjQUFjLEVBQUUsbUJBRm9CO0FBSXBDQyxNQUFBQSxHQUFHLEVBQUUsQ0FBQyxVQUo4QjtBQUtwQ0MsTUFBQUEsR0FBRyxFQUFFLFVBTCtCO0FBTXBDSyxNQUFBQSxZQUFZLEVBQUUsRUFOc0I7QUFPcENELE1BQUFBLGNBQWMsRUFBRSxRQVBvQjtBQVFwQ0UsTUFBQUEsTUFBTSxFQUFFO0FBUjRCLEtBQXhDLEVBRmtDLENBYWxDOztBQUNBWCxJQUFBQSxDQUFDLENBQUMsMEJBQUQsQ0FBRCxDQUE4QkMsU0FBOUIsQ0FBd0M7QUFDcENDLE1BQUFBLGdCQUFnQixFQUFFLG1CQURrQjtBQUVwQ0MsTUFBQUEsY0FBYyxFQUFFLG1CQUZvQjtBQUlwQ0MsTUFBQUEsR0FBRyxFQUFFLENBSitCO0FBS3BDQyxNQUFBQSxHQUFHLEVBQUUsR0FMK0I7QUFNcENDLE1BQUFBLElBQUksRUFBRSxHQU44QjtBQU9wQ0MsTUFBQUEsUUFBUSxFQUFFLENBUDBCO0FBUXBDQyxNQUFBQSxPQUFPLEVBQUUsQ0FSMkI7QUFTcENDLE1BQUFBLGNBQWMsRUFBRTtBQVRvQixLQUF4QztBQVlBVCxJQUFBQSxDQUFDLENBQUMsMEJBQUQsQ0FBRCxDQUE4QkMsU0FBOUIsQ0FBd0M7QUFDcENDLE1BQUFBLGdCQUFnQixFQUFFLG1CQURrQjtBQUVwQ0MsTUFBQUEsY0FBYyxFQUFFLG1CQUZvQjtBQUdwQ1UsTUFBQUEsZUFBZSxFQUFFLElBSG1CO0FBSXBDSSxNQUFBQSxlQUFlLEVBQUUsWUFKbUI7QUFLcENDLE1BQUFBLGlCQUFpQixFQUFFO0FBTGlCLEtBQXhDO0FBT0gsR0FqQ0Q7O0FBbUNBLFNBQU87QUFDSDtBQUNBQyxJQUFBQSxJQUFJLEVBQUUsZ0JBQVc7QUFDYnBCLE1BQUFBLEtBQUs7QUFDTGlCLE1BQUFBLG9CQUFvQjtBQUN2QjtBQUxFLEdBQVA7QUFPSCxDQXRHMkIsRUFBNUI7O0FBd0dBSSxNQUFNLENBQUNDLFFBQUQsQ0FBTixDQUFpQkMsS0FBakIsQ0FBdUIsWUFBVztBQUM5QnhCLEVBQUFBLHFCQUFxQixDQUFDcUIsSUFBdEI7QUFDSCxDQUZEIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL21ldHJvbmljL2pzL3BhZ2VzL2NydWQvZm9ybXMvd2lkZ2V0cy9ib290c3RyYXAtdG91Y2hzcGluLmpzP2JmZjIiXSwic291cmNlc0NvbnRlbnQiOlsiXCJ1c2Ugc3RyaWN0XCI7XHJcbi8vIENsYXNzIGRlZmluaXRpb25cclxudmFyIEtUS0Jvb3RzdHJhcFRvdWNoc3BpbiA9IGZ1bmN0aW9uKCkge1xyXG5cclxuICAgIC8vIFByaXZhdGUgZnVuY3Rpb25zXHJcbiAgICB2YXIgZGVtb3MgPSBmdW5jdGlvbigpIHtcclxuICAgICAgICAvLyBtaW5pbXVtIHNldHVwXHJcbiAgICAgICAgJCgnI2t0X3RvdWNoc3Bpbl8xLCAja3RfdG91Y2hzcGluXzJfMScpLlRvdWNoU3Bpbih7XHJcbiAgICAgICAgICAgIGJ1dHRvbmRvd25fY2xhc3M6ICdidG4gYnRuLXNlY29uZGFyeScsXHJcbiAgICAgICAgICAgIGJ1dHRvbnVwX2NsYXNzOiAnYnRuIGJ0bi1zZWNvbmRhcnknLFxyXG5cclxuICAgICAgICAgICAgbWluOiAwLFxyXG4gICAgICAgICAgICBtYXg6IDEwMCxcclxuICAgICAgICAgICAgc3RlcDogMC4xLFxyXG4gICAgICAgICAgICBkZWNpbWFsczogMixcclxuICAgICAgICAgICAgYm9vc3RhdDogNSxcclxuICAgICAgICAgICAgbWF4Ym9vc3RlZHN0ZXA6IDEwLFxyXG4gICAgICAgIH0pO1xyXG5cclxuICAgICAgICAvLyB3aXRoIHByZWZpeFxyXG4gICAgICAgICQoJyNrdF90b3VjaHNwaW5fMiwgI2t0X3RvdWNoc3Bpbl8yXzInKS5Ub3VjaFNwaW4oe1xyXG4gICAgICAgICAgICBidXR0b25kb3duX2NsYXNzOiAnYnRuIGJ0bi1zZWNvbmRhcnknLFxyXG4gICAgICAgICAgICBidXR0b251cF9jbGFzczogJ2J0biBidG4tc2Vjb25kYXJ5JyxcclxuXHJcbiAgICAgICAgICAgIG1pbjogLTEwMDAwMDAwMDAsXHJcbiAgICAgICAgICAgIG1heDogMTAwMDAwMDAwMCxcclxuICAgICAgICAgICAgc3RlcGludGVydmFsOiA1MCxcclxuICAgICAgICAgICAgbWF4Ym9vc3RlZHN0ZXA6IDEwMDAwMDAwLFxyXG4gICAgICAgICAgICBwcmVmaXg6ICckJ1xyXG4gICAgICAgIH0pO1xyXG5cclxuICAgICAgICAvLyB2ZXJ0aWNhbCBidXR0b24gYWxpZ25tZW50OlxyXG4gICAgICAgICQoJyNrdF90b3VjaHNwaW5fMywgI2t0X3RvdWNoc3Bpbl8yXzMnKS5Ub3VjaFNwaW4oe1xyXG4gICAgICAgICAgICBidXR0b25kb3duX2NsYXNzOiAnYnRuIGJ0bi1zZWNvbmRhcnknLFxyXG4gICAgICAgICAgICBidXR0b251cF9jbGFzczogJ2J0biBidG4tc2Vjb25kYXJ5JyxcclxuXHJcbiAgICAgICAgICAgIG1pbjogLTEwMDAwMDAwMDAsXHJcbiAgICAgICAgICAgIG1heDogMTAwMDAwMDAwMCxcclxuICAgICAgICAgICAgc3RlcGludGVydmFsOiA1MCxcclxuICAgICAgICAgICAgbWF4Ym9vc3RlZHN0ZXA6IDEwMDAwMDAwLFxyXG4gICAgICAgICAgICBwb3N0Zml4OiAnJCdcclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgLy8gdmVydGljYWwgYnV0dG9ucyB3aXRoIGN1c3RvbSBpY29uczpcclxuICAgICAgICAkKCcja3RfdG91Y2hzcGluXzQsICNrdF90b3VjaHNwaW5fMl80JykuVG91Y2hTcGluKHtcclxuICAgICAgICAgICAgYnV0dG9uZG93bl9jbGFzczogJ2J0biBidG4tc2Vjb25kYXJ5JyxcclxuICAgICAgICAgICAgYnV0dG9udXBfY2xhc3M6ICdidG4gYnRuLXNlY29uZGFyeScsXHJcbiAgICAgICAgICAgIHZlcnRpY2FsYnV0dG9uczogdHJ1ZSxcclxuICAgICAgICAgICAgdmVydGljYWx1cDogJzxpIGNsYXNzPVwia2kga2ktcGx1c1wiPjwvaT4nLFxyXG4gICAgICAgICAgICB2ZXJ0aWNhbGRvd246ICc8aSBjbGFzcz1cImtpIGtpLW1pbnVzXCI+PC9pPidcclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgLy8gdmVydGljYWwgYnV0dG9ucyB3aXRoIGN1c3RvbSBpY29uczpcclxuICAgICAgICAkKCcja3RfdG91Y2hzcGluXzUsICNrdF90b3VjaHNwaW5fMl81JykuVG91Y2hTcGluKHtcclxuICAgICAgICAgICAgYnV0dG9uZG93bl9jbGFzczogJ2J0biBidG4tc2Vjb25kYXJ5JyxcclxuICAgICAgICAgICAgYnV0dG9udXBfY2xhc3M6ICdidG4gYnRuLXNlY29uZGFyeScsXHJcbiAgICAgICAgICAgIHZlcnRpY2FsYnV0dG9uczogdHJ1ZSxcclxuICAgICAgICAgICAgdmVydGljYWx1cDogJzxpIGNsYXNzPVwia2kga2ktYXJyb3ctdXBcIj48L2k+JyxcclxuICAgICAgICAgICAgdmVydGljYWxkb3duOiAnPGkgY2xhc3M9XCJraSBraS1hcnJvdy1kb3duXCI+PC9pPidcclxuICAgICAgICB9KTtcclxuICAgIH1cclxuXHJcbiAgICB2YXIgdmFsaWRhdGlvblN0YXRlRGVtb3MgPSBmdW5jdGlvbigpIHtcclxuICAgICAgICAvLyB2YWxpZGF0aW9uIHN0YXRlIGRlbW9zXHJcbiAgICAgICAgJCgnI2t0X3RvdWNoc3Bpbl8xX3ZhbGlkYXRlJykuVG91Y2hTcGluKHtcclxuICAgICAgICAgICAgYnV0dG9uZG93bl9jbGFzczogJ2J0biBidG4tc2Vjb25kYXJ5JyxcclxuICAgICAgICAgICAgYnV0dG9udXBfY2xhc3M6ICdidG4gYnRuLXNlY29uZGFyeScsXHJcblxyXG4gICAgICAgICAgICBtaW46IC0xMDAwMDAwMDAwLFxyXG4gICAgICAgICAgICBtYXg6IDEwMDAwMDAwMDAsXHJcbiAgICAgICAgICAgIHN0ZXBpbnRlcnZhbDogNTAsXHJcbiAgICAgICAgICAgIG1heGJvb3N0ZWRzdGVwOiAxMDAwMDAwMCxcclxuICAgICAgICAgICAgcHJlZml4OiAnJCdcclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgLy8gdmVydGljYWwgYnV0dG9ucyB3aXRoIGN1c3RvbSBpY29uczpcclxuICAgICAgICAkKCcja3RfdG91Y2hzcGluXzJfdmFsaWRhdGUnKS5Ub3VjaFNwaW4oe1xyXG4gICAgICAgICAgICBidXR0b25kb3duX2NsYXNzOiAnYnRuIGJ0bi1zZWNvbmRhcnknLFxyXG4gICAgICAgICAgICBidXR0b251cF9jbGFzczogJ2J0biBidG4tc2Vjb25kYXJ5JyxcclxuXHJcbiAgICAgICAgICAgIG1pbjogMCxcclxuICAgICAgICAgICAgbWF4OiAxMDAsXHJcbiAgICAgICAgICAgIHN0ZXA6IDAuMSxcclxuICAgICAgICAgICAgZGVjaW1hbHM6IDIsXHJcbiAgICAgICAgICAgIGJvb3N0YXQ6IDUsXHJcbiAgICAgICAgICAgIG1heGJvb3N0ZWRzdGVwOiAxMCxcclxuICAgICAgICB9KTtcclxuXHJcbiAgICAgICAgJCgnI2t0X3RvdWNoc3Bpbl8zX3ZhbGlkYXRlJykuVG91Y2hTcGluKHtcclxuICAgICAgICAgICAgYnV0dG9uZG93bl9jbGFzczogJ2J0biBidG4tc2Vjb25kYXJ5JyxcclxuICAgICAgICAgICAgYnV0dG9udXBfY2xhc3M6ICdidG4gYnRuLXNlY29uZGFyeScsXHJcbiAgICAgICAgICAgIHZlcnRpY2FsYnV0dG9uczogdHJ1ZSxcclxuICAgICAgICAgICAgdmVydGljYWx1cGNsYXNzOiAna2kga2ktcGx1cycsXHJcbiAgICAgICAgICAgIHZlcnRpY2FsZG93bmNsYXNzOiAna2kga2ktbWludXMnXHJcbiAgICAgICAgfSk7XHJcbiAgICB9XHJcblxyXG4gICAgcmV0dXJuIHtcclxuICAgICAgICAvLyBwdWJsaWMgZnVuY3Rpb25zXHJcbiAgICAgICAgaW5pdDogZnVuY3Rpb24oKSB7XHJcbiAgICAgICAgICAgIGRlbW9zKCk7XHJcbiAgICAgICAgICAgIHZhbGlkYXRpb25TdGF0ZURlbW9zKCk7XHJcbiAgICAgICAgfVxyXG4gICAgfTtcclxufSgpO1xyXG5cclxualF1ZXJ5KGRvY3VtZW50KS5yZWFkeShmdW5jdGlvbigpIHtcclxuICAgIEtUS0Jvb3RzdHJhcFRvdWNoc3Bpbi5pbml0KCk7XHJcbn0pO1xyXG4iXSwibmFtZXMiOlsiS1RLQm9vdHN0cmFwVG91Y2hzcGluIiwiZGVtb3MiLCIkIiwiVG91Y2hTcGluIiwiYnV0dG9uZG93bl9jbGFzcyIsImJ1dHRvbnVwX2NsYXNzIiwibWluIiwibWF4Iiwic3RlcCIsImRlY2ltYWxzIiwiYm9vc3RhdCIsIm1heGJvb3N0ZWRzdGVwIiwic3RlcGludGVydmFsIiwicHJlZml4IiwicG9zdGZpeCIsInZlcnRpY2FsYnV0dG9ucyIsInZlcnRpY2FsdXAiLCJ2ZXJ0aWNhbGRvd24iLCJ2YWxpZGF0aW9uU3RhdGVEZW1vcyIsInZlcnRpY2FsdXBjbGFzcyIsInZlcnRpY2FsZG93bmNsYXNzIiwiaW5pdCIsImpRdWVyeSIsImRvY3VtZW50IiwicmVhZHkiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/metronic/js/pages/crud/forms/widgets/bootstrap-touchspin.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/metronic/js/pages/crud/forms/widgets/bootstrap-touchspin.js"]();
/******/ 	
/******/ })()
;