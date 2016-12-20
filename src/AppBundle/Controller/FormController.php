<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Objeto\Pessoa;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormController extends Controller {
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
      // create a task and give it some dummy data for this example
        $pessoa = new Pessoa();
        $pessoa->setNome("");

        $form = $this->createFormBuilder($pessoa)
            ->add('nome', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Criar Pessoa'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
          // $form->getData() holds the submitted values
          // but, the original `$task` variable has also been updated
          $pessoa = $form->getData();

          // ... perform some action, such as saving the task to the database
          // for example, if Task is a Doctrine entity, save it!
          // $em = $this->getDoctrine()->getManager();
          // $em->persist($task);
          // $em->flush();

          return $this->redirectToRoute('sucesso', array('nome' => $pessoa->getNome()));
        } else {
          echo "Seu nome ainda não foi submetido";
        }

        return $this->render('exemplo-form/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{nome}", name="sucesso")
     */
     public function sucessoAction($nome) {

       return $this->render('exemplo-form/sucesso.html.twig', array('nome' => $nome));
     }
}
?>
