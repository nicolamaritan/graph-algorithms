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

    class AdjacencyListGraph
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

            // Add to screen added vertex
            echo get_circle_tag($x, $y);

            $this->verteces_number++;
        }

        public function insert_edges($v, $w)
        {
            // Add w to v list v->w connection
            array_push($this->adj_list[$v], $w);

            // Specular. Add v to w list w->v connection
            array_push($this->adj_list[$w], $v);


            // i-th vertex position
            $x1 = $this->verteces_position[$v]->get_x();
            $y1 = $this->verteces_position[$v]->get_y();
            // His adjacent position
            $x2 = $this->verteces_position[$w]->get_x();
            $y2 = $this->verteces_position[$w]->get_y();
            echo "<script>draw_line($x1, $y1, $x2, $y2)</script>";

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
    echo "<canvas id = \"main_canvas\" style = \"border-style: solid;\"></canvas>";
    echo "<script>init();</script>";

    echo "
    <h4>Input:</h4>
    <form method = \"POST\">
        <label>x coordinates</label><br>
        <input type=\"text\" id = \"x_coordinates_id\" name = \"x_coordinates_name\"><br>
        <label>y coordinates</label><br>
        <input type=\"text\" id = \"y_coordinates_id\" name = \"y_coordinates_name\"><br>
        <label>edges</label><br>
        <input type=\"text\" id = \"edges_id\" name = \"edges_name\"><br>
        <input type = \"submit\" value = \"Submit\" name = \"submit\">
    </form>";


    $graph = new AdjacencyListGraph();

    /*
    $graph->insert_vertex(200, 400);
    $graph->insert_vertex(400, 200);
    $graph->insert_vertex(600, 400);
    $graph->insert_vertex(400, 600);

    $graph->insert_edges(0, 1);
    $graph->insert_edges(0, 2);
    $graph->insert_edges(2, 3);
    */
    if(isset($_POST["submit"]))
    {
        // Verteces
        $x_coordinates = $_POST["x_coordinates_name"];
        echo $x_coordinates . "<br>";

        $x_token = strtok($x_coordinates, " ");
        $x_coordinates_array = array();
        
        while ($x_token)
        {
            echo "$x_token<br>";
            array_push($x_coordinates_array, $x_token);
            $x_token = strtok(" ");
        }

        $y_coordinates = $_POST["y_coordinates_name"];
        echo $y_coordinates . "<br>";

        $y_token = strtok($y_coordinates, " ");
        $y_coordinates_array = array();
        
        while ($y_token)
        {
            echo "$y_token<br>";
            array_push($y_coordinates_array, $y_token);
            $y_token = strtok(" ");
        }

        $n = count($x_coordinates_array);
        for ($i = 0; $i < $n; $i++)
        {
            $graph->insert_vertex($x_coordinates_array[$i], $y_coordinates_array[$i]);
        }

        // Edges
        $edges = $_POST["edges_name"];
        $edges_array = array();
        echo $edges . "<br>";

        $edge_token = strtok($edges, " ");
        while ($edge_token)
        {
            echo "$edge_token<br>";
            //array_push($edges_array, $edge_token);
            $edge_token = strtok(" ");
        }

        /*$n = count($edges_array);
        for ($i = 0; $i < $n - 1; $i++)
        {
            $graph->insert_edges($edge_token[(int)$i], $edge_token[(int)$i + 1]);
        }*/
    }

    /*
    $graph->insert_vertex(200, 400);
    $graph->insert_vertex(350, 300);
    $graph->insert_vertex(300, 500);
    $graph->insert_vertex(500, 380);
    $graph->insert_vertex(480, 480);
    */

    /*
    $graph->insert_edges(0, 1);
    $graph->insert_edges(0, 2);
    $graph->insert_edges(2, 3);
    $graph->insert_edges(2, 4);
    $graph->insert_edges(3, 4);
    */

    //$graph->print_graph();

?>