<?php
//src/Controller/MainController.php
namespace App\Controller;

use App\Utility\WordUtility;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Vocabulary;


class MainController extends AbstractController
{

    public function test(Request $request): Response
    {
        //get all elements in db as objects into a 2d array
        $arr_vocabs = $this->getDoctrine()->getRepository(Vocabulary::class)->findAll();
        #var_dump($test);

        //test connection
        if(!$arr_vocabs)
        {
            throw $this->createNotFoundException('No vocab found');
        }

        /*
         * get random words and id
         * list keyword for simulating multiple returns
         * esp_rand_id holds the id (in the db) of the random word
         * esp_rand_word is the current random word which you can see in the frontend
         * ger_"" is the equivalent translation
         *  */
        list($rand_id, $esp_rand_word, $ger_rand_word ) = $this->getRandomSpanish($arr_vocabs);
        #echo $ger_rand_word;
        /**//**//**/// render twig template
        return $this->render('voc_main/index.html.twig',
        [
            'vocabs' => $arr_vocabs,
            'spanish_random_word' => $esp_rand_word,
            'compare_id' => $rand_id
        ]);
    }


    public function getRandomSpanish($arr)
    {
        // get random index number from array\\
        $int_random = array_rand($arr, 1);

        // get random element based on $int_random - id in the array
        $search_random = $arr[$int_random];

        // generate words and specific id
        $german = $search_random->getGerman();
        $spanish = $search_random->getSpanish();
        $id = $search_random->getId();

        return array($id, $spanish, $german);
    }


    public function compareVocabs(Request $request)
    {
        $vocabularyRepository = $this->getDoctrine()->getRepository(Vocabulary::class);
        $arr_vocabs = $vocabularyRepository->findAll();

        $user_answer = trim($request->request->get('antwort'));
        $old_id = $request->request->get('vergleich');

        #$compare_ger_word;
        foreach($arr_vocabs as $element) {
            if($old_id == $element->getId()){
                $compare_ger_word = $element->getGerman();
            }
        }

        if (!empty($user_answer)) {
            // generate new word
            list($rand_id, $esp_rand_word, $ger_rand_word ) = $this->getRandomSpanish($arr_vocabs);
            if (strtolower($user_answer) == strtolower($compare_ger_word)) {
                $arr = [
                    'compareResult' => 'Deine Antwort ist richtig',
                    'newVocab' => $esp_rand_word,
                    'compare_id' => $rand_id,
                ];
            } else {
                $arr = [
                    'compareResult' => 'Deine Antwort ist falsch',
                    'newVocab' => $esp_rand_word,
                    'compare_id' => $rand_id,
                ];
            }
            header('Content-Type: application/json; charset=utf-8');
            die(json_encode($arr));
        }//end of if
    }//end of compareVocabs()

    public function appAPI(Request $request)
    {
        $vocabularyRepository = $this->getDoctrine()->getRepository(Vocabulary::class);
        $arr_vocabs = $vocabularyRepository->findAll();

        $user_answer = trim($request->request->get('antwort'));
        //$user_answer_app = $_POST[$user_answer];
        $old_id = $request->request->get('vergleich');

        $compare_ger_word = "";
        foreach($arr_vocabs as $element) {
            if($old_id == $element->getId()){
                $compare_ger_word = $element->getGerman();
            }
        }

       # if (!empty($user_answer)) {
            // generate new word
            list($rand_id, $esp_rand_word, $ger_rand_word ) = $this->getRandomSpanish($arr_vocabs);
            if (strtolower($user_answer) == strtolower($compare_ger_word)) {
                $arr = [
                    'debugTRUE' => 'du bist heir richtig',
                    'user_answer_old' => '',
                    'compareResult' => 'Deine Antwort ist richtig',
                    'newVocab' => $esp_rand_word,
                    'compare_id' => $rand_id,
                    'compare_german' => $ger_rand_word,
                    'antwort' => $user_answer,
                    'old id' => $old_id,
                    'deutsch debug' => $compare_ger_word

                ];
            } else {
                $arr = [
                    'compareResult' => 'Deine Antwort ist falsch',
                    'newVocab' => $esp_rand_word,
                    'compare_id' => $rand_id,
                ];
            }
            header('Content-Type: application/json; charset=utf-8');
            die(json_encode($arr));
        #}//end of if
    }//end of compareVocabs()
}//end of class



