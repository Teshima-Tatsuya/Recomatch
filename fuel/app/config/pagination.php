<?php

return array(

	// the active pagination template
	'active'                      => 'bootstrap',

	// default FuelPHP pagination template, compatible with pre-1.4 applications
	'default'                     => array(
		'uri_segment' => 'p',
		'wrapper'                 => "<div class=\"pagination\">\n\t{pagination}\n</div>\n",

		'previous'                => "<span class=\"pure-button previous\">\n\t{link}\n</span>\n",
		'previous-link'           => "\t\t<a href=\"{uri}\">{page}</a>\n",

		'previous-inactive'       => "<span class=\"pure-button previous-inactive\">\n\t{link}\n</span>\n",
		'previous-inactive-link'  => "\t\t<a href=\"{uri}\">{page}</a>\n",

		'regular'                 => "<span class=\"pure-button\">\n\t{link}\n</span>\n",
		'regular-link'            => "\t\t<a href=\"{uri}\">{page}</a>\n",

		'active'                  => "<span class=\"pure-button active\">\n\t{link}\n</span>\n",
		'active-link'             => "\t\t<a href=\"{uri}\">{page}</a>\n",

		'next'                    => "<span class=\"pure-button next\">\n\t{link}\n</span>\n",
		'next-link'               => "\t\t<a href=\"{uri}\">{page}</a>\n",

		'next-inactive'           => "<span class=\"pure-button next-inactive\">\n\t{link}\n</span>\n",
		'next-inactive-link'      => "\t\t<a href=\"{uri}\">{page}</a>\n",
	),

	// Twitter bootstrap 2.x template
	'bootstrap' => array(
		'uri_segment' => 'p',
		'wrapper'                 => "<div align=\"center\" class=\"pagination pure-paginator\">\n\t<ul class=\"pager\">{pagination}\n\t</ul>\n</div>\n",
		
		'first'                => "\t\t<li class=\"pager-button prev\">{link}</li>",
		'first-marker'    => "最初",
		'first-link'           => "<a href=\"{uri}\" >{page}</a>",

		'previous'                => "\n\t\t<li class=\"pager-button prev\">{link}</li>",
		'previous-marker'    => "<",
		'previous-link'           => "<a href=\"{uri}\">{page}</a>",

		'previous-inactive'       => "\n\t\t<li class=\"pager-button\">{link}</li>",
		'previous-inactive-link'  => "<a href=\"{uri}\">{page}</a>",

		'regular'                 => "\n\t\t<li class=\"pager-button\">{link}</li>",
		'regular-link'            => "<a href=\"{uri}\">{page}</a>",

		'active'                  => "\n\t\t<li class=\"pager-button pager-button-active\">{link}</li>",
		'active-link'             => "<a href=\"{uri}\"><span class=\"pure-button-active\">{page}</span></a>",

		'next'                    => "\n\t\t<li class=\"pager-button\">{link}</li>",
		'next-link'               => "<a href=\"{uri}\">{page}</a>",

		'next-inactive'           => "\n\t\t<li class=\"pager-button next\">{link}</li>",
		'next-marker'    => ">",
		'next-inactive-link'      => "<a href=\"{uri}\">{page}</a>",
		
		'last'                => "\t\t<li class=\"pager-button next\">{link}</li>",
		'last-marker'    => "最後",
		'last-link'           => "<a href=\"{uri}\">{page}</a>",
		
	),
);