### Description ###

Photon Gallery is a gallery and photomanagement plugin for Croogo CMS, originally based on Edinei L. Cipriani's gallery plugin. However it offers much more features and capabilities - it is heavily extended. Photon's administration is AJAX-powered and integrates flawlessly into your existing Croogo install. A new Tab is added to your nodes which allows you to upload pictures via Ajax - those pictures are directly related to that specific node. Doing so, Photon features four different preconfigured ways of displaying your photos: either in an Image Replacement gallery, in a Slider gallery, in JQuery Popeye gallery or just as single images. A seperate set of administration-views allows you to have full control over all your gallery stuff.

Once again, to point out the most special feature, the so called "NodeAlbum"-feature: For each node a specific album is automatically created. Thus, you can upload photos directly when creating nodes!

### Installation ###

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

### Info ###

Author: bumuckl (& Edinei L. Cipriani)
E-mail: <bumuckl@gmail.com>
Website: http://www.bumuckl.com

### Thanks to... ###

Big thanks go to "mherb" (https://github.com/mherb) for fixing tons of bugs and adding nice features such as single picture management!