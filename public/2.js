(window.webpackJsonp=window.webpackJsonp||[]).push([[2],{"1wPC":function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return k}));var r=n("q1tI"),a=n.n(r),o=n("fFoN"),i=n("m91G"),l=n("jfjY"),c=n.n(l);function u(e){return(u="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function s(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){if("undefined"==typeof Symbol||!(Symbol.iterator in Object(e)))return;var n=[],r=!0,a=!1,o=void 0;try{for(var i,l=e[Symbol.iterator]();!(r=(i=l.next()).done)&&(n.push(i.value),!t||n.length!==t);r=!0);}catch(e){a=!0,o=e}finally{try{r||null==l.return||l.return()}finally{if(a)throw o}}return n}(e,t)||function(e,t){if(!e)return;if("string"==typeof e)return f(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);"Object"===n&&e.constructor&&(n=e.constructor.name);if("Map"===n||"Set"===n)return Array.from(e);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return f(e,t)}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function f(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}function m(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function d(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function h(e,t,n){return t&&d(e.prototype,t),n&&d(e,n),e}function p(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&y(e,t)}function y(e,t){return(y=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}function b(e){var t=function(){if("undefined"==typeof Reflect||!Reflect.construct)return!1;if(Reflect.construct.sham)return!1;if("function"==typeof Proxy)return!0;try{return Date.prototype.toString.call(Reflect.construct(Date,[],(function(){}))),!0}catch(e){return!1}}();return function(){var n,r=g(e);if(t){var a=g(this).constructor;n=Reflect.construct(r,arguments,a)}else n=r.apply(this,arguments);return E(this,n)}}function E(e,t){return!t||"object"!==u(t)&&"function"!=typeof t?v(e):t}function v(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}function g(e){return(g=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}var S=Object(i.connectRefinementList)((function(){return null})),w=null,R=function(e){return a.a.createElement("div",{className:"panel panel-default"},a.a.createElement("div",{className:"panel-heading"},a.a.createElement("div",null,e.header)),a.a.createElement("div",{className:"panel-body"},e.children))},N=function(e){var t=e.hit;return a.a.createElement("div",{className:"hit panel panel-default panel-body"},a.a.createElement("a",{href:"".concat(window.location.origin,"/visualizar/").concat(t.id),target:"_blank",rel:"noopener noreferrer",className:"btn btn-default pull-right"},"Descargar PDF"),a.a.createElement("div",null,a.a.createElement("strong",null,t.publication_name),a.a.createElement("div",null,t.day),a.a.createElement("div",{style:B.result},a.a.createElement("i",null,a.a.createElement(o.Snippet,{attributeName:"content",hit:t,tagName:"i"})))))},x=function(){return a.a.createElement("div",{className:"sidebar"},a.a.createElement(R,{header:"Filtros"},a.a.createElement(q,null),a.a.createElement(j,null)))},q=function(){return config.defaultRefinementPublications?a.a.createElement(S,{attributeName:"publication_name",defaultRefinement:config.defaultRefinementPublications}):a.a.createElement("div",null,a.a.createElement("strong",null,"Publicación"),a.a.createElement(o.RefinementList,{attributeName:"publication_name",showMore:!0,limitMin:10,limitMax:65,translations:{showMore:function(e){return e?"Mostrar menos":"Mostrar mas"}},transformItems:function(e){return e.sort((function(e,t){return e.label>t.label?1:e.label<t.label?-1:0}))}}))},j=function(){return config.defaultRefinementDays?a.a.createElement(S,{attributeName:"date",defaultRefinement:config.defaultRefinementDays}):a.a.createElement("div",null,a.a.createElement("strong",null,"Día"),a.a.createElement(o.RefinementList,{attributeName:"date",translations:{showMore:function(e){return e?"Mostrar menos":"Mostrar mas"}},showMore:!0,limitMin:10,limitMax:30}))},O=function(){return a.a.createElement(o.Stats,{translations:{stats:function(e,t){return e+" resultados encontrados en "+t+"ms. "}}})},P=function(){return a.a.createElement("div",null,"Resultados")},_=function(){if(c()())return a.a.createElement("div",null,a.a.createElement(o.Hits,{hitComponent:N}),a.a.createElement(o.Pagination,null));var e=a.a.createElement(P,null);return a.a.createElement("div",{className:"content"},a.a.createElement(R,{header:e},a.a.createElement(o.Hits,{hitComponent:N}),a.a.createElement(o.Pagination,null)))};function C(e){var t=function(){return c()()&&(document.getElementById("searchbox-container").scrollIntoView(),void document.getElementsByClassName("ais-SearchBox__input")[0].focus())};return config.defaultRefinementSearch?a.a.createElement(o.SearchBox,{id:"searchbox",name:"search",onFocus:t,autoFocus:!0,onChange:e.onSearch,translations:{placeholder:""},defaultRefinement:config.defaultRefinementSearch}):a.a.createElement(o.SearchBox,{id:"searchbox",name:"search",onFocus:t,autoFocus:!0,onChange:e.onSearch,translations:{placeholder:""}})}function I(e){var t="/alertas?query="+encodeURI(e.query);return a.a.createElement("a",{id:"call-to-action",href:t,className:"btn btn-primary"},"Crear alerta diaria")}var M=function(e){p(n,e);var t=b(n);function n(){var e;return m(this,n),(e=t.call(this)).state={query:""},e.onSearch=e.onSearch.bind(v(e)),e}return h(n,[{key:"onSearch",value:function(e){var t,n,r=e.target.value;(this.props.setSearched(r.length>0),this.setState({query:r}),void 0!==window.ga)&&(t=function(){return ga("send","event","Search","search",r)},n=200,w&&clearTimeout(w),w=setTimeout(t,n))}},{key:"render",value:function(){var e=this.state.query,t=e.length>0&&!config.existingAlerts.some((function(t){return t===e})),n=config.defaultRefinementSearch&&!config.existingAlerts.some((function(t){return t===e})),r=t||n;return a.a.createElement("div",null,a.a.createElement("div",{id:"searchbox-container"},a.a.createElement("label",{htmlFor:"search",style:{display:"none"}},"Introduce un término"),a.a.createElement(C,{onSearch:this.onSearch}),r&&a.a.createElement(I,{query:e||config.defaultRefinementSearch})),a.a.createElement(D,{query:e}))}}]),n}(a.a.Component);function A(e){return'"'!==e.query[0]&&'"'!==e.query[e.query.length-1]&&e.query.includes(" ")?a.a.createElement("div",{className:"alert alert-warning"},"Consejo. Puedes entrecomillar ",e.query," para buscar concordancias. exactas."):null}var D=function(e){p(n,e);var t=b(n);function n(){return m(this,n),t.apply(this,arguments)}return h(n,[{key:"render",value:function(){return a.a.createElement("div",null,a.a.createElement("p",null,this.props.query.length>0&&a.a.createElement(O,null)),this.props.query.length>0&&this.props.query!==config.defaultRefinementSearch&&a.a.createElement(A,{query:this.props.query}))}}]),n}(a.a.Component),F=function(){return a.a.createElement("div",null,a.a.createElement("div",{className:"col-md-4 hidden-xs"},a.a.createElement(x,null)),a.a.createElement("div",{className:"col-md-8"},a.a.createElement(_,null)))};function k(){var e=s(Object(r.useState)(""),2),t=e[0],n=e[1];return a.a.createElement(o.InstantSearch,{apiKey:config.apiKey,appId:config.appId,indexName:config.indexId},a.a.createElement(o.Configure,{facetingAfterDistinct:!0}),a.a.createElement("div",{className:"col-md-12"},a.a.createElement(M,{setSearched:n,showStats:config.initWithResults||t})),(config.initWithResults||t)&&a.a.createElement(F,null))}var B={result:{overflow:"hidden",textOverflow:"ellipsis"}}}}]);