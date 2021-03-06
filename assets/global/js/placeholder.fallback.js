/*
 * http://github.com/amiel/html5support
 * Amiel Martin
 * 2010-01-26
 *
 * Support certain HTML 5 attributes with javascript, but only if the browser doesn't already support them.
 */
var HTML5Support=function(a){function e(){var d=a(this),e=d.attr(b)+"   ",f=function(){if(a.trim(d.val())==""||d.val()==e)d.val(e).addClass(c)},g=function(){if(d.val()==e)d.val("").removeClass(c)};d.focus(g).blur(f).blur()}function f(){var d=a(this),e=d.attr(b),f=a('<input type="text">').val(e).addClass(c).addClass(d.attr("class")).css("display","none");set_value=function(){if(a.trim(d.val())==""){f.show();d.hide()}},clear_value=function(){f.hide();d.show().focus()};d.after(f);f.focus(clear_value);d.blur(set_value).blur()}var b="placeholder",c=b,d={};a.extend(d,{supports_attribute:function(a,b){return a in document.createElement(b||"input")}});a.fn.placeholder=function(b){if(d.supports_attribute("placeholder"))return this;return this.each(function(){a(this).attr("type")=="password"?f.apply(this):e.apply(this)})};a.fn.autofocus=function(){if(d.supports_attribute("autofocus"))return this;return this.focus()};a.autofocus=function(){a("[autofocus]:visible").autofocus()};a.placeholder=function(){a("["+b+"]").placeholder()};a.html5support=function(){a.autofocus();a.placeholder()};return d}(jQuery)
