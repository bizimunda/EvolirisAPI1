<?php
/**
 * Created by PhpStorm.
 * User: temp
 * Date: 1/09/2016
 * Time: 16:06
 */
namespace APIBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ArtisteController extends Controller  {

    public function readAction( Request $request){
        $get=$request->query;

        if($get->has("s")){
            return $this->forward("APIBundle:Artiste:getByName", array("request"=>$request));
        } elseif ($get->has("as")){
            return $this->forward("APIBundle:Artiste:getPseudoContains", array("request"=>$request));
        }
        die;

        $em=$this->getDoctrine()->getManager();
        $artistes=$em->getRepository("APIBundle:Artiste")->findAll();

        $json=array();
        foreach ($artistes as $artiste){
            array_push($json,$artiste->toJSON());
        }
        return new JsonResponse($json);

    }
    public function createAction(){
        echo "Create";
    }

    public function deleteAction(){
        echo "Delete";
    }

    public function updateAction(){
        echo "Update";
    }

    public function getPseudoContainsAction(Request $request){

        $pseudoPart=$request->query->get("as");
        $em=$this->getDoctrine()->getManager();
        $artistes=$em->getRepository("APIBundle:Artiste")->findByPseudoPart(array(
            "pseudo"=>$pseudoPart
        ));
        $json=array();
        foreach ($artistes as $artiste){
            array_push($json,$artiste->toJSON());
        }


        return new JsonResponse($json);

    }

    public function getByNameAction(Request $request){

        $pseudo=$request->query->get("s");
        $em=$this->getDoctrine()->getManager();
        $artistes=$em->getRepository("APIBundle:Artiste")->findBy(array(
           "pseudo"=>$pseudo
        ));
        $json=array();
        foreach ($artistes as $artiste){
            array_push($json,$artiste->toJSON());
        }


        return new JsonResponse($json);

    }

}