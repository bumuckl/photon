###Description

Photon Gallery is a gallery and photomanagement plugin for Croogo CMS, originally based on Edinei L. Cipriani gallery plugin and extended alot. Photon's administration is AJAX-powered and has 4 different built-in ways of displaying your photos: either in an Image Replacement gallery, in a slider gallery, in JQuery Popeye gallery or in single images. Multisites support to allow custom themes for custom sites is yet to come.

A special feature is the so called "NodeAlbum"-Feature: For each node a specific album is automatically created. Thus, you can upload photos directly when creating nodes in another tab!

###Installation

	1. Install this plugin via the extension management of Croogo or upload the folder "photon" to /app/plugins
	2. Activate the plugin: the tables will be created and initial settings be saved
	3. Add new albums & upload photos
	4. Enjoy (hopefully) :)
	
You can access the gallery via yoururl.tld/gallery. If you want to display photos or galleries inside your nodes, just put code like this at the desired location in your node: 
[Gallery:slug]
[Popeye:slug]
[Slider:slug]
[Image:id]

When running your Croogo with markdown, please make sure you first activate markdown, and photon afterwards. Otherwise your galleries wont be rendered.

###Info

Author: bumuckl (& Edinei L. Cipriani)
E-mail: <bumuckl@gmail.com>
Website: http://www.bumuckl.com