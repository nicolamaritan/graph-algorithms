<?php
    /**
     * Returns a div tag containing an img tag with absolute position respect to body.
     * @param type $x x pixels from left border.
     * @param type $y y pixels from top border.
     */
    function get_circle_tag($x, $y)
    {
        $div_style = "position: absolute; top: " . (string)$y .
                        "px; left: " . (string)$x . "px;";
        $img_style = "width: 50px; height: 50px";

        $div_open_tag = "<div style = \"" . $div_style . "\">";
        $div_close_tag = "</div>";
        $img_tag = "<img src = \"../images/circle.png\" style = \"" . $img_style . "\">";
        return $div_open_tag . $img_tag . $div_close_tag;
    }


    echo "Page start.";

    $x = 300;
    $y = 500;

    echo get_circle_tag(500, 500);
    echo get_circle_tag(400, 500);
    echo get_circle_tag(300, 500);

?>