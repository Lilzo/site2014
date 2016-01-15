var $j = jQuery.noConflict();
function LeavePageAtTheTop()
{
    var dir = window.location.pathname;
    var trenutniHash = window.location.hash;

    if (dir === "/o_nama.php"
            || dir === "/korpa.php"
            || window.location.hash === "#ponuda"
            || window.location.hash === "#o_sektoru"
            || window.location.hash === "#kontakt"
            || window.location.hash === "#reference"
            || window.location.hash === "#download"
            || window.location.hash === "#vijest"
            || window.location.hash === "#novosti"
            || window.location.hash === "#oprema"
            || window.location.hash === "#zemljiste"
            || window.location.hash === "#o_nama"
            || window.location.hash === "#politika_kvaliteta"
            || window.location.hash === "#sertifikati"
            || window.location.hash === "#priznanja"
            || window.location.hash === "#informisanje"
            || window.location.hash === "#kultura"
            || window.location.hash === "#kontakt"
            || window.location.hash === "#predsjednik"
            || window.location.hash === "#email"
            || window.location.hash === "#cart"
            || window.location.hash === "#zahtjev"
            || window.location.hash === "#kontakt-info")
    {
        $j("html, body").animate({scrollTop: 0}, 0.9);
    }
}
function VTickerCall()
{
    $j(function() {
        $j('#news-container').vTicker({
            speed: 300,
            pause: 4000,
            animation: 'fade',
            mousePause: true,
            showItems: 3
        });
    });
}
function CollapsibleLeftMenu()
{
    $j(document).ready(function() {
        //collapsible management
        $j('.collapsible').collapsible({
            defaultOpen: 'nav-section1,nav-section2'
        });
    });
}
//preventScroll zadržava prikaz strane na vrhu pri kliku na isti link u header meniju
//poziva se ispod header menija
function preventScroll() //sprječava skrolovanje na ponovni klik na stavku iz header menija
{
    $j("div#navmenu, a").click(function() {
        $j("html, body").animate({scrollTop: 0}, "slow");
    });
}
;
function preventHash() //prevencija da skroluje hash tag, podešeno je na strani menija lijevo da ne skroluje za odredjene hash tagove
{
    $j('a[href="#"]').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
    });
}
;

var fullHashtag = window.location.hash;
function glavniTab()
{
    if (fullHashtag !== '') { //ako je definisan hash
        hashtag = fullHashtag.split("?")[0]; //ako se iza hashtaga nalaze varijable, ukloniće ih
                                            //da ne dodje do zabune pri izboru taba
       if((hashtag === '#o_sektoru')
               ||(hashtag === '#ponuda')
               ||(hashtag === '#download')
               ||(hashtag === '#kontakt')
               ||(hashtag === '#reference')
               ||(hashtag === '#one_tab')
               ||(hashtag === '#email')
               ||(hashtag === '#kontakt')
               ||(hashtag === '#predsjednik')
               ||(hashtag === '#vijest')
               ||(hashtag === '#novosti')
               ||(hashtag === '#o_nama')
               ||(hashtag === '#sertifikati')
               ||(hashtag === '#priznanja')
               ||(hashtag === '#politika-kvaliteta')
               ||(hashtag === '#informisanje')
               ||(hashtag === '#kultura')
               ||(hashtag === '#zemljiste')
               ||(hashtag === '#oprema')
               ||(hashtag === "#cart")
               ||(hashtag === "#zahtjev")
               ||(hashtag === "#kontakt-info")
                ) 
        { 
            var glavniTabVarijabla = hashtag;
        } 
        else {
             var glavniTabVarijabla = ':first-child';//ako je hash tag različit od postojećih tabova
        }      
    }
    else {
        var glavniTabVarijabla = ':first-child';
    }
    
    $j(document).ready(function() {
        $j('#tab-container').easytabs('select', glavniTabVarijabla); //{defaultTab: '#kontakt'}
    });
}
;
function GetURLParameter(sParam) //funkcija za čitanje varibli iz url
{                               //ukoliko lokacija nema hash, zamjeniti hash sa search u liniji ispod
    var PageURL = window.location.hash.substring(1);
    var sPageURL = PageURL.substring(PageURL.indexOf('?') + 1);
    console.log(sPageURL);
    var sURLVariables = sPageURL.split('&');

    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] === sParam)
        {
            return sParameterName[1];
        }
    }
}
;

function OrbitCall() {
    $j(window).load(function() {
        $j('#featured').orbit();
    });
}
function ScrollToSearchedItem()
{
 /*
    if (hashtag === '#o_sektoru') {
        var positionOfDiv = $j(searchedElementHash).position().top - divPonudaHeight;
    } else if (hashtag === '#reference') {
        var positionOfDiv = $j(searchedElementHash).position().top - divOSektoruHeight;
    } else if (hashtag === '#download') {
        var positionOfDiv = $j(searchedElementHash).position().top - divReferenceHeight;
    } else if (hashtag === '#kontakt') {
        var positionOfDiv = $j(searchedElementHash).position().top - divDownloadHeight - 10;
    } else {
        var positionOfDiv = $j(searchedElementHash).position().top;
    }
 */
    switch (hashtag)
    {
        case '#o_sektoru':
            var positionOfDiv = $j(searchedElementHash).position().top - divPonudaHeight;
            break;
        case '#reference':
            var positionOfDiv = $j(searchedElementHash).position().top - divOSektoruHeight;
            break;
        case '#download':
            var positionOfDiv = $j(searchedElementHash).position().top - divReferenceHeight;
            break;
        case '#kontakt':
            var positionOfDiv = $j(searchedElementHash).position().top - divDownloadHeight - 10;
            break;
        case '#politika-kvaliteta':
            var positionOfDiv = $j(searchedElementHash).position().top - divONamaHeight;
            break;
        case '#sertifikati':
            var positionOfDiv = $j(searchedElementHash).position().top - divPolitikaKvalitetaHeight;
            break;
        case '#priznanja':
             var positionOfDiv = $j(searchedElementHash).position().top - divSertifikatiHeight;
            break;
        case '#informisanje':
             var positionOfDiv = $j(searchedElementHash).position().top - divPriznanjaHeight - 10;
            break;
        case '#kultura':
            var positionOfDiv = $j(searchedElementHash).position().top - divInformisanjeHeight -23;
            break;
        case '#predsjednik':
            var positionOfDiv = $j(searchedElementHash).position().top - divKontaktHeight - 10;
            break;
        case '#zemljiste':
            var positionOfDiv = $j(searchedElementHash).position().top - divOpremaHeight;
            break;
        default:
            var positionOfDiv = $j(searchedElementHash).position().top;
        
    }
    $j("html, body").animate({scrollTop: positionOfDiv}, 1000);
}
;

/*
 * jQuery Highlight plugin
 *
 * Based on highlight v3 by Johann Burkard
 * http://johannburkard.de/blog/programming/javascript/highlight-javascript-text-higlighting-jquery-plugin.html
 *
 * Code a little bit refactored and cleaned (in my humble opinion).
 * Most important changes:
 *  - has an option to highlight only entire words (wordsOnly - false by default),
 *  - has an option to be case sensitive (caseSensitive - false by default)
 *  - highlight element tag and class names can be specified in options
 *
 * Usage:
 *   // wrap every occurrance of text 'lorem' in content
 *   // with <span class='highlight'> (default options)
 *   $('#content').highlight('lorem');
 *
 *   // search for and highlight more terms at once
 *   // so you can save some time on traversing DOM
 *   $('#content').highlight(['lorem', 'ipsum']);
 *   $('#content').highlight('lorem ipsum');
 *
 *   // search only for entire word 'lorem'
 *   $('#content').highlight('lorem', { wordsOnly: true });
 *
 *   // don't ignore case during search of term 'lorem'
 *   $('#content').highlight('lorem', { caseSensitive: true });
 *
 *   // wrap every occurrance of term 'ipsum' in content
 *   // with <em class='important'>
 *   $('#content').highlight('ipsum', { element: 'em', className: 'important' });
 *
 *   // remove default highlight
 *   $('#content').unhighlight();
 *
 *   // remove custom highlight
 *   $('#content').unhighlight({ element: 'em', className: 'important' });
 *
 *
 * Copyright (c) 2009 Bartek Szopka
 *
 * Licensed under MIT license.
 *
 */

jQuery.extend({
    highlight: function(node, re, nodeName, className) {
        if (node.nodeType === 3) {
            var match = node.data.match(re);
            if (match) {
                var highlight = document.createElement(nodeName || 'span');
                highlight.className = className || 'highlight';
                var wordNode = node.splitText(match.index);
                wordNode.splitText(match[0].length);
                var wordClone = wordNode.cloneNode(true);
                highlight.appendChild(wordClone);
                wordNode.parentNode.replaceChild(highlight, wordNode);
                return 1; //skip added node in parent
            }
        } else if ((node.nodeType === 1 && node.childNodes) && // only element nodes that have children
                !/(script|style)/i.test(node.tagName) && // ignore script and style nodes
                !(node.tagName === nodeName.toUpperCase() && node.className === className)) { // skip if already highlighted
            for (var i = 0; i < node.childNodes.length; i++) {
                i += jQuery.highlight(node.childNodes[i], re, nodeName, className);
            }
        }
        return 0;
    }
});

jQuery.fn.unhighlight = function(options) {
    var settings = {className: 'highlight', element: 'span'};
    jQuery.extend(settings, options);

    return this.find(settings.element + "." + settings.className).each(function() {
        var parent = this.parentNode;
        parent.replaceChild(this.firstChild, this);
        parent.normalize();
    }).end();
};

jQuery.fn.highlight = function(words, options) {
    var settings = {className: 'highlight', element: 'span', caseSensitive: false, wordsOnly: false};
    jQuery.extend(settings, options);

    if (words.constructor === String) {
        words = [words];
    }
    words = jQuery.grep(words, function(word, i) {
        return word != '';
    });
    words = jQuery.map(words, function(word, i) {
        return word.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
    });
    if (words.length == 0) {
        return this;
    }
    ;

    var flag = settings.caseSensitive ? "" : "i";
    var pattern = "(" + words.join("|") + ")";
    if (settings.wordsOnly) {
        pattern = "\\b" + pattern + "\\b";
    }
    var re = new RegExp(pattern, flag);

    return this.each(function() {
        jQuery.highlight(this, re, settings.element, settings.className);
    });
};

/*ostale funkcije za pretragu  div pretrage */

function mouseOverMagnifier()
{
    $j("#img-srch").mouseover(function() {
        $j("#search-block").css("visibility", "visible").animate({
            left: "-172px",
            width: "172px"
        }, 300);
        $j("#search-block").delay(400).focus();
    });
}
;

function mouseLeaveMagnifier() {
    $j("#img-srch").mouseleave(function() {
        setTimeout(function() {
            $j("#search-block").animate({
                left: "0px",
                width: "0px"
            }, 1300);
        }, 9000),
                setTimeout(function() {
                    $j("#search-block").css("visibility", "hidden")
                }, 10300)
    });
}
;
function lostFocus()
{
    $j("#search-block").blur(function() {
        $j("#search-block").animate({
            left: "0px",
            width: "0px"
        }, 300);
        setTimeout(function() {
            $j("#search-block").css("visibility", "hidden")
        }, 300)
    });
}
;