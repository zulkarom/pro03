<?php

namespace ijeob\models;

use Yii;
use backend\modules\journal\models\Article;

class Citation
{
	public static function bibtext($id){
		$model = Article::findOne($id);
		$str = $model->authorString('-');
		$firstau = explode(' ', $str);
		$firstau = strtolower($firstau[0]);
		$first_title = explode(' ', $model->title);
		$first_title = strtolower($first_title[0]);
		$year = date('Y', strtotime($model->journal_at));
		$ref = $firstau.$year.$first_title;
		
		//authors
		$list = $model->articleAuthors;
		$str = '';
		if($list){
			$total = count($list);
			$i = 1;
			foreach($list as $au){
				$sep = $i == $total ? '' : ' and ';
				$str .= $au->lastname . ', ' . $au->firstname . $sep;
			$i++;
			}
		}
		
		$authors = $str;
		
		$name = $ref . ".bib"; 
		header('Content-Disposition: attachment; filename="' . $name . '"');
		header('Expires: 0'); 
		
		

		// use echo for testing purposes only
		// cause echo considered as a content of your file


$text = "@article{".$ref.",
	title={".$model->title ."},
	author={" . $authors . "},
	journal={".$model->journal->journalName ."},
	volume={37},
	number={2},
	pages={167--201},
	year={2004}
}"; 
		

		$fp = fopen($name, 'a');
		fwrite($fp, $text);
		fclose($fp);   // don't forget to close file for saving newly added data

		readfile($name);   // readfile takes a filename, not a handler.
	   
	}
	
}
