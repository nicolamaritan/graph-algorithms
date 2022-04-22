<?php
    include "graph.php";


    // Loading external scripts
    echo "<script type = \"text/javascript\" src = \"../scripts/init.js\"></script>";
    echo "<script type = \"text/javascript\" src = \"../scripts/draw_line.js\"></script>";

    // Creating whole screen canvas
    echo "<canvas id = \"main_canvas\" style = \"border-style: solid;\"></canvas>";
    echo "<script>init();</script>";

    // Form output
    echo "
    <h4>Input:</h4>
    <form method = \"POST\">
        <label>x coordinates</label><br>
        <input type=\"text\" id = \"x_coordinates_id\" name = \"x_coordinates_name\"><br>

        <label>y coordinates</label><br>
        <input type=\"text\" id = \"y_coordinates_id\" name = \"y_coordinates_name\"><br>
        
        <label>Edges</label><br>
        <input type=\"text\" id = \"edges_id\" name = \"edges_name\"><br>

        <label>Algorithm</label><br>
        <select id = \"alg_id\" name = \"alg_name\" style = \"width:150px;\ size = 1\"><br>
            <option value=\"DFS\">DFS</option>
        </select>
        <br>
        

        <input type = \"submit\" value = \"Submit\" name = \"submit\">

        


    </form>";


    $graph = new AdjacencyListGraph();


    if(isset($_POST["submit"]))
    {
        // x coordinates
        $x_coordinates = $_POST["x_coordinates_name"];
        $x_token = strtok($x_coordinates, " ");
        $x_coordinates_array = array();
        
        while ($x_token !== false)
        {
            array_push($x_coordinates_array, $x_token);
            $x_token = strtok(" ");
        }

        // y coordinates
        $y_coordinates = $_POST["y_coordinates_name"];
        $y_token = strtok($y_coordinates, " ");
        $y_coordinates_array = array();
        
        while ($y_token !== false)
        {
            array_push($y_coordinates_array, $y_token);
            $y_token = strtok(" ");
        }

        $n_x = count($x_coordinates_array);
        $n_y = count($y_coordinates_array);

        if ($n_x != $n_y)
        {
            echo '<script type ="text/JavaScript">';  
            echo 'alert("x and y coordinates numbers must match.")';  
            echo '</script>'; 
            return;
        }

        $n = count($x_coordinates_array);
        for ($i = 0; $i < $n; $i++)
        {
            $graph->insert_vertex($x_coordinates_array[$i], $y_coordinates_array[$i]);
        }

        // Edges
        $edges = $_POST["edges_name"];
        $edges_array = array();
        $edge_token = strtok($edges, " ");

        // tokenizes edges in edges_array
        while ($edge_token !== false)
        {
            array_push($edges_array, $edge_token);
            $edge_token = strtok(" ");
        }

        // For each pair of verteces draw a edge
        $n = count($edges_array);
        for ($i = 0; $i < $n - 1; $i += 2)
        {
            $graph->insert_edges($edges_array[$i], $edges_array[$i + 1]);
        }
    }

?>