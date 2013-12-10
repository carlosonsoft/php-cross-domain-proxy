PHP Cross Domain (AJAX) Proxy
==============

An application proxy that can be used to transparently transfer any request ( including of course XMLHTTPRequest ) to any third part domain. It is possible to define a list of acceptable third party domains and you are encouraged to do so. Otherwise the proxy is open to any kind of requests.

Installation
--------------

The proxy is indentionally limited to a single file. All you have to do is to place `proxy.php` under your application

Whenever you want to make a cross domain request, just make a request to http://www.yourdomain.com/ajax-proxy.php  Obviously, you can add more parameters according to your needs;

It’s worth mentioning that both POST and GET methods work and headers are taken into consideration. That is to say, headers sent from browser to proxy are used in the cross domain request and vice versa.

You have to specify the URL with the `X-Proxy-URL` header, which might be easier to set with your JavaScript library. For example, if you wanted to automatically use the proxy for external URL targets, for GET and POST requests:

``` JAVASCRIPT
$.ajaxPrefilter(function(options, originalOptions, jqXHR) {
	if (options.url.match(/^https?:/)) {
		options.headers['X-Proxy-URL'] = options.url;
		options.url = '/proxy.php';
	}
});
```


 
