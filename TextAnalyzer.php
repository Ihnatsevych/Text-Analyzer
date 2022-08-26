<?php

class TextAnalyzer {

    private array $words; // analysis text variable as array with words
    private string $text; // analysis text variable

    //set the text for analysis
    public function __construct(string $text)
    {
        $this->text = $text; // set text to class string variable
        $this->words = preg_split("/[\s,]+/", $text); // split the text into separate words and set to text array variable

        //check for the number of permissible words in the text
        $count = $this->getWordsCount();
        if($count < 2){
            die("The number of words entered is $count! Please correct this.");
        }
    }

    // get count of words in the text
    public function getWordsCount()
    {
        return count($this->words);
    }

    // get count of symbols in the text
    public function getSymbolCount()
    {
        return mb_strlen($this->text);
    }

    // get count of symbols without spaces in the text
    public function getSymbolCountWithoutSpaces(): int
    {

        //calculate the number of letters in each word
        $count = 0;
        foreach ($this->words as $word){
            $count += mb_strlen($word);
        }

        return $count;
    }

    //calculate top of words in the text
    public function getTopWords(): array
    {

        //get count of words
        $top = $this->getCountForEachWord();

        //sort words
        $top = $this->sortTextArray($top);

        //slice top of array
        $top = $this->sliceTextArray($top);

        return $top;
    }

    //calculate numbers of each word
    private function getCountForEachWord(): array
    {
        $top = [];

        foreach ($this->words as $word){

            //set for new words in the text count 1, for another add 1 to count
            if(!array_key_exists($word, $top)){
                $top[$word] = 1;
            }else{
                $top[$word]++;
            }
        }

        return $top;
    }

    //sort text array by word's count in descending order
    private function sortTextArray(array $text): array
    {
        //sorting dictionary keys by value, then those with the same value alphabetically
        array_multisort(array_values($text), SORT_DESC, array_keys($text), SORT_ASC, $text);

        return $text;
    }

    //slice top of text array
    private function sliceTextArray(array $top): array
    {
        //if array has 5 or more words slice 5 words, else slice count of words
        $count = count($top);
        if($count >= 5){
            $top = array_slice($top, 0, 5);
        }else{
            $top = array_slice($top, 0, $count);
        }

        return $top;
    }

}

$text = "С другой стороны выбранный нами инновационный путь играет важную роль в формировании ключевых компонентов планируемого обновления! Разнообразный и богатый опыт консультация с профессионалами из IT способствует подготовке и реализации всесторонне сбалансированных нововведений. Не следует, однако, забывать о том, что выбранный нами инновационный путь в значительной степени обуславливает создание направлений прогрессивного развития.

Соображения высшего порядка, а также дальнейшее развитие различных форм деятельности позволяет выполнить важнейшие задания по разработке соответствующих условий активизации. Повседневная практика показывает, что сложившаяся структура организации способствует повышению актуальности существующих финансовых и административных условий. С другой стороны сложившаяся структура организации напрямую зависит от системы масштабного изменения ряда параметров. Повседневная практика показывает, что сложившаяся структура организации играет важную роль в формировании соответствующих условий активизации?

Равным образом постоянный количественный рост и сфера нашей активности представляет собой интересный эксперимент проверки соответствующих условий активизации! Повседневная практика показывает, что консультация с профессионалами из IT в значительной степени обуславливает создание позиций, занимаемых участниками в отношении поставленных задач! Практический опыт показывает, что социально-экономическое развитие играет важную роль в формировании существующих финансовых и административных условий? Разнообразный и богатый опыт социально-экономическое развитие представляет собой интересный эксперимент проверки системы масштабного изменения ряда параметров.
";

$text_analyzer = new TextAnalyzer($text);

$top = $text_analyzer->getTopWords();

echo "<pre>";
    print_r($top);
echo "</pre>";
