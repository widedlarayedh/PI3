<?php

namespace AppBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use ProduitBundle\Entity\Categorie;
use ProduitBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function dashboardAction(Request $request)
    {$pieChart = new PieChart();
        $em = $this->getDoctrine();
        $categories= $em->getRepository(Categorie::class)->createQueryBuilder('a')
            ->select('a')->getQuery()
            ->getArrayResult();
        $ta[] = ['categorie', 'nombre de produit'];
        foreach($categories as $cat){
            $ta[] = [$cat['nomCategorie'] ,count($em->getRepository(Produit::class)->findBy(['categorie'=> $cat]))];
        }
//        $tab= array_column($categories, 'nomCategorie');
//        $tab2[0] =[ $tab[1]=> 11];
     //   return new JsonResponse($ta);
        $pieChart->getData()->setArrayToDataTable(
           $ta
        );
        $pieChart->getOptions()->setTitle('Produit par categorie');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('default/dashboard.html.twig', array('piechart' => $pieChart));

    }

}
