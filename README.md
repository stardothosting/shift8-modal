# Shift8 Modal 
* Contributors: 
* Donate link: https://www.shift8web.ca
* Tags: modal, flyout, jquery, window, full screen modal, full screen, jquery full screen, full width modal, full width
* Requires at least: 3.0.1
* Tested up to: 4.5.2
* Stable tag: 4.3
* License: GPLv3
* License URI: http://www.gnu.org/licenses/gpl-3.0.html

This is a Wordpress Plugin that allows you to integrate AnimatedModal library (with Animate.css) in order to create full screen modal flyout windows.

##  Description 

This plugin allows you to integrate the [animatedModal.js](http://joaopereirawd.github.io/animatedModal.js/ "animatedModal.js") and [Animated.css](http://daneden.github.io/animate.css/ "Animate.css") library into your wordpress installation. The plugin wraps the library into an easy to use shortcode that generates the markup needed to implement the flyout full screen modals.

Using this plugin you should be able to create 100% custom animatedModal flyouts and overlays. The shortcode pulls a page ID as a source of content. You can format and style your content via Wordpress' built-in WYSIWYG editor. Further to that you can style everything with the custom CSS classes that are generated by the shortcode.

## Installation 

This section describes how to install the plugin and get it working.

e.g.

1. Upload the plugin files to the `/wp-content/plugins/shift8-modal` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the shortcode markup anywhere in your site 


## Frequently Asked Questions 

### What are the shortcode options? 

An example shortcode would be the following :

<pre>
[shift8-modal post_id="1234" close_modal="CLOSE" call_modal="CLICK HERE" call_type="button" animatedIn="lightSpeedIn" animatedOut="bounceOutDown" color="#333333"]
</pre>


### How can I style the markup? 

You can either style the content that the shortcode pulls (page ID) by using the built-in Wordpress WYSIWYG editor or you can apply CSS styling to the custom classes that are generated in the markup. There will be general "catch-all" CSS classes generated and custom per-shortcode classes that will allow you to style each markup individually, or all at once.

### Can I use an icon or image for the close button? 

This is planned for a future update of the plugin. Alternatively you can simply use the CSS class that is assigned to the close button area to inject font awesome icons (or any icon pack) and remove the close text. For example :

<pre>
#shift8-close-modal ::before {
	content: 'whatever';
}
#shift8-close-modal a {
	display:none;
}
</pre>

### What are all the animation options? 

You can visit the [Animate.css](http://daneden.github.io/animate.css/ "Animate.css") page to view all the animation options for the animatedIn and animatedOut options.

### What else have you done? 

You can visit [our website](https://www.shift8web.ca "Toronto Web Design") to see! :)

== Changelog ==

= 1.0 =
* Stable version created
* Implemented short code options 

