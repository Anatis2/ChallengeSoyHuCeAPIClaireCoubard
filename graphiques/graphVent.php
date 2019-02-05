<?php // content="text/plain; charset=utf-8"
    require_once ('../jpgraph-4.2.6/src/jpgraph.php');
    require_once ('../jpgraph-4.2.6/src/jpgraph_line.php');

    $datay1 = array(20,15,23,15);
    $datay2 = array(12,9,42,8);
    $datay3 = array(5,17,32,24);

    // Setup the graph
    $graph = new Graph(450,350); // Permet d'instancier un graphique avec sa taille (largeur, hauteur)
    $graph->SetScale("textlin");

    $theme_class=new UniversalTheme;

    $graph->SetTheme($theme_class);
    $graph->img->SetAntiAliasing(false);
    $graph->title->Set('Vitesse du vent'); // Permet d'ajouter un titre au graphique
    $graph->SetBox(false);

    $graph->SetMargin(40,20,36,75); // Permet de définir les marges aux alentours du graphique en lui-même (gauche, droite, haut, bas)

    $graph->img->SetAntiAliasing();

    $graph->yaxis->HideZeroLabel();
    $graph->yaxis->HideLine(false);
    $graph->yaxis->HideTicks(false,false);

    $graph->xgrid->Show();
    $graph->xgrid->SetLineStyle("solid");
    $graph->xaxis->SetTickLabels(array('A','B','C','D'));
    $graph->xgrid->SetColor('#E3E3E3');

    // Create the first line
    $p1 = new LinePlot($datay1);
    $graph->Add($p1);
    $p1->SetColor("#6495ED");
    $p1->SetLegend('Température');

    // Create the second line
    $p2 = new LinePlot($datay2);
    $graph->Add($p2);
    $p2->SetColor("#B22222");
    $p2->SetLegend('Pression');

    // Create the third line
    $p3 = new LinePlot($datay3);
    $graph->Add($p3);
    $p3->SetColor("#FF1493");
    $p3->SetLegend('Humidité');

    $graph->legend->SetFrameWeight(1);

    // Output line
    $graph->Stroke(); // Permet de générer le graphique

?>


