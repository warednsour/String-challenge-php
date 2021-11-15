<?php

/******
 * This is a Jawaker Assesment from Coderbyte.com
 * level HARD
 *
 * Task: StringChallenge(str)
 *
 *  Have the function StringChallenge(str) read str
 *  which will contain two strings separated by a space.
 *  The first string will consist of the following sets of characters: +, *, $, and {N} which is optional.
 *  The plus (+) character represents a single alphabetic character,
 *  the ($) character represents a number between 1-9,
 *  and the asterisk (*) represents a sequence of the same character of length 3 unless it is followed by {N}
 *  which represents how many characters should appear in the sequence where N will be at least 1.
 *  Your goal is to determine if the second string exactly matches the pattern of the first string in the input.
 *  For example: if str is "++*{5} jtggggg" then the second string in this case does match the pattern,
 *  so your program should return the string true.
 *  If the second string does not match the pattern your program should return the string false.
 *  Examples
 *  Input: "+++++* abcdehhhhhh"
 *  Output: false
 *  Input: "$**+*{2} 9mmmrrrkbb"
 *  Output: true
 *
*/

$str = "+++++***{2}+ abcdehhhhhhxxx"; //true
$str1 = "++*{4} 23ssss"; //true
$str2 = "++$$*++**{2} we23pppreeeeww"; //true
$str3 = "+++++* abcdehhhhhh"; //false
function StringChallenge($str)
{
    //First thing we do here is to sperate the two strings in one array.
    $exploded = explode(' ', $str);
    //We count the elements inside the array.
    $countExploded = count($exploded);
    //If it's two strings then we are good.
    if ($countExploded > 2) return false;
    $firstString = $exploded[0];
    $secondString = $exploded[1];
    //Then we seperate each character from each string into two arrays.
    $splitFirst = str_split($firstString);
    $splitSecond = str_split($secondString);
    //We loop inside the first array(first string where the pattren with this following logic)
    //$i is for looping inside the first string, $j for looping inside the second string
    //I solved this by making a point system and it goes like this:
    //I take each character from first string and check what it's.
    //If it's a (+) and it's a letter in the first character from second string then we can move to check the next character.
    //And we add 1 to each matching pattren with a character.
    // j for counting characters second string.
    $j = 0;

    //Point checker
    $pointCheck = 0;
    for ($i = 0;$i < count($splitFirst);$i++)
    {
        //To avoid "warning undefined array key"
        if ($i < count($splitFirst) && $i + 1 != count($splitFirst))
        {
            if ($splitFirst[$i] == '*')
            {

                //Check if '*' is not the last character.
                

                //Check if after the * there is a {  and Check if after the number there is a }
                

                if ($splitFirst[$i + 1] == '{' && preg_match('/[0-9]/', $splitFirst[$i + 2]) && $splitFirst[$i + 3] == '}')
                {
                    $number = $splitFirst[$i + 2];
                    $pointCheck = $pointCheck + $number;
                }
            }

            if ($splitFirst[$i] == '*' && $splitFirst[$i + 1] != '{')
            {
                $secondLetter = $j + 1;
                $thirdLetter = $j + 2;
                //Check if the $j is not the last character , this line of code to not fall in warning Undifinded Array;
                if ($thirdLetter < count($splitSecond))
                {
                    if ($splitSecond[$j] == $splitSecond[$secondLetter] && $splitSecond[$secondLetter] == $splitSecond[$thirdLetter])
                    {
                        $j = $j + 3;
                        $pointCheck = $pointCheck + 3;

                    }
                }
            }
        }
        if ($splitFirst[$i] == '+' && preg_match("/[a-z]/", $splitSecond[$j]))
        {
            $j++;
            $pointCheck++;
        }
        elseif ($splitFirst[$i] == '+' && !preg_match("/[a-z]/", $splitSecond[$j]))
        {
            $pointCheck++;
        }

        if ($splitFirst[$i] == '$' && preg_match('/[0-9]/', $splitSecond[$j]))
        {
            $j++;
            $pointCheck++;
        }
        elseif ($splitFirst[$i] == '$' && !preg_match('/[0-9]/', $splitSecond[$j]))
        {
            $pointCheck++;
        }
    }

    if (count($splitSecond) == $pointCheck)
    {
        return "true";
    }
    else
    {
        return "false";
    }
}

echo StringChallenge($str3);

