/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
(self["webpackChunk"] = self["webpackChunk"] || []).push([["/sanity/js/sanity-app"],{

/***/ "./resources/platform/assets/js/Sanity/app/SanityStudio.js":
/*!*****************************************************************!*\
  !*** ./resources/platform/assets/js/Sanity/app/SanityStudio.js ***!
  \*****************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ \"./node_modules/react/index.js\");\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var sanity__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! sanity */ \"./node_modules/sanity/lib/index.mjs\");\n/* harmony import */ var sanity_structure__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! sanity/structure */ \"./node_modules/sanity/lib/_chunks-es/pane.mjs\");\n/* harmony import */ var _components_CustomInput__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../components/CustomInput */ \"./resources/platform/assets/js/Sanity/components/CustomInput.js\");\n/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react/jsx-runtime */ \"./node_modules/react/jsx-runtime.js\");\n\n\n\n\n\nvar SanityStudio = function SanityStudio(_ref) {\n  var projectId = _ref.projectId,\n    dataset = _ref.dataset,\n    basePath = _ref.basePath;\n  var sanityContainerRef = react__WEBPACK_IMPORTED_MODULE_0___default().useRef(null); // Create a ref for the Sanity container\n\n  react__WEBPACK_IMPORTED_MODULE_0___default().useEffect(function () {\n    if (sanityContainerRef.current) {\n      var config = (0,sanity__WEBPACK_IMPORTED_MODULE_3__.defineConfig)({\n        plugins: [(0,sanity_structure__WEBPACK_IMPORTED_MODULE_4__.t)()],\n        projectId: projectId,\n        dataset: dataset,\n        basePath: basePath,\n        schema: {\n          types: [{\n            type: \"document\",\n            name: \"post\",\n            title: \"Post\",\n            fields: [{\n              type: \"string\",\n              name: \"title\",\n              title: \"Title\"\n            }, {\n              name: 'myCustomField',\n              title: 'My Custom Field',\n              type: 'string',\n              inputComponent: _components_CustomInput__WEBPACK_IMPORTED_MODULE_1__[\"default\"]\n            }]\n          }]\n        }\n      });\n      (0,sanity__WEBPACK_IMPORTED_MODULE_3__.renderStudio)(sanityContainerRef.current, config); // Render Sanity Studio into the ref'd container\n    }\n  }, [projectId, dataset, basePath]); // Depend on props to re-render\n\n  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(\"div\", {\n    ref: sanityContainerRef\n  }); // Assign the ref to a div dedicated to Sanity\n};\n/* harmony default export */ __webpack_exports__[\"default\"] = (SanityStudio);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvcGxhdGZvcm0vYXNzZXRzL2pzL1Nhbml0eS9hcHAvU2FuaXR5U3R1ZGlvLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7QUFBMEI7QUFDMEI7QUFDTjtBQUNNO0FBQUE7QUFFcEQsSUFBTU8sWUFBWSxHQUFHLFNBQWZBLFlBQVlBLENBQUFDLElBQUEsRUFBeUM7RUFBQSxJQUFuQ0MsU0FBUyxHQUFBRCxJQUFBLENBQVRDLFNBQVM7SUFBRUMsT0FBTyxHQUFBRixJQUFBLENBQVBFLE9BQU87SUFBRUMsUUFBUSxHQUFBSCxJQUFBLENBQVJHLFFBQVE7RUFDbEQsSUFBTUMsa0JBQWtCLEdBQUdaLG1EQUFZLENBQUMsSUFBSSxDQUFDLENBQUMsQ0FBRTs7RUFFaERBLHNEQUFlLENBQUMsWUFBTTtJQUNwQixJQUFJWSxrQkFBa0IsQ0FBQ0csT0FBTyxFQUFFO01BQzlCLElBQU1DLE1BQU0sR0FBR2Qsb0RBQVksQ0FBQztRQUN0QmUsT0FBTyxFQUFFLENBQ0xkLG1EQUFhLENBQUMsQ0FBQyxDQUNsQjtRQUNETSxTQUFTLEVBQUVBLFNBQVM7UUFDcEJDLE9BQU8sRUFBRUEsT0FBTztRQUNoQkMsUUFBUSxFQUFFQSxRQUFRO1FBQ2xCTyxNQUFNLEVBQUU7VUFDSkMsS0FBSyxFQUFFLENBQ0g7WUFDSUMsSUFBSSxFQUFFLFVBQVU7WUFDaEJDLElBQUksRUFBRSxNQUFNO1lBQ1pDLEtBQUssRUFBRSxNQUFNO1lBQ2JDLE1BQU0sRUFBRSxDQUNKO2NBQ0lILElBQUksRUFBRSxRQUFRO2NBQ2RDLElBQUksRUFBRSxPQUFPO2NBQ2JDLEtBQUssRUFBRTtZQUNYLENBQUMsRUFDRDtjQUNJRCxJQUFJLEVBQUUsZUFBZTtjQUNyQkMsS0FBSyxFQUFFLGlCQUFpQjtjQUN4QkYsSUFBSSxFQUFFLFFBQVE7Y0FDZEksY0FBYyxFQUFFcEIsK0RBQVdBO1lBQy9CLENBQUM7VUFFVCxDQUFDO1FBRVQ7TUFDSixDQUFDLENBQUM7TUFDRkgsb0RBQVksQ0FBQ1csa0JBQWtCLENBQUNHLE9BQU8sRUFBRUMsTUFBTSxDQUFDLENBQUMsQ0FBRTtJQUN2RDtFQUNGLENBQUMsRUFBRSxDQUFDUCxTQUFTLEVBQUVDLE9BQU8sRUFBRUMsUUFBUSxDQUFDLENBQUMsQ0FBQyxDQUFDOztFQUVwQyxvQkFBT0wsc0RBQUE7SUFBS21CLEdBQUcsRUFBRWI7RUFBbUIsQ0FBTSxDQUFDLENBQUMsQ0FBRTtBQUNoRCxDQUFDO0FBRUQsK0RBQWVMLFlBQVkiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvcGxhdGZvcm0vYXNzZXRzL2pzL1Nhbml0eS9hcHAvU2FuaXR5U3R1ZGlvLmpzPzRiMGEiXSwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IFJlYWN0IGZyb20gJ3JlYWN0JztcbmltcG9ydCB7IHJlbmRlclN0dWRpbywgZGVmaW5lQ29uZmlnIH0gZnJvbSBcInNhbml0eVwiO1xuaW1wb3J0IHtzdHJ1Y3R1cmVUb29sfSBmcm9tICdzYW5pdHkvc3RydWN0dXJlJ1xuaW1wb3J0IEN1c3RvbUlucHV0IGZyb20gJy4uL2NvbXBvbmVudHMvQ3VzdG9tSW5wdXQnOyAgXG5cbmNvbnN0IFNhbml0eVN0dWRpbyA9ICh7IHByb2plY3RJZCwgZGF0YXNldCwgYmFzZVBhdGggfSkgPT4ge1xuICBjb25zdCBzYW5pdHlDb250YWluZXJSZWYgPSBSZWFjdC51c2VSZWYobnVsbCk7ICAvLyBDcmVhdGUgYSByZWYgZm9yIHRoZSBTYW5pdHkgY29udGFpbmVyXG5cbiAgUmVhY3QudXNlRWZmZWN0KCgpID0+IHtcbiAgICBpZiAoc2FuaXR5Q29udGFpbmVyUmVmLmN1cnJlbnQpIHtcbiAgICAgIGNvbnN0IGNvbmZpZyA9IGRlZmluZUNvbmZpZyh7XG4gICAgICAgICAgICBwbHVnaW5zOiBbXG4gICAgICAgICAgICAgICAgc3RydWN0dXJlVG9vbCgpXG4gICAgICAgICAgICBdLFxuICAgICAgICAgICAgcHJvamVjdElkOiBwcm9qZWN0SWQsXG4gICAgICAgICAgICBkYXRhc2V0OiBkYXRhc2V0LFxuICAgICAgICAgICAgYmFzZVBhdGg6IGJhc2VQYXRoLFxuICAgICAgICAgICAgc2NoZW1hOiB7XG4gICAgICAgICAgICAgICAgdHlwZXM6IFtcbiAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgdHlwZTogXCJkb2N1bWVudFwiLFxuICAgICAgICAgICAgICAgICAgICAgICAgbmFtZTogXCJwb3N0XCIsXG4gICAgICAgICAgICAgICAgICAgICAgICB0aXRsZTogXCJQb3N0XCIsXG4gICAgICAgICAgICAgICAgICAgICAgICBmaWVsZHM6IFtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICB7XG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHR5cGU6IFwic3RyaW5nXCIsXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIG5hbWU6IFwidGl0bGVcIixcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgdGl0bGU6IFwiVGl0bGVcIlxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH0sXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAge1xuICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBuYW1lOiAnbXlDdXN0b21GaWVsZCcsXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHRpdGxlOiAnTXkgQ3VzdG9tIEZpZWxkJyxcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgdHlwZTogJ3N0cmluZycsXG4gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGlucHV0Q29tcG9uZW50OiBDdXN0b21JbnB1dFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgICAgIF1cbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgIF1cbiAgICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgICAgIHJlbmRlclN0dWRpbyhzYW5pdHlDb250YWluZXJSZWYuY3VycmVudCwgY29uZmlnKTsgIC8vIFJlbmRlciBTYW5pdHkgU3R1ZGlvIGludG8gdGhlIHJlZidkIGNvbnRhaW5lclxuICAgIH1cbiAgfSwgW3Byb2plY3RJZCwgZGF0YXNldCwgYmFzZVBhdGhdKTsgLy8gRGVwZW5kIG9uIHByb3BzIHRvIHJlLXJlbmRlclxuXG4gIHJldHVybiA8ZGl2IHJlZj17c2FuaXR5Q29udGFpbmVyUmVmfT48L2Rpdj47ICAvLyBBc3NpZ24gdGhlIHJlZiB0byBhIGRpdiBkZWRpY2F0ZWQgdG8gU2FuaXR5XG59O1xuXG5leHBvcnQgZGVmYXVsdCBTYW5pdHlTdHVkaW87XG4iXSwibmFtZXMiOlsiUmVhY3QiLCJyZW5kZXJTdHVkaW8iLCJkZWZpbmVDb25maWciLCJzdHJ1Y3R1cmVUb29sIiwiQ3VzdG9tSW5wdXQiLCJqc3giLCJfanN4IiwiU2FuaXR5U3R1ZGlvIiwiX3JlZiIsInByb2plY3RJZCIsImRhdGFzZXQiLCJiYXNlUGF0aCIsInNhbml0eUNvbnRhaW5lclJlZiIsInVzZVJlZiIsInVzZUVmZmVjdCIsImN1cnJlbnQiLCJjb25maWciLCJwbHVnaW5zIiwic2NoZW1hIiwidHlwZXMiLCJ0eXBlIiwibmFtZSIsInRpdGxlIiwiZmllbGRzIiwiaW5wdXRDb21wb25lbnQiLCJyZWYiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/platform/assets/js/Sanity/app/SanityStudio.js\n");

/***/ }),

/***/ "./resources/platform/assets/js/Sanity/components/CustomInput.js":
/*!***********************************************************************!*\
  !*** ./resources/platform/assets/js/Sanity/components/CustomInput.js ***!
  \***********************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ \"./node_modules/react/index.js\");\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react/jsx-runtime */ \"./node_modules/react/jsx-runtime.js\");\n\n\n\nvar CustomInput = /*#__PURE__*/react__WEBPACK_IMPORTED_MODULE_0___default().forwardRef(function (props, ref) {\n  var _props$type;\n  var title = ((_props$type = props.type) === null || _props$type === void 0 ? void 0 : _props$type.title) || 'Default Title';\n  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)(\"div\", {\n    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(\"label\", {\n      children: title\n    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)(\"input\", {\n      ref: ref,\n      type: \"text\",\n      value: props.value || '',\n      onChange: function onChange(event) {\n        return props.onChange(event.target.value);\n      }\n    })]\n  });\n});\n/* harmony default export */ __webpack_exports__[\"default\"] = (CustomInput);//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvcGxhdGZvcm0vYXNzZXRzL2pzL1Nhbml0eS9jb21wb25lbnRzL0N1c3RvbUlucHV0LmpzIiwibWFwcGluZ3MiOiI7Ozs7QUFBMEI7QUFBQTtBQUFBO0FBRTFCLElBQU1LLFdBQVcsZ0JBQUdMLHVEQUFnQixDQUFDLFVBQUNPLEtBQUssRUFBRUMsR0FBRyxFQUFLO0VBQUEsSUFBQUMsV0FBQTtFQUNqRCxJQUFNQyxLQUFLLEdBQUcsRUFBQUQsV0FBQSxHQUFBRixLQUFLLENBQUNJLElBQUksY0FBQUYsV0FBQSx1QkFBVkEsV0FBQSxDQUFZQyxLQUFLLEtBQUksZUFBZTtFQUVsRCxvQkFDSU4sdURBQUE7SUFBQVEsUUFBQSxnQkFDSVYsc0RBQUE7TUFBQVUsUUFBQSxFQUFRRjtJQUFLLENBQVEsQ0FBQyxlQUN0QlIsc0RBQUE7TUFDSU0sR0FBRyxFQUFFQSxHQUFJO01BQ1RHLElBQUksRUFBQyxNQUFNO01BQ1hFLEtBQUssRUFBRU4sS0FBSyxDQUFDTSxLQUFLLElBQUksRUFBRztNQUN6QkMsUUFBUSxFQUFFLFNBQUFBLFNBQUNDLEtBQUs7UUFBQSxPQUFLUixLQUFLLENBQUNPLFFBQVEsQ0FBQ0MsS0FBSyxDQUFDQyxNQUFNLENBQUNILEtBQUssQ0FBQztNQUFBO0lBQUMsQ0FDM0QsQ0FBQztFQUFBLENBQ0QsQ0FBQztBQUVkLENBQUMsQ0FBQztBQUVGLCtEQUFlUixXQUFXIiwic291cmNlcyI6WyJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL3BsYXRmb3JtL2Fzc2V0cy9qcy9TYW5pdHkvY29tcG9uZW50cy9DdXN0b21JbnB1dC5qcz8yYzU1Il0sInNvdXJjZXNDb250ZW50IjpbImltcG9ydCBSZWFjdCBmcm9tICdyZWFjdCc7XG5cbmNvbnN0IEN1c3RvbUlucHV0ID0gUmVhY3QuZm9yd2FyZFJlZigocHJvcHMsIHJlZikgPT4ge1xuICAgIGNvbnN0IHRpdGxlID0gcHJvcHMudHlwZT8udGl0bGUgfHwgJ0RlZmF1bHQgVGl0bGUnO1xuXG4gICAgcmV0dXJuIChcbiAgICAgICAgPGRpdj5cbiAgICAgICAgICAgIDxsYWJlbD57dGl0bGV9PC9sYWJlbD5cbiAgICAgICAgICAgIDxpbnB1dFxuICAgICAgICAgICAgICAgIHJlZj17cmVmfVxuICAgICAgICAgICAgICAgIHR5cGU9XCJ0ZXh0XCJcbiAgICAgICAgICAgICAgICB2YWx1ZT17cHJvcHMudmFsdWUgfHwgJyd9XG4gICAgICAgICAgICAgICAgb25DaGFuZ2U9eyhldmVudCkgPT4gcHJvcHMub25DaGFuZ2UoZXZlbnQudGFyZ2V0LnZhbHVlKX1cbiAgICAgICAgICAgIC8+XG4gICAgICAgIDwvZGl2PlxuICAgICk7XG59KTtcblxuZXhwb3J0IGRlZmF1bHQgQ3VzdG9tSW5wdXQ7Il0sIm5hbWVzIjpbIlJlYWN0IiwianN4IiwiX2pzeCIsImpzeHMiLCJfanN4cyIsIkN1c3RvbUlucHV0IiwiZm9yd2FyZFJlZiIsInByb3BzIiwicmVmIiwiX3Byb3BzJHR5cGUiLCJ0aXRsZSIsInR5cGUiLCJjaGlsZHJlbiIsInZhbHVlIiwib25DaGFuZ2UiLCJldmVudCIsInRhcmdldCJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/platform/assets/js/Sanity/components/CustomInput.js\n");

/***/ }),

/***/ "./resources/platform/assets/js/Sanity/sanity-app.js":
/*!***********************************************************!*\
  !*** ./resources/platform/assets/js/Sanity/sanity-app.js ***!
  \***********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ \"./node_modules/react/index.js\");\n/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);\n/* harmony import */ var react_dom__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom */ \"./node_modules/react-dom/index.js\");\n/* harmony import */ var _app_SanityStudio__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./app/SanityStudio */ \"./resources/platform/assets/js/Sanity/app/SanityStudio.js\");\n/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react/jsx-runtime */ \"./node_modules/react/jsx-runtime.js\");\nfunction _typeof(o) { \"@babel/helpers - typeof\"; return _typeof = \"function\" == typeof Symbol && \"symbol\" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && \"function\" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? \"symbol\" : typeof o; }, _typeof(o); }\nfunction ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }\nfunction _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }\nfunction _defineProperty(obj, key, value) { key = _toPropertyKey(key); if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }\nfunction _toPropertyKey(t) { var i = _toPrimitive(t, \"string\"); return \"symbol\" == _typeof(i) ? i : String(i); }\nfunction _toPrimitive(t, r) { if (\"object\" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || \"default\"); if (\"object\" != _typeof(i)) return i; throw new TypeError(\"@@toPrimitive must return a primitive value.\"); } return (\"string\" === r ? String : Number)(t); }\n\n\n\n\nvar props = window.SanityConfig; // Assuming you've made LaravelData available globally\n\nreact_dom__WEBPACK_IMPORTED_MODULE_1__.render( /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(_app_SanityStudio__WEBPACK_IMPORTED_MODULE_2__[\"default\"], _objectSpread({}, props)), document.getElementById('sanity-app'));//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiLi9yZXNvdXJjZXMvcGxhdGZvcm0vYXNzZXRzL2pzL1Nhbml0eS9zYW5pdHktYXBwLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7OztBQUEwQjtBQUNPO0FBQ2E7QUFBQTtBQUU5QyxJQUFNSyxLQUFLLEdBQUdDLE1BQU0sQ0FBQ0MsWUFBWSxDQUFDLENBQUM7O0FBRW5DTiw2Q0FBZSxlQUNiRyxzREFBQSxDQUFDRix5REFBWSxFQUFBTyxhQUFBLEtBQUtKLEtBQUssQ0FBRyxDQUFDLEVBQzNCSyxRQUFRLENBQUNDLGNBQWMsQ0FBQyxZQUFZLENBQ3RDLENBQUMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvcGxhdGZvcm0vYXNzZXRzL2pzL1Nhbml0eS9zYW5pdHktYXBwLmpzPzAwMWMiXSwic291cmNlc0NvbnRlbnQiOlsiaW1wb3J0IFJlYWN0IGZyb20gJ3JlYWN0JztcbmltcG9ydCBSZWFjdERPTSBmcm9tICdyZWFjdC1kb20nO1xuaW1wb3J0IFNhbml0eVN0dWRpbyBmcm9tICcuL2FwcC9TYW5pdHlTdHVkaW8nO1xuXG5jb25zdCBwcm9wcyA9IHdpbmRvdy5TYW5pdHlDb25maWc7IC8vIEFzc3VtaW5nIHlvdSd2ZSBtYWRlIExhcmF2ZWxEYXRhIGF2YWlsYWJsZSBnbG9iYWxseVxuXG5SZWFjdERPTS5yZW5kZXIoXG4gIDxTYW5pdHlTdHVkaW8gey4uLnByb3BzfSAvPixcbiAgZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3Nhbml0eS1hcHAnKVxuKTsiXSwibmFtZXMiOlsiUmVhY3QiLCJSZWFjdERPTSIsIlNhbml0eVN0dWRpbyIsImpzeCIsIl9qc3giLCJwcm9wcyIsIndpbmRvdyIsIlNhbml0eUNvbmZpZyIsInJlbmRlciIsIl9vYmplY3RTcHJlYWQiLCJkb2N1bWVudCIsImdldEVsZW1lbnRCeUlkIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/platform/assets/js/Sanity/sanity-app.js\n");

/***/ }),

/***/ "./node_modules/moment/locale sync recursive ^\\.\\/.*$":
/*!***************************************************!*\
  !*** ./node_modules/moment/locale/ sync ^\.\/.*$ ***!
  \***************************************************/
/***/ (function(module, __unused_webpack_exports, __webpack_require__) {

var map = {
	"./af": "./node_modules/moment/locale/af.js",
	"./af.js": "./node_modules/moment/locale/af.js",
	"./ar": "./node_modules/moment/locale/ar.js",
	"./ar-dz": "./node_modules/moment/locale/ar-dz.js",
	"./ar-dz.js": "./node_modules/moment/locale/ar-dz.js",
	"./ar-kw": "./node_modules/moment/locale/ar-kw.js",
	"./ar-kw.js": "./node_modules/moment/locale/ar-kw.js",
	"./ar-ly": "./node_modules/moment/locale/ar-ly.js",
	"./ar-ly.js": "./node_modules/moment/locale/ar-ly.js",
	"./ar-ma": "./node_modules/moment/locale/ar-ma.js",
	"./ar-ma.js": "./node_modules/moment/locale/ar-ma.js",
	"./ar-ps": "./node_modules/moment/locale/ar-ps.js",
	"./ar-ps.js": "./node_modules/moment/locale/ar-ps.js",
	"./ar-sa": "./node_modules/moment/locale/ar-sa.js",
	"./ar-sa.js": "./node_modules/moment/locale/ar-sa.js",
	"./ar-tn": "./node_modules/moment/locale/ar-tn.js",
	"./ar-tn.js": "./node_modules/moment/locale/ar-tn.js",
	"./ar.js": "./node_modules/moment/locale/ar.js",
	"./az": "./node_modules/moment/locale/az.js",
	"./az.js": "./node_modules/moment/locale/az.js",
	"./be": "./node_modules/moment/locale/be.js",
	"./be.js": "./node_modules/moment/locale/be.js",
	"./bg": "./node_modules/moment/locale/bg.js",
	"./bg.js": "./node_modules/moment/locale/bg.js",
	"./bm": "./node_modules/moment/locale/bm.js",
	"./bm.js": "./node_modules/moment/locale/bm.js",
	"./bn": "./node_modules/moment/locale/bn.js",
	"./bn-bd": "./node_modules/moment/locale/bn-bd.js",
	"./bn-bd.js": "./node_modules/moment/locale/bn-bd.js",
	"./bn.js": "./node_modules/moment/locale/bn.js",
	"./bo": "./node_modules/moment/locale/bo.js",
	"./bo.js": "./node_modules/moment/locale/bo.js",
	"./br": "./node_modules/moment/locale/br.js",
	"./br.js": "./node_modules/moment/locale/br.js",
	"./bs": "./node_modules/moment/locale/bs.js",
	"./bs.js": "./node_modules/moment/locale/bs.js",
	"./ca": "./node_modules/moment/locale/ca.js",
	"./ca.js": "./node_modules/moment/locale/ca.js",
	"./cs": "./node_modules/moment/locale/cs.js",
	"./cs.js": "./node_modules/moment/locale/cs.js",
	"./cv": "./node_modules/moment/locale/cv.js",
	"./cv.js": "./node_modules/moment/locale/cv.js",
	"./cy": "./node_modules/moment/locale/cy.js",
	"./cy.js": "./node_modules/moment/locale/cy.js",
	"./da": "./node_modules/moment/locale/da.js",
	"./da.js": "./node_modules/moment/locale/da.js",
	"./de": "./node_modules/moment/locale/de.js",
	"./de-at": "./node_modules/moment/locale/de-at.js",
	"./de-at.js": "./node_modules/moment/locale/de-at.js",
	"./de-ch": "./node_modules/moment/locale/de-ch.js",
	"./de-ch.js": "./node_modules/moment/locale/de-ch.js",
	"./de.js": "./node_modules/moment/locale/de.js",
	"./dv": "./node_modules/moment/locale/dv.js",
	"./dv.js": "./node_modules/moment/locale/dv.js",
	"./el": "./node_modules/moment/locale/el.js",
	"./el.js": "./node_modules/moment/locale/el.js",
	"./en-au": "./node_modules/moment/locale/en-au.js",
	"./en-au.js": "./node_modules/moment/locale/en-au.js",
	"./en-ca": "./node_modules/moment/locale/en-ca.js",
	"./en-ca.js": "./node_modules/moment/locale/en-ca.js",
	"./en-gb": "./node_modules/moment/locale/en-gb.js",
	"./en-gb.js": "./node_modules/moment/locale/en-gb.js",
	"./en-ie": "./node_modules/moment/locale/en-ie.js",
	"./en-ie.js": "./node_modules/moment/locale/en-ie.js",
	"./en-il": "./node_modules/moment/locale/en-il.js",
	"./en-il.js": "./node_modules/moment/locale/en-il.js",
	"./en-in": "./node_modules/moment/locale/en-in.js",
	"./en-in.js": "./node_modules/moment/locale/en-in.js",
	"./en-nz": "./node_modules/moment/locale/en-nz.js",
	"./en-nz.js": "./node_modules/moment/locale/en-nz.js",
	"./en-sg": "./node_modules/moment/locale/en-sg.js",
	"./en-sg.js": "./node_modules/moment/locale/en-sg.js",
	"./eo": "./node_modules/moment/locale/eo.js",
	"./eo.js": "./node_modules/moment/locale/eo.js",
	"./es": "./node_modules/moment/locale/es.js",
	"./es-do": "./node_modules/moment/locale/es-do.js",
	"./es-do.js": "./node_modules/moment/locale/es-do.js",
	"./es-mx": "./node_modules/moment/locale/es-mx.js",
	"./es-mx.js": "./node_modules/moment/locale/es-mx.js",
	"./es-us": "./node_modules/moment/locale/es-us.js",
	"./es-us.js": "./node_modules/moment/locale/es-us.js",
	"./es.js": "./node_modules/moment/locale/es.js",
	"./et": "./node_modules/moment/locale/et.js",
	"./et.js": "./node_modules/moment/locale/et.js",
	"./eu": "./node_modules/moment/locale/eu.js",
	"./eu.js": "./node_modules/moment/locale/eu.js",
	"./fa": "./node_modules/moment/locale/fa.js",
	"./fa.js": "./node_modules/moment/locale/fa.js",
	"./fi": "./node_modules/moment/locale/fi.js",
	"./fi.js": "./node_modules/moment/locale/fi.js",
	"./fil": "./node_modules/moment/locale/fil.js",
	"./fil.js": "./node_modules/moment/locale/fil.js",
	"./fo": "./node_modules/moment/locale/fo.js",
	"./fo.js": "./node_modules/moment/locale/fo.js",
	"./fr": "./node_modules/moment/locale/fr.js",
	"./fr-ca": "./node_modules/moment/locale/fr-ca.js",
	"./fr-ca.js": "./node_modules/moment/locale/fr-ca.js",
	"./fr-ch": "./node_modules/moment/locale/fr-ch.js",
	"./fr-ch.js": "./node_modules/moment/locale/fr-ch.js",
	"./fr.js": "./node_modules/moment/locale/fr.js",
	"./fy": "./node_modules/moment/locale/fy.js",
	"./fy.js": "./node_modules/moment/locale/fy.js",
	"./ga": "./node_modules/moment/locale/ga.js",
	"./ga.js": "./node_modules/moment/locale/ga.js",
	"./gd": "./node_modules/moment/locale/gd.js",
	"./gd.js": "./node_modules/moment/locale/gd.js",
	"./gl": "./node_modules/moment/locale/gl.js",
	"./gl.js": "./node_modules/moment/locale/gl.js",
	"./gom-deva": "./node_modules/moment/locale/gom-deva.js",
	"./gom-deva.js": "./node_modules/moment/locale/gom-deva.js",
	"./gom-latn": "./node_modules/moment/locale/gom-latn.js",
	"./gom-latn.js": "./node_modules/moment/locale/gom-latn.js",
	"./gu": "./node_modules/moment/locale/gu.js",
	"./gu.js": "./node_modules/moment/locale/gu.js",
	"./he": "./node_modules/moment/locale/he.js",
	"./he.js": "./node_modules/moment/locale/he.js",
	"./hi": "./node_modules/moment/locale/hi.js",
	"./hi.js": "./node_modules/moment/locale/hi.js",
	"./hr": "./node_modules/moment/locale/hr.js",
	"./hr.js": "./node_modules/moment/locale/hr.js",
	"./hu": "./node_modules/moment/locale/hu.js",
	"./hu.js": "./node_modules/moment/locale/hu.js",
	"./hy-am": "./node_modules/moment/locale/hy-am.js",
	"./hy-am.js": "./node_modules/moment/locale/hy-am.js",
	"./id": "./node_modules/moment/locale/id.js",
	"./id.js": "./node_modules/moment/locale/id.js",
	"./is": "./node_modules/moment/locale/is.js",
	"./is.js": "./node_modules/moment/locale/is.js",
	"./it": "./node_modules/moment/locale/it.js",
	"./it-ch": "./node_modules/moment/locale/it-ch.js",
	"./it-ch.js": "./node_modules/moment/locale/it-ch.js",
	"./it.js": "./node_modules/moment/locale/it.js",
	"./ja": "./node_modules/moment/locale/ja.js",
	"./ja.js": "./node_modules/moment/locale/ja.js",
	"./jv": "./node_modules/moment/locale/jv.js",
	"./jv.js": "./node_modules/moment/locale/jv.js",
	"./ka": "./node_modules/moment/locale/ka.js",
	"./ka.js": "./node_modules/moment/locale/ka.js",
	"./kk": "./node_modules/moment/locale/kk.js",
	"./kk.js": "./node_modules/moment/locale/kk.js",
	"./km": "./node_modules/moment/locale/km.js",
	"./km.js": "./node_modules/moment/locale/km.js",
	"./kn": "./node_modules/moment/locale/kn.js",
	"./kn.js": "./node_modules/moment/locale/kn.js",
	"./ko": "./node_modules/moment/locale/ko.js",
	"./ko.js": "./node_modules/moment/locale/ko.js",
	"./ku": "./node_modules/moment/locale/ku.js",
	"./ku-kmr": "./node_modules/moment/locale/ku-kmr.js",
	"./ku-kmr.js": "./node_modules/moment/locale/ku-kmr.js",
	"./ku.js": "./node_modules/moment/locale/ku.js",
	"./ky": "./node_modules/moment/locale/ky.js",
	"./ky.js": "./node_modules/moment/locale/ky.js",
	"./lb": "./node_modules/moment/locale/lb.js",
	"./lb.js": "./node_modules/moment/locale/lb.js",
	"./lo": "./node_modules/moment/locale/lo.js",
	"./lo.js": "./node_modules/moment/locale/lo.js",
	"./lt": "./node_modules/moment/locale/lt.js",
	"./lt.js": "./node_modules/moment/locale/lt.js",
	"./lv": "./node_modules/moment/locale/lv.js",
	"./lv.js": "./node_modules/moment/locale/lv.js",
	"./me": "./node_modules/moment/locale/me.js",
	"./me.js": "./node_modules/moment/locale/me.js",
	"./mi": "./node_modules/moment/locale/mi.js",
	"./mi.js": "./node_modules/moment/locale/mi.js",
	"./mk": "./node_modules/moment/locale/mk.js",
	"./mk.js": "./node_modules/moment/locale/mk.js",
	"./ml": "./node_modules/moment/locale/ml.js",
	"./ml.js": "./node_modules/moment/locale/ml.js",
	"./mn": "./node_modules/moment/locale/mn.js",
	"./mn.js": "./node_modules/moment/locale/mn.js",
	"./mr": "./node_modules/moment/locale/mr.js",
	"./mr.js": "./node_modules/moment/locale/mr.js",
	"./ms": "./node_modules/moment/locale/ms.js",
	"./ms-my": "./node_modules/moment/locale/ms-my.js",
	"./ms-my.js": "./node_modules/moment/locale/ms-my.js",
	"./ms.js": "./node_modules/moment/locale/ms.js",
	"./mt": "./node_modules/moment/locale/mt.js",
	"./mt.js": "./node_modules/moment/locale/mt.js",
	"./my": "./node_modules/moment/locale/my.js",
	"./my.js": "./node_modules/moment/locale/my.js",
	"./nb": "./node_modules/moment/locale/nb.js",
	"./nb.js": "./node_modules/moment/locale/nb.js",
	"./ne": "./node_modules/moment/locale/ne.js",
	"./ne.js": "./node_modules/moment/locale/ne.js",
	"./nl": "./node_modules/moment/locale/nl.js",
	"./nl-be": "./node_modules/moment/locale/nl-be.js",
	"./nl-be.js": "./node_modules/moment/locale/nl-be.js",
	"./nl.js": "./node_modules/moment/locale/nl.js",
	"./nn": "./node_modules/moment/locale/nn.js",
	"./nn.js": "./node_modules/moment/locale/nn.js",
	"./oc-lnc": "./node_modules/moment/locale/oc-lnc.js",
	"./oc-lnc.js": "./node_modules/moment/locale/oc-lnc.js",
	"./pa-in": "./node_modules/moment/locale/pa-in.js",
	"./pa-in.js": "./node_modules/moment/locale/pa-in.js",
	"./pl": "./node_modules/moment/locale/pl.js",
	"./pl.js": "./node_modules/moment/locale/pl.js",
	"./pt": "./node_modules/moment/locale/pt.js",
	"./pt-br": "./node_modules/moment/locale/pt-br.js",
	"./pt-br.js": "./node_modules/moment/locale/pt-br.js",
	"./pt.js": "./node_modules/moment/locale/pt.js",
	"./ro": "./node_modules/moment/locale/ro.js",
	"./ro.js": "./node_modules/moment/locale/ro.js",
	"./ru": "./node_modules/moment/locale/ru.js",
	"./ru.js": "./node_modules/moment/locale/ru.js",
	"./sd": "./node_modules/moment/locale/sd.js",
	"./sd.js": "./node_modules/moment/locale/sd.js",
	"./se": "./node_modules/moment/locale/se.js",
	"./se.js": "./node_modules/moment/locale/se.js",
	"./si": "./node_modules/moment/locale/si.js",
	"./si.js": "./node_modules/moment/locale/si.js",
	"./sk": "./node_modules/moment/locale/sk.js",
	"./sk.js": "./node_modules/moment/locale/sk.js",
	"./sl": "./node_modules/moment/locale/sl.js",
	"./sl.js": "./node_modules/moment/locale/sl.js",
	"./sq": "./node_modules/moment/locale/sq.js",
	"./sq.js": "./node_modules/moment/locale/sq.js",
	"./sr": "./node_modules/moment/locale/sr.js",
	"./sr-cyrl": "./node_modules/moment/locale/sr-cyrl.js",
	"./sr-cyrl.js": "./node_modules/moment/locale/sr-cyrl.js",
	"./sr.js": "./node_modules/moment/locale/sr.js",
	"./ss": "./node_modules/moment/locale/ss.js",
	"./ss.js": "./node_modules/moment/locale/ss.js",
	"./sv": "./node_modules/moment/locale/sv.js",
	"./sv.js": "./node_modules/moment/locale/sv.js",
	"./sw": "./node_modules/moment/locale/sw.js",
	"./sw.js": "./node_modules/moment/locale/sw.js",
	"./ta": "./node_modules/moment/locale/ta.js",
	"./ta.js": "./node_modules/moment/locale/ta.js",
	"./te": "./node_modules/moment/locale/te.js",
	"./te.js": "./node_modules/moment/locale/te.js",
	"./tet": "./node_modules/moment/locale/tet.js",
	"./tet.js": "./node_modules/moment/locale/tet.js",
	"./tg": "./node_modules/moment/locale/tg.js",
	"./tg.js": "./node_modules/moment/locale/tg.js",
	"./th": "./node_modules/moment/locale/th.js",
	"./th.js": "./node_modules/moment/locale/th.js",
	"./tk": "./node_modules/moment/locale/tk.js",
	"./tk.js": "./node_modules/moment/locale/tk.js",
	"./tl-ph": "./node_modules/moment/locale/tl-ph.js",
	"./tl-ph.js": "./node_modules/moment/locale/tl-ph.js",
	"./tlh": "./node_modules/moment/locale/tlh.js",
	"./tlh.js": "./node_modules/moment/locale/tlh.js",
	"./tr": "./node_modules/moment/locale/tr.js",
	"./tr.js": "./node_modules/moment/locale/tr.js",
	"./tzl": "./node_modules/moment/locale/tzl.js",
	"./tzl.js": "./node_modules/moment/locale/tzl.js",
	"./tzm": "./node_modules/moment/locale/tzm.js",
	"./tzm-latn": "./node_modules/moment/locale/tzm-latn.js",
	"./tzm-latn.js": "./node_modules/moment/locale/tzm-latn.js",
	"./tzm.js": "./node_modules/moment/locale/tzm.js",
	"./ug-cn": "./node_modules/moment/locale/ug-cn.js",
	"./ug-cn.js": "./node_modules/moment/locale/ug-cn.js",
	"./uk": "./node_modules/moment/locale/uk.js",
	"./uk.js": "./node_modules/moment/locale/uk.js",
	"./ur": "./node_modules/moment/locale/ur.js",
	"./ur.js": "./node_modules/moment/locale/ur.js",
	"./uz": "./node_modules/moment/locale/uz.js",
	"./uz-latn": "./node_modules/moment/locale/uz-latn.js",
	"./uz-latn.js": "./node_modules/moment/locale/uz-latn.js",
	"./uz.js": "./node_modules/moment/locale/uz.js",
	"./vi": "./node_modules/moment/locale/vi.js",
	"./vi.js": "./node_modules/moment/locale/vi.js",
	"./x-pseudo": "./node_modules/moment/locale/x-pseudo.js",
	"./x-pseudo.js": "./node_modules/moment/locale/x-pseudo.js",
	"./yo": "./node_modules/moment/locale/yo.js",
	"./yo.js": "./node_modules/moment/locale/yo.js",
	"./zh-cn": "./node_modules/moment/locale/zh-cn.js",
	"./zh-cn.js": "./node_modules/moment/locale/zh-cn.js",
	"./zh-hk": "./node_modules/moment/locale/zh-hk.js",
	"./zh-hk.js": "./node_modules/moment/locale/zh-hk.js",
	"./zh-mo": "./node_modules/moment/locale/zh-mo.js",
	"./zh-mo.js": "./node_modules/moment/locale/zh-mo.js",
	"./zh-tw": "./node_modules/moment/locale/zh-tw.js",
	"./zh-tw.js": "./node_modules/moment/locale/zh-tw.js"
};


function webpackContext(req) {
	var id = webpackContextResolve(req);
	return __webpack_require__(id);
}
function webpackContextResolve(req) {
	if(!__webpack_require__.o(map, req)) {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	}
	return map[req];
}
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = "./node_modules/moment/locale sync recursive ^\\.\\/.*$";

/***/ }),

/***/ "?2128":
/*!********************************!*\
  !*** ./util.inspect (ignored) ***!
  \********************************/
/***/ (function() {

/* (ignored) */

/***/ })

},
/******/ function(__webpack_require__) { // webpackRuntimeModules
/******/ var __webpack_exec__ = function(moduleId) { return __webpack_require__(__webpack_require__.s = moduleId); }
/******/ __webpack_require__.O(0, ["/sanity/js/vendor"], function() { return __webpack_exec__("./resources/platform/assets/js/Sanity/sanity-app.js"); });
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);