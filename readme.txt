=== Pricing Tables Pro===
Contributors: lelandf, metrocraft
Tags: pricing table, pricing tables, prices, pricing, plans, offer, shortcode, price, responsive, pricing, tables, pricing plan, price comparison
Requires at least: 3.6
Tested up to: 4.2.2
Stable tag: trunk
License: GPL2
License URI: http://www.gnu.org/licenses/gpl.html

A pricing table plugin without ads or upsells. This already is the “Pro” version.

== Description ==
This plugin will add a “Pricing Tables” menu item to your WordPress admin panel. In there, you can create simple pricing tables with plan information, lists of features, followed by a call to action button.

There is a basic, responsive stylesheet included with the plugin so everyone can get started with minimal set up, even if not using a supported theme. While you can technically have “unlimited” columns of pricing tables, the stylesheet will only account for a maximum of five per set.

There are not, nor ever will be any in-plugin options to change colors, font sizes, and things of that nature. You are (or the theme you’re using is) expected to deregister the default front-end stylesheet and/or add your own CSS styles to make such changes.

This plugin is primarily intended to be recommended to users/customers by theme developers who implement pricing tables in their themes, and want to make sure their users/customers are able to create pricing tables with portable data that can be retained even if they switch themes.

There are also not, nor ever will be any sort of “Pro” version, upsells, ads, surreptitious data tracking or analytics, so theme developers can be confident in recommending a plugin that users won’t find too pushy or annoying. This is the “Pro” version already.

If you are looking for customization options and/or not a customer of a theme developer who recommends this plugin, there are other pricing table plugins that are probably a better fit for you.

= Support =
Please note that it’s nearly impossible to make sure the default stylesheet will look good with every unsupported theme. We’re unfortunately unable to support any sort of CSS customization changes like this.

Again, if you’re not a user of a theme that advertises support for Pricing Tables Pro, there are probably better fits for you in the pricing table plugin realm. If you are, you can likely get support from whoever sold you the theme.

Any other support requests will likely not receive an official response from us, unless there is a veritable bug that we are able to reproduce.

= Feature Requests =
The goal of this plugin is to be as simple as possible at its core. Therefore, we’re extremely unlikely to cater to any feature requests that would add new fields or options that aren’t already there.

However, we realize that the plugin in its current state could be more flexible through the use of action hooks and filters. If you’re a developer and willing to contribute such changes, please submit a pull request on the Pricing Table Pro GitHub page.

= Usage =
Creating sets of pricing tables is pretty straightforward.

1. Click on “Add New” under the “Pricing Tables” menu item in the admin panel.
2. Fill out all the plan information for the first plan, including plan title, price, feature list (separated by line break), call to action text and URL.
3. Click “Add another plan” and repeat step 2 for any new plans.
4. Use the arrow buttons to reorder the plans, if neccessary.
5. When finished adding plans for a particular set of pricing tables, click the “Publish” button (or “Update” if you were editing a previously published set).
6. Click back to the “Pricing Tables” page to see a list of pricing tables with the relevant shortcode displayed to the right of each. The shortcode will be in the format of `[ptp name=“slug”]` replacing “slug” with whatever the slug of the pricing table is.
7. Include the shortcode wherever shortcodes are supported to display the relevant set of pricing tables.

== Installation ==

1. Activate Pricing Tables Pro via your preferred method of [plugin installation](https://codex.wordpress.org/Managing_Plugins#Installing_Plugins)
2. See the “Usage” section on the main plugin page for instructions on what to do after that.

== Frequently Asked Questions ==
= Does this plugin include any upsells to a “pro” version or otherwise contain any annoying ads in the backend? =
Nope. One of the main reasons we made this plugin is because every single other pricing table plugin we found does have some sort of upsell or ad in the backend.

We want this to be the preeminent pricing table plugin for theme developers to add styles for in their own themes. And since theme developers typically prefer to recommend plugins that don’t plaster ads all over the place, we figured this plugin filled a need.

This is the “Pro” version. No upsell required.

= Does this plugin include any sort of customization options so I can change colors and fonts and other stuff like that? =
Nope. If you want to customize stuff like that, you’ll need to add custom CSS to your site somehow. If you have no interest in writing custom CSS and require such options for whatever reason, you’re better off using another pricing table plugin, because we’ll never add any options like that.

= I’m a developer. Do you have a GitHub so I can submit a pull request? =
Sure!

Please note that we’re not interested in any pull requests adding color/font customization options or new pricing table fields. However, we’re very open to stuff like refactoring, localization, and adding hooks and filters to allow for better flexibility without hacking up core plugin files.

While the plugin is totally functional as-is, there’s always room for improvement and an extra set of eyes, so your contributions are always much appreciated.

= Why didn’t you respond to my support request? :( =
Themes are our primary business, and we don’t really generate any revenue directly from this plugin, so we really can’t offer a sustained support forum presence. We host the plugin on WordPress.org for convenience.
 
We do keep an eye on the support forum in case there are veritable bugs that need to be squashed, but otherwise let the WordPress.org community handle stuff beyond that.

Don’t let the low support response rate here steer you away from giving the plugin a shot though! Especially if a theme you use recommends it and offers their own custom styles with it. The plugin is great, we’ve just taken it in a different direction than the others.

== Changelog ==

= 1.0.0 =
* Initial release.
