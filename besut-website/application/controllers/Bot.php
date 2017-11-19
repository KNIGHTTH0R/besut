<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bot extends Handler_Core {

	public function __construct()
	{
		parent::__construct();
    $this->load->model('words_processing');
  }

	function index()
	{
		$docs = $this->words_processing->getDocs('false', 'false', null);
		$doc = $this->cleanString($docs[0]->WEBCONTENT);
		// var_dump($doc);
		//echo passthru("python assets\\stemmer.py " . $doc);
	}

	// function calculating()
	// {
		// $variables = $this->words_processing->getBasicDictionaryVariables();
		// $totalDocs = $this->words_processing->getTotalDocs();
		// $nPositveDocs = $this->words_processing->getPositiveHoaxDocs();
		// $nClass = $this->words_processing->getSumClassDictionary();
		// $nNegativeDocs = $this->words_processing->getNegativeHoaxDocs();
		//
		// $docs = $this->words_processing->getDocs('false', 'false', null);
		// // print_r($docs);
		// foreach ($docs as $doc) {
		// 	$content = $this->cleanString($doc->WEBCONTENT);
		// 	$content = passthru("python assets\\stemmer.py " . $content);
		// 	$words = explode(' ', strtolower($doc));
		// 	$counts = array_count_values($words);
		// }




		// NAIVE BAYES
		// $vPositive = $nPositveDocs/$totalDocs;
		// $vNegative = $nNegativeDocs/$totalDocs;
		// $ntPositive = $nClass->nPositve + $totalDocs;
		// $ntNegative = $nClass->nNegative + $totalDocs;
		// foreach ($existedWords as $word) {
		// 	$pWord = pow((($word->positive + 1) / $ntPositive), $counts[$word->word]);
		// 	$nWord = pow((($word->negative + 1) / $ntNegative), $counts[$word->word]);
		// 	echo $word->word . ' positive = ' . $pWord . ' negative = ' . $nWord . "<br>";
		// 	$vPositive = $vPositive * $pWord;
		// 	$vNegative = $vNegative * $nWord;
		// }
		// // NAIVE BAYES
		// echo "<hr>Positive: " . $vPositive . " Negative: " . $vNegative;
		// echo $vPositive > $vNegative? " HOAX" : " BUKAN HOAX";
	// }

	// function updateDictionary()
	// {
	// 	$finalWord = array();
	//
  //   $docs = $this->words_processing->getDocs('false', 'false', null);
	//
  //   foreach ($docs as $doc) {
  //     $cleanWords = explode(' ', $this->cleanString($doc->WEBCONTENT));
	// 		$counts = array_count_values($cleanWords);
  //     foreach ($cleanWords as $word) {
	// 			if ($word != '')
	// 			{
	// 				$nhav = $doc->HOAXVAL?'positive':'negative';
	// 				if (array_key_exists($word, $finalWord)) {
	// 					$finalWord[$word][$nhav] += 1;
	// 					if (!strpos($finalWord[$word]['docs']))
	// 						$finalWord[$word]['docs'] .= ' , ' . $doc->IDREPORT;
	// 				}
	// 				else {
	// 					$nhval = $doc->HOAXVAL?1:0;
	// 					$nnval = $doc->HOAXVAL?0:1;
	// 					$finalWord[$word] = [
	// 						'word' => $word,
	// 						'positive' => $nhval,
	// 						'negative' => $nnval,
	// 						'docs' => $ID->IDREPORT
	// 					];
	// 				}
	// 			}
  //     }
	// 		echo "<hr>";
	// 		//echo $this->words_processing->setInDictionary($doc->IDREPORT);
	// 		echo "<hr>";
	//
  //   }
	// 	var_dump($finalWord);
  // }

  function updateDictionary()
	{
		$finalWord = array();
		$finalPositive = array();
		$finalNegative = array();

    $docs = $this->words_processing->getDocs('true', 'true', null);
		// $cnt = 0;
    foreach ($docs as $doc) {
			$cleanWords = '';
				$cleanWords = explode(' ', $this->cleanString($doc->WEBCONTENT));
				// echo $doc->IDREPORT;
				// echo '<br>';

      foreach ($cleanWords as $word) {
				if ($word != '')
				{
					if(array_key_exists($word, $finalWord))
					{
						if($doc->HOAXVAL == 1) $finalPositive[array_search($word, $finalWord)]++;
						else $finalNegative[array_search($word, $finalWord)]++;

						if(array_key_exists($doc->IDREPORT, $finalWord[$word]))
						{
							$finalWord[$word][$doc->IDREPORT]++;
						}
						else
						{
							$finalWord[$word][] = (int)$doc->IDREPORT;
							$finalWord[$word][$doc->IDREPORT] = 1;
						}
					}
					else
					{
						$finalWord[] = $word;
						$finalPositive[] = 0;
						$finalNegative[] = 0;
						$finalWord[$word][$doc->IDREPORT] = 1;
						if($doc->HOAXVAL == 1) $finalPositive[sizeof($finalPositive) - 1]++;
						else $finalNegative[sizeof($finalPositive) - 1]++;
					}
				}
      }

			// if($cnt == 75) break;
			// else $cnt++;
    }
		// echo sizeof($finalWord);
		// echo "<pre>";
		// var_dump($finalWord);
		// echo "</pre>";
		// echo sizeof($finalWord);

		$whereDoc = "";
		$countDoc = "";
		for($i = 0; $i < sizeof(array_keys($finalWord)) / 2; $i++)
		{
			foreach($finalWord[$finalWord[$i]] as $k => $val)
			{
				$whereDoc.= $k . ',';
				$countDoc.= $finalWord[$finalWord[$i]][$k] . ',';
			}
			// echo $finalPositive[$i] . " - ";
			// //insert
			// echo $finalWord[$i] . ": ";
			// echo $whereDoc . "||";
			// echo $countDoc . "<br>";
			$this->words_processing->newDictionary($finalWord[$i], $finalPositive[$i], $finalNegative[$i], $whereDoc, $countDoc);
			$whereDoc = "";
			$countDoc = "";
		}
		
		echo "done";
  }
}
