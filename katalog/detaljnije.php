<?php
if (filter_input(INPUT_GET, 'id') == NULL) {
    header("location: /katalog/");
} else {
    $include_div = 'detaljnije_div.php';
    include_once '../main_page.php';
}
?>
<script type="text/javascript">
    window.onload = function() {
        if (typeof history.pushState === "function") {
            history.pushState("jibberish", null, null);
            window.onpopstate = function() {
                history.pushState('newjibberish', null, null);
                window.onbeforeunload = window.location.replace("/katalog/");
                // Handle the back (or forward) buttons here
                // Will NOT handle refresh, use onbeforeunload for this.
            };
        }
        else {
            var ignoreHashChange = true;
            window.onhashchange = function() {
                if (!ignoreHashChange) {
                    ignoreHashChange = true;
                    window.location.hash = Math.random();
                    // Detect and redirect change here
                    // Works in older FF and IE9
                    // * it does mess with your hash symbol (anchor?) pound sign
                    // delimiter on the end of the URL
                }
                else {
                    ignoreHashChange = false;
                }
            };
        }
    }
</script>
