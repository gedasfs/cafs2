<?php

namespace App\Classes;

use App\Classes\Tag;

class Card
{
    static public function buildCardContent($questionData, $totalQ, $currQ, $quizzName)
    {   
        $cardHtml = '';
        
        $currOverTotal = sprintf('(%s/%s)', $currQ, $totalQ);
        $points = sprintf('(Points: %s)', $questionData['possiblePoints']);

        // card header
        $h6 = new Tag('h6');
        $h6->setAttr('class', 'card-header d-flex flex-column flex-sm-row');

        $h6Body = sprintf('Q: %s ', $questionData['q']);
        $h6Body .= (new Tag('span'))
                    ->setAttr('class', 'fs-6 text-secondary mt-2 mt-sm-0 ms-sm-2')
                    ->setText($points)
                    ->get();
        $h6Body .= (new Tag('span'))
                    ->setAttr('class', 'fs-6 text-secondary mt-2 mt-sm-0 ms-auto')
                    ->setText($currOverTotal)
                    ->get();
        $h6->setText($h6Body);
                        
        $cardHtml .= $h6->get();


        // card body (content)
        $cardContent = new Tag('div');
        $cardContent->setAttr('class', 'card-body');

        $cardContentBody = ''; 

        $cardContentBody .= (new Tag('input'))
                            ->setAttr('type', 'hidden')
                            ->setAttr('name', 'totalQs')
                            ->setAttr('value', $totalQ)
                            ->get();
                            
        $cardContentBody .= (new Tag('input'))
                            ->setAttr('type', 'hidden')
                            ->setAttr('name', 'currQNo')
                            ->setAttr('value', $currQ)
                            ->get();
        
        foreach ($questionData['s'] as $key => $answerOption) {

            $answerDiv = new Tag('div');
            $answerDiv->setAttr('class', 'form-check');

            $answerDivContent = '';
            
            $answerDivContent .= (new Tag('label'))
                                ->setText($answerOption)
                                ->setAttr('class', 'form-check-label')
                                ->setAttr('for', 'radio' . $key+1)
                                ->get();

            $answerDivContent .= (new Tag('input'))
                                ->setAttr('class', 'form-check-input')
                                ->setAttr('id', 'radio' . $key+1)
                                ->setAttr('type', 'radio')
                                ->setAttr('name', 'radio')
                                ->setAttr('value', $key+1)
                                ->get();

            $answerDiv->setText($answerDivContent);

            $cardContentBody .= $answerDiv->get();
        }

        $cardContent->setText($cardContentBody);

        $cardHtml .= $cardContent->get();


        return $cardHtml;
    }
}