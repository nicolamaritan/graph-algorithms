<?php
    interface Graph
    {
        public function get_verteces_number();
        public function get_edges_number();
    }

    class Position
    {
        private $x;
        private $y;

        function __construct($x, $y)
        {
            $this->x = $x;
            $this->y = $y;
        }

        function get_x(){return $this->x;}
        function get_y(){return $this->y;}
    }

    class AdjajencyListGraph implements Graph
    {
        private $verteces_number;
        private $edges_number;

        private $verteces_position;
        private $adj_list;

        function __construct($verteces, $edges)
        {
            $this->verteces_number = $verteces;
            $this->edges_number = $edges;

            // Creating adjacency list and vertex position array
            $this->adj_list = array();
            $this->verteces_position = array();

        }

        public function insert_vertex($x, $y)
        {
            array_push($this->verteces_position, new Position($x, $y));
            array_push($this->adj_list, array());
            $this->verteces_number++;
        }

        public function insert_edges($v, $w)
        {
            array_push($this->adj_list[$v], $w);
            array_push($this->adj_list[$w], $v);
            $this->edges_number++;
        }

        public function get_verteces_number(){return $this->verteces_number;}

        public function get_edges_number(){return $this->edges_number;}

        public function print_graph()
        {
            // For each vertex index
            for ($i = 0; $i < $this->verteces_number; $i++)
            {
                // Print circle in vertex position
                echo get_circle_tag($this->verteces_position[$i]->get_x(), $this->verteces_position[$i]->get_y());
                foreach ($this->adj_list[$i] as $adjacent_vertex_index)
                {
                    // i-th vertex position
                    $x1 = $this->verteces_position[$i]->get_x();
                    $y1 = $this->verteces_position[$i]->get_y();
                    // His adjacent position
                    $x2 = $this->verteces_position[$adjacent_vertex_index]->get_x();
                    $y2 = $this->verteces_position[$adjacent_vertex_index]->get_y();
                    
                    // Plot line
                    //echo get_line_tag($x1, $y1, $x2, $y2);
                    echo "<script>draw_line($x1, $y1, $x2, $y2)</script>";
                }
            }
        }
    }


    /**
     * Returns a div tag containing an img tag with absolute position respect to body.
     * @param type $x x pixels from left border.
     * @param type $y y pixels from top border.
     */
    function get_circle_tag($x, $y)
    {
        $radius = 25;
        $div_style = "position: absolute; top: " . (string)$y .
                        "px; left: " . (string)$x . "px;";
        $img_style = "width: " . (string)(2 * $radius) . "; height: " . (string)(2 * $radius) . ";";

        $div_open_tag = "<div style = \"" . $div_style . "\">";
        $div_close_tag = "</div>";
        $img_tag = "<img src = \"../images/circle.png\" style = \"" . $img_style . "\">";
        return $div_open_tag . $img_tag . $div_close_tag;
    }

    function get_line_tag($x1, $y1, $x2, $y2)
    {
        /*$med_x = abs($x1+$x2)/2;
        $med_y = abs($y1+$y2)/2;

        $hr_style = "position: absolute; top: " . (string)$med_y .
        "px; left: " . (string)$med_x . "px;";
        $hr_style .= (" width: " . (string)sqrt($med_x*$med_x + $med_y*$med_y) . ";");

        return "<hr style = \"" . $hr_style . "\">";
        */

        $med_x = abs($x1+$x2)/2;
        $med_y = abs($y1+$y2)/2;

        $line_tag = "<line x1 = \"" . $x1 . "\" y1 = \"" . $y1 . "\" x2 = \"" . $x2 . "\" y2 = \"" . $y2 . "\"
        style=\"stroke:rgb(255,0,0);stroke-width:2\">";
        return "<svg height=\"210\" width=\"500\">" . $line_tag . "Sorry, your browser does not support inline SVG." . "</svg>";
        
    }

    // Loading external scripts
    echo "<script type = \"text/javascript\" src = \"../scripts/init.js\"></script>";
    echo "<script type = \"text/javascript\" src = \"../scripts/draw_line.js\"></script>";

    echo "<canvas id = \"main_canvas\"></canvas>";
    echo "<script>init();</script>";
    echo "Page start.";

    /*$x = 300;
    $y = 500;

    echo get_circle_tag(500, 500);
    echo get_circle_tag(400, 500);
    echo get_circle_tag(300, 500);
    */

    // Gli arg per ora non influenzano
    $graph = new AdjajencyListGraph(0, 0);

    $graph->insert_vertex(200, 400);
    $graph->insert_vertex(400, 200);
    $graph->insert_vertex(600, 400);
    $graph->insert_vertex(400, 600);

    $graph->insert_edges(0, 1);
    $graph->insert_edges(0, 2);
    $graph->insert_edges(2, 3);

    $graph->print_graph();

?>