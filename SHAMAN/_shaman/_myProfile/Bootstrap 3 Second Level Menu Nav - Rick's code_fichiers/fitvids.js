/*global jQuery *//*!
* FitVids 1.0
*
* Copyright 2011, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
* Date: Thu Sept 01 18:00:00 2011 -0500
*/(function(e){e.fn.fitVids=function(t){var n={customSelector:null},r=document.createElement("div"),i=document.getElementsByTagName("base")[0]||document.getElementsByTagName("script")[0];r.className="fit-vids-style";r.innerHTML="&shy;<style>               .fluid-width-video-wrapper {                 width: 100%;                              position: relative;                       padding: 0;                            }                                                                                   .fluid-width-video-wrapper iframe,        .fluid-width-video-wrapper object,        .fluid-width-video-wrapper embed {           position: absolute;                       top: 0;                                   left: 0;                                  width: 100%;                              height: 100%;                          }                                       </style>";i.parentNode.insertBefore(r,i);t&&e.extend(n,t);return this.each(function(){var t=["iframe[src^='http://player.vimeo.com']","iframe[src^='http://www.youtube.com']","iframe[src^='http://www.kickstarter.com']","iframe[src^='http://fast.wistia.com']","object","embed"];n.customSelector&&t.push(n.customSelector);var r=e(this).find(t.join(","));r.each(function(){var t=e(this);if(this.tagName.toLowerCase()=="embed"&&t.parent("object").length||t.parent(".fluid-width-video-wrapper").length)return;var n=this.tagName.toLowerCase()=="object"?t.attr("height"):t.height(),r=n/t.width();t.wrap('<div class="fluid-width-video-wrapper" />').parent(".fluid-width-video-wrapper").css("padding-top",r*100+"%");t.removeAttr("height").removeAttr("width")})})}})(jQuery);