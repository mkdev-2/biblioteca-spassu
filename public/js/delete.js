/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/delete.js":
/*!********************************!*\
  !*** ./resources/js/delete.js ***!
  \********************************/
/***/ (() => {

eval("var deleteUrl;\n\n// Função para abrir o modal de confirmação\nfunction openDeleteModal(actionUrl) {\n  deleteUrl = actionUrl;\n  var deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));\n  deleteModal.show();\n}\n\n// Evento para o botão de confirmação no modal\ndocument.getElementById('deleteConfirmBtn').addEventListener('click', function () {\n  fetch(deleteUrl, {\n    method: 'DELETE',\n    headers: {\n      'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content'),\n      'Content-Type': 'application/json'\n    }\n  }).then(function (response) {\n    return response.json();\n  }).then(function (data) {\n    if (data.success) {\n      showToast(); // Exibe o toast de sucesso\n      setTimeout(function () {\n        return location.reload();\n      }, 2000); // Recarrega a página após 2 segundos\n    } else {\n      console.error('Erro ao excluir o item:', data.error);\n    }\n  })[\"catch\"](function (error) {\n    return console.error('Erro:', error);\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6WyJkZWxldGVVcmwiLCJvcGVuRGVsZXRlTW9kYWwiLCJhY3Rpb25VcmwiLCJkZWxldGVNb2RhbCIsImJvb3RzdHJhcCIsIk1vZGFsIiwiZG9jdW1lbnQiLCJnZXRFbGVtZW50QnlJZCIsInNob3ciLCJhZGRFdmVudExpc3RlbmVyIiwiZmV0Y2giLCJtZXRob2QiLCJoZWFkZXJzIiwicXVlcnlTZWxlY3RvciIsImdldEF0dHJpYnV0ZSIsInRoZW4iLCJyZXNwb25zZSIsImpzb24iLCJkYXRhIiwic3VjY2VzcyIsInNob3dUb2FzdCIsInNldFRpbWVvdXQiLCJsb2NhdGlvbiIsInJlbG9hZCIsImNvbnNvbGUiLCJlcnJvciJdLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvZGVsZXRlLmpzPzZjMTEiXSwic291cmNlc0NvbnRlbnQiOlsibGV0IGRlbGV0ZVVybDtcblxuLy8gRnVuw6fDo28gcGFyYSBhYnJpciBvIG1vZGFsIGRlIGNvbmZpcm1hw6fDo29cbmZ1bmN0aW9uIG9wZW5EZWxldGVNb2RhbChhY3Rpb25VcmwpIHtcbiAgICBkZWxldGVVcmwgPSBhY3Rpb25Vcmw7IFxuICAgIGNvbnN0IGRlbGV0ZU1vZGFsID0gbmV3IGJvb3RzdHJhcC5Nb2RhbChkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnY29uZmlybURlbGV0ZU1vZGFsJykpO1xuICAgIGRlbGV0ZU1vZGFsLnNob3coKTtcbn1cblxuLy8gRXZlbnRvIHBhcmEgbyBib3TDo28gZGUgY29uZmlybWHDp8OjbyBubyBtb2RhbFxuZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ2RlbGV0ZUNvbmZpcm1CdG4nKS5hZGRFdmVudExpc3RlbmVyKCdjbGljaycsIGZ1bmN0aW9uKCkge1xuICAgIGZldGNoKGRlbGV0ZVVybCwge1xuICAgICAgICBtZXRob2Q6ICdERUxFVEUnLFxuICAgICAgICBoZWFkZXJzOiB7XG4gICAgICAgICAgICAnWC1DU1JGLVRPS0VOJzogZG9jdW1lbnQucXVlcnlTZWxlY3RvcignbWV0YVtuYW1lPVwiY3NyZi10b2tlblwiXScpLmdldEF0dHJpYnV0ZSgnY29udGVudCcpLFxuICAgICAgICAgICAgJ0NvbnRlbnQtVHlwZSc6ICdhcHBsaWNhdGlvbi9qc29uJ1xuICAgICAgICB9XG4gICAgfSlcbiAgICAudGhlbihyZXNwb25zZSA9PiByZXNwb25zZS5qc29uKCkpXG4gICAgLnRoZW4oZGF0YSA9PiB7XG4gICAgICAgIGlmIChkYXRhLnN1Y2Nlc3MpIHtcbiAgICAgICAgICAgIHNob3dUb2FzdCgpOyAvLyBFeGliZSBvIHRvYXN0IGRlIHN1Y2Vzc29cbiAgICAgICAgICAgIHNldFRpbWVvdXQoKCkgPT4gbG9jYXRpb24ucmVsb2FkKCksIDIwMDApOyAvLyBSZWNhcnJlZ2EgYSBww6FnaW5hIGFww7NzIDIgc2VndW5kb3NcbiAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgIGNvbnNvbGUuZXJyb3IoJ0Vycm8gYW8gZXhjbHVpciBvIGl0ZW06JywgZGF0YS5lcnJvcik7XG4gICAgICAgIH1cbiAgICB9KVxuICAgIC5jYXRjaChlcnJvciA9PiBjb25zb2xlLmVycm9yKCdFcnJvOicsIGVycm9yKSk7XG59KTsiXSwibWFwcGluZ3MiOiJBQUFBLElBQUlBLFNBQVM7O0FBRWI7QUFDQSxTQUFTQyxlQUFlQSxDQUFDQyxTQUFTLEVBQUU7RUFDaENGLFNBQVMsR0FBR0UsU0FBUztFQUNyQixJQUFNQyxXQUFXLEdBQUcsSUFBSUMsU0FBUyxDQUFDQyxLQUFLLENBQUNDLFFBQVEsQ0FBQ0MsY0FBYyxDQUFDLG9CQUFvQixDQUFDLENBQUM7RUFDdEZKLFdBQVcsQ0FBQ0ssSUFBSSxDQUFDLENBQUM7QUFDdEI7O0FBRUE7QUFDQUYsUUFBUSxDQUFDQyxjQUFjLENBQUMsa0JBQWtCLENBQUMsQ0FBQ0UsZ0JBQWdCLENBQUMsT0FBTyxFQUFFLFlBQVc7RUFDN0VDLEtBQUssQ0FBQ1YsU0FBUyxFQUFFO0lBQ2JXLE1BQU0sRUFBRSxRQUFRO0lBQ2hCQyxPQUFPLEVBQUU7TUFDTCxjQUFjLEVBQUVOLFFBQVEsQ0FBQ08sYUFBYSxDQUFDLHlCQUF5QixDQUFDLENBQUNDLFlBQVksQ0FBQyxTQUFTLENBQUM7TUFDekYsY0FBYyxFQUFFO0lBQ3BCO0VBQ0osQ0FBQyxDQUFDLENBQ0RDLElBQUksQ0FBQyxVQUFBQyxRQUFRO0lBQUEsT0FBSUEsUUFBUSxDQUFDQyxJQUFJLENBQUMsQ0FBQztFQUFBLEVBQUMsQ0FDakNGLElBQUksQ0FBQyxVQUFBRyxJQUFJLEVBQUk7SUFDVixJQUFJQSxJQUFJLENBQUNDLE9BQU8sRUFBRTtNQUNkQyxTQUFTLENBQUMsQ0FBQyxDQUFDLENBQUM7TUFDYkMsVUFBVSxDQUFDO1FBQUEsT0FBTUMsUUFBUSxDQUFDQyxNQUFNLENBQUMsQ0FBQztNQUFBLEdBQUUsSUFBSSxDQUFDLENBQUMsQ0FBQztJQUMvQyxDQUFDLE1BQU07TUFDSEMsT0FBTyxDQUFDQyxLQUFLLENBQUMseUJBQXlCLEVBQUVQLElBQUksQ0FBQ08sS0FBSyxDQUFDO0lBQ3hEO0VBQ0osQ0FBQyxDQUFDLFNBQ0ksQ0FBQyxVQUFBQSxLQUFLO0lBQUEsT0FBSUQsT0FBTyxDQUFDQyxLQUFLLENBQUMsT0FBTyxFQUFFQSxLQUFLLENBQUM7RUFBQSxFQUFDO0FBQ2xELENBQUMsQ0FBQyIsImlnbm9yZUxpc3QiOltdLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvZGVsZXRlLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/delete.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/delete.js"]();
/******/ 	
/******/ })()
;