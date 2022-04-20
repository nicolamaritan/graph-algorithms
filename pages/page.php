<?php


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

    class AdjajencyListGraph
    {
        private $verteces_number;
        private $edges_number;

        private $verteces_position;
        private $adj_list;


        public function __construct()
        {
            $this->verteces_number = 0;
            $this->edges_number = 0;

            // Creating adjacency list and vertex position array
            $this->adj_list = array();
            $this->verteces_position = array();

        }

        /**
         * Insert a vertex in the graph at position (x, y).
         * @param int $x x vertex coordinate.
         * @param int $y y vertex coordinate.
         */
        public function insert_vertex($x, $y)
        {
            // Insert Position element into verteces_position end
            array_push($this->verteces_position, new Position($x, $y));

            // Add a new array adj_list end
            array_push($this->adj_list, array());
            $this->verteces_number++;
        }

        public function insert_edges($v, $w)
        {
            // Add w to v list v->w connection
            array_push($this->adj_list[$v], $w);

            // Specular. Add v to w list w->v connection
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
                    
                    // Plot line calling draw_line JavaScript
                    echo "<script>draw_line($x1, $y1, $x2, $y2)</script>";
                }
            }
        }
    }


    /**
     * Returns a div tag containing an img tag with absolute position respect to body.
     * @param int $x x pixels from left border.
     * @param int $y y pixels from top border.
     */
    function get_circle_tag($x, $y)
    {
        $radius = 30;
        $edge_shift = 7;    // empirical, 7px of shift from upper left border
        $shifted_x = $x + $edge_shift - $radius;
        $shifted_y = $y + $edge_shift - $radius;
        $div_style = "position: absolute; top: " . (string)$shifted_y .
                        "px; left: " . (string)$shifted_x . "px;";
        $img_style = "width: " . (string)(2 * $radius) . "; height: " . (string)(2 * $radius) . ";";

        $div_open_tag = "<div style = \"" . $div_style . "\">";
        $div_close_tag = "</div>";
        $img_tag = "<img src = \"../images/circle.png\" style = \"" . $img_style . "\">";
        return $div_open_tag . $img_tag . $div_close_tag;
    }


    // Loading external scripts
    echo "<script type = \"text/javascript\" src = \"../scripts/init.js\"></script>";
    echo "<script type = \"text/javascript\" src = \"../scripts/draw_line.js\"></script>";

    // Creating whole screen canvas
    echo "<canvas id = \"main_canvas\"></canvas>";
    echo "<script>init();</script>";

    echo "Page start.";

    // Gli arg per ora non influenzano
    $graph = new AdjajencyListGraph();

    /*
    $graph->insert_vertex(200, 400);
    $graph->insert_vertex(400, 200);
    $graph->insert_vertex(600, 400);
    $graph->insert_vertex(400, 600);

    $graph->insert_edges(0, 1);
    $graph->insert_edges(0, 2);
    $graph->insert_edges(2, 3);
    */

    $graph->insert_vertex(200, 400);
    $graph->insert_vertex(350, 300);
    $graph->insert_vertex(300, 500);
    $graph->insert_vertex(500, 380);
    $graph->insert_vertex(480, 480);

    $graph->insert_edges(0, 1);
    $graph->insert_edges(0, 2);
    $graph->insert_edges(2, 3);
    $graph->insert_edges(2, 4);
    $graph->insert_edges(3, 4);

    $graph->print_graph();

?>