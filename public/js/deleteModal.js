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

/***/ "./resources/js/components/deleteModal.js":
/*!************************************************!*\
  !*** ./resources/js/components/deleteModal.js ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

eval("__webpack_require__.r(__webpack_exports__);\n/* harmony export */ __webpack_require__.d(__webpack_exports__, {\n/* harmony export */   openDeleteModal: () => (/* binding */ openDeleteModal)\n/* harmony export */ });\nvar deleteUrl;\n\n// Função para abrir o modal de confirmação\nfunction openDeleteModal(actionUrl) {\n  deleteUrl = actionUrl;\n  var deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));\n  deleteModal.show();\n}\n\n// Evento para o botão de confirmação no modal\ndocument.getElementById('deleteConfirmBtn').addEventListener('click', function () {\n  fetch(deleteUrl, {\n    method: 'DELETE',\n    headers: {\n      'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content'),\n      'Content-Type': 'application/json'\n    }\n  }).then(function (response) {\n    return response.json();\n  }).then(function (data) {\n    if (data.success) {\n      showToast(); // Exibe o toast de sucesso\n      setTimeout(function () {\n        return location.reload();\n      }, 2000); // Recarrega a página após 2 segundos\n    } else {\n      console.error('Erro ao excluir o item:', data.error);\n    }\n  })[\"catch\"](function (error) {\n    return console.error('Erro:', error);\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvY29tcG9uZW50cy9kZWxldGVNb2RhbC5qcyIsIm1hcHBpbmdzIjoiOzs7O0FBQUEsSUFBSUEsU0FBUzs7QUFFYjtBQUNPLFNBQVNDLGVBQWVBLENBQUNDLFNBQVMsRUFBRTtFQUN2Q0YsU0FBUyxHQUFHRSxTQUFTO0VBQ3JCLElBQU1DLFdBQVcsR0FBRyxJQUFJQyxTQUFTLENBQUNDLEtBQUssQ0FBQ0MsUUFBUSxDQUFDQyxjQUFjLENBQUMsb0JBQW9CLENBQUMsQ0FBQztFQUN0RkosV0FBVyxDQUFDSyxJQUFJLENBQUMsQ0FBQztBQUN0Qjs7QUFFQTtBQUNBRixRQUFRLENBQUNDLGNBQWMsQ0FBQyxrQkFBa0IsQ0FBQyxDQUFDRSxnQkFBZ0IsQ0FBQyxPQUFPLEVBQUUsWUFBVztFQUM3RUMsS0FBSyxDQUFDVixTQUFTLEVBQUU7SUFDYlcsTUFBTSxFQUFFLFFBQVE7SUFDaEJDLE9BQU8sRUFBRTtNQUNMLGNBQWMsRUFBRU4sUUFBUSxDQUFDTyxhQUFhLENBQUMseUJBQXlCLENBQUMsQ0FBQ0MsWUFBWSxDQUFDLFNBQVMsQ0FBQztNQUN6RixjQUFjLEVBQUU7SUFDcEI7RUFDSixDQUFDLENBQUMsQ0FDREMsSUFBSSxDQUFDLFVBQUFDLFFBQVE7SUFBQSxPQUFJQSxRQUFRLENBQUNDLElBQUksQ0FBQyxDQUFDO0VBQUEsRUFBQyxDQUNqQ0YsSUFBSSxDQUFDLFVBQUFHLElBQUksRUFBSTtJQUNWLElBQUlBLElBQUksQ0FBQ0MsT0FBTyxFQUFFO01BQ2RDLFNBQVMsQ0FBQyxDQUFDLENBQUMsQ0FBQztNQUNiQyxVQUFVLENBQUM7UUFBQSxPQUFNQyxRQUFRLENBQUNDLE1BQU0sQ0FBQyxDQUFDO01BQUEsR0FBRSxJQUFJLENBQUMsQ0FBQyxDQUFDO0lBQy9DLENBQUMsTUFBTTtNQUNIQyxPQUFPLENBQUNDLEtBQUssQ0FBQyx5QkFBeUIsRUFBRVAsSUFBSSxDQUFDTyxLQUFLLENBQUM7SUFDeEQ7RUFDSixDQUFDLENBQUMsU0FDSSxDQUFDLFVBQUFBLEtBQUs7SUFBQSxPQUFJRCxPQUFPLENBQUNDLEtBQUssQ0FBQyxPQUFPLEVBQUVBLEtBQUssQ0FBQztFQUFBLEVBQUM7QUFDbEQsQ0FBQyxDQUFDIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2pzL2NvbXBvbmVudHMvZGVsZXRlTW9kYWwuanM/MmFmOCJdLCJzb3VyY2VzQ29udGVudCI6WyJsZXQgZGVsZXRlVXJsO1xuXG4vLyBGdW7Dp8OjbyBwYXJhIGFicmlyIG8gbW9kYWwgZGUgY29uZmlybWHDp8Ojb1xuZXhwb3J0IGZ1bmN0aW9uIG9wZW5EZWxldGVNb2RhbChhY3Rpb25VcmwpIHtcbiAgICBkZWxldGVVcmwgPSBhY3Rpb25Vcmw7IFxuICAgIGNvbnN0IGRlbGV0ZU1vZGFsID0gbmV3IGJvb3RzdHJhcC5Nb2RhbChkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnY29uZmlybURlbGV0ZU1vZGFsJykpO1xuICAgIGRlbGV0ZU1vZGFsLnNob3coKTtcbn1cblxuLy8gRXZlbnRvIHBhcmEgbyBib3TDo28gZGUgY29uZmlybWHDp8OjbyBubyBtb2RhbFxuZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2RlbGV0ZUNvbmZpcm1CdG4nKS5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uKCkge1xuICAgIGZldGNoKGRlbGV0ZVVybCwge1xuICAgICAgICBtZXRob2Q6ICdERUxFVEUnLFxuICAgICAgICBoZWFkZXJzOiB7XG4gICAgICAgICAgICAnWC1DU1JGLVRPS0VOJzogZG9jdW1lbnQucXVlcnlTZWxlY3RvcignbWV0YVtuYW1lPVwiY3NyZi10b2tlblwiXScpLmdldEF0dHJpYnV0ZSgnY29udGVudCcpLFxuICAgICAgICAgICAgJ0NvbnRlbnQtVHlwZSc6ICdhcHBsaWNhdGlvbi9qc29uJ1xuICAgICAgICB9XG4gICAgfSlcbiAgICAudGhlbihyZXNwb25zZSA9PiByZXNwb25zZS5qc29uKCkpXG4gICAgLnRoZW4oZGF0YSA9PiB7XG4gICAgICAgIGlmIChkYXRhLnN1Y2Nlc3MpIHtcbiAgICAgICAgICAgIHNob3dUb2FzdCgpOyAvLyBFeGliZSBvIHRvYXN0IGRlIHN1Y2Vzc29cbiAgICAgICAgICAgIHNldFRpbWVvdXQoKCkgPT4gbG9jYXRpb24ucmVsb2FkKCksIDIwMDApOyAvLyBSZWNhcnJlZ2EgYSBww6FnaW5hIGFww7NzIDIgc2VndW5kb3NcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIGNvbnNvbGUuZXJyb3IoJ0Vycm8gYW8gZXhjbHVpciBvIGl0ZW06JywgZGF0YS5lcnJvcik7XG4gICAgICAgIH1cbiAgICB9KVxuICAgIC5jYXRjaChlcnJvciA9PiBjb25zb2xlLmVycm9yKCdFcnJvOicsIGVycm9yKSk7XG59KTsiXSwibmFtZXMiOlsiZGVsZXRlVXJsIiwib3BlbkRlbGV0ZU1vZGFsIiwiYWN0aW9uVXJsIiwiZGVsZXRlTW9kYWwiLCJib290c3RyYXAiLCJNb2RhbCIsImRvY3VtZW50IiwiZ2V0RWxlbWVudEJ5SWQiLCJzaG93IiwiYWRkRXZlbnRMaXN0ZW5lciIsImZldGNoIiwibWV0aG9kIiwiaGVhZGVycyIsInF1ZXJ5U2VsZWN0b3IiLCJnZXRBdHRyaWJ1dGUiLCJ0aGVuIiwicmVzcG9uc2UiLCJqc29uIiwiZGF0YSIsInN1Y2Nlc3MiLCJzaG93VG9hc3QiLCJzZXRUaW1lb3V0IiwibG9jYXRpb24iLCJyZWxvYWQiLCJjb25zb2xlIiwiZXJyb3IiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/components/deleteModal.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The require scope
/******/ 	var __webpack_require__ = {};
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/components/deleteModal.js"](0, __webpack_exports__, __webpack_require__);
/******/ 	
/******/ })()
;