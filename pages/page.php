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
        <input type=\"text\" id = \"x_coordinates_id\" name = \"x_coordinates_name\" style = \"width: 50%\"><br>

        <label>y coordinates</label><br>
        <input type=\"text\" id = \"y_coordinates_id\" name = \"y_coordinates_name\" style = \"width: 50%\"><br>
        
        <label>Edges</label><br>
        <input type=\"text\" id = \"edges_id\" name = \"edges_name\" style = \"width: 50%\"><br>

        <label>Algorithm</label><br>
        <select id = \"alg_id\" name = \"alg_name\" style = \"width:150px;\ size = 1\"><br>
            <option value=\"DFS\">DFS</option>
        </select>
        <br>
        
        <input type = \"submit\" value = \"Submit\" name = \"submit\">

    </form>";


    // Graph instantiation
    $graph = new AdjacencyListGraph();

    // Process input
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

        // Counts the input coordinates...
        $n_x = count($x_coordinates_array);
        $n_y = count($y_coordinates_array);

        // ... and if they're different throw error.
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

        // Tokenizes edges in edges_array
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

        // Choose the alg based on form value
        switch($_POST["alg_name"])
        {
            case "DFS":
                $dfs_proc = new DFSProcessor($graph, 0);
                break;
        }
        
    }

?>