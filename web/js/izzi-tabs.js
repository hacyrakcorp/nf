/*!
 * A simple tabs plugin. Use it for navigation or as a simple showoff section.
 * Version : 1.0.0
 * Emmanuel B. (www.emmanuelbeziat.com)
 * https://github.com/EmmanuelBeziat/js-izzi-tabs
 **/

(function (root, factory) {
	if (typeof define === 'function' && define.amd) {
		// AMD. Register as an anonymous module.
		define([], factory);
	} else if (typeof module === 'object' && module.exports) {
		// Node. Does not work with strict CommonJS, but
		// only CommonJS-like environments that support module.exports,
		// like Node.
		module.exports = factory();
	} else {
		// Browser globals (root is window)
		root.IzziTabs = factory();
	}
}(this, function () {
	var IzziTabs = function (el, options){
		'use strict';

		var self = Object.create(IzziTabs.prototype);

		/**
		 * Default settings
		 */
		self.options = {
			tabLinkSelector: '.tab-links__item',
			tabLinkActiveClass: 'is-active',
			tabItemSelector: '.tab-content__item',
			tabItemActiveClass: 'is-active',
			beforeShowTab: null,
			afterShowTab: null
		};

		/**
		 * User defined options
		 */
		if (options) {
			Object.keys(options).forEach(function (key){
				self.options[key] = options[key];
			});
		}

		/**
		 * By default, search for an item with 'data-sticky' attribute
		 */
		if (!el) {
			self.tabs = document.querySelector('.js-izzi-tabs');
		}

		if (el && 'string' === typeof el) {
			self.tabs = document.querySelector(el);
		}
		else if (el && 'object' === typeof el) {
			self.tabs = el;
		}
		else {
			throw new Error('[IzziTabs] Unable to get a valid object');
		}

		var hashChange = function (hash) {
			var hash = hash || window.location.hash;
			var loadTab = self.tabs.querySelector('a[href="' + hash + '"]');

			if (null === loadTab || loadTab.classList.contains(self.options.tabLinkActiveClass)) {
				return;
			}

			activeTab(loadTab);
		};

		/**
		 * When a tab is clickeds
		 * 1. If clicked tab is already active, don't do anything
		 * 2. Remove class active to all other tabs, and then add it on the clicked tab
		 * 3. Remove class active to all other tabs content, and then add it on the enabled tab content
		 */
		var activeTab = function (element) {
			if (element.classList.contains(self.options.tabLinkActiveClass)) {
				return; // [1]
			}

			// callback before
			if ('function' === typeof self.options.beforeShowTab) {
				self.options.beforeShowTab();
			}

			var tabLinkNew = element;
			var tabLinkCurrent = self.tabs.querySelector(self.options.tabLinkSelector + '.' + self.options.tabLinkActiveClass)
			var tabItemNew = document.querySelector(tabLinkNew.getAttribute('href'))
			var tabContainer = tabItemNew.parentNode;
			var tabItemCurrent = tabContainer.querySelector(self.options.tabItemSelector + '.' + self.options.tabItemActiveClass);

			// Tab link
			tabLinkCurrent.classList.remove(self.options.tabLinkActiveClass); // [2]
			tabLinkNew.classList.add(self.options.tabLinkActiveClass); // [2]

			// Tab Content
			tabItemCurrent.classList.remove(self.options.tabItemActiveClass); // [3]
			tabItemNew.classList.add(self.options.tabItemActiveClass); // [3]

			// callback after
			if ('function' === typeof self.options.afterShowTab) {
				self.options.afterShowTab();
			}
		};

		/**
		 * Main build function
		 * 1. If history option is active, allow hash change navigation
		 * 2. If page is loaded with a hash of a tab, set it active
		 * 3. Fire events when tab link is clicked
		 */
		var init = function () {

			window.addEventListener('hashchange', function (event) {
				hashChange(); // [1]
			});

			hashChange(); // [2]

			var tabLinks = document.querySelectorAll(self.options.tabLinkSelector);

			Array.prototype.forEach.call(tabLinks, function (link) {
				link.addEventListener('click', function () { // [3]
					activeTab(link);
				});
			});
		};

		init();
		return self;
	};
	return IzziTabs;
}));