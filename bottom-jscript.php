<script type="text/javascript">
    $j("#img-srch").mouseover(function() {
        $j("#search-block").css("visibility", "visible").animate({
            left: "-162px",
            width: "162px"
        }, 300);
        $j("#search-block").delay(400).focus();
    });

    $j("#img-srch").mouseleave(function() {
        setTimeout(function() {
            $j("#search-block").animate({
                left: "0px",
                width: "0px"
            }, 1300);
        }, 7000),
                setTimeout(function() {
                    $j("#search-block").css("visibility", "hidden")
                }, 8300)
    });

    $j("#search-block").blur(function() {
        $j("#search-block").animate({
            left: "0px",
            width: "0px"
        }, 300);
        setTimeout(function() {
            $j("#search-block").css("visibility", "hidden")
        }, 300)
    });
    // skroll nakon pretrage
    if (typeof GetURLParameter('keyword') != 'undefined')
    {

        var searchedElementHash = '#' + GetURLParameter('shwprt');
        var searchedWords = GetURLParameter('keyword').split('_');
        //  console.log(searchedWords);

        var divPonudaHeight = $j('#ponuda').outerHeight();
        var divOSektoruHeight = $j('#o_sektoru').outerHeight() + divPonudaHeight;
        var divReferenceHeight = $j('#reference').outerHeight() + divOSektoruHeight;
        var divDownloadHeight = $j('#download').outerHeight() + divReferenceHeight;

        if (fullHashtag.length > 12) {
            ScrollToSearchedItem();
            $j(hashtag).highlight(searchedWords);
        }
    }
</script>