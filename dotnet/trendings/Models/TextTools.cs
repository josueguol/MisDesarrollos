using System;
using System.Collections.Generic;
using System.Linq;
using System.Text.RegularExpressions;

namespace Trendings.Models
{
    public class TextTools
    {
        private static List<string> pronoun = new List<string>(new string[]
        {
            "yo", "tu", "el", "nosotros", "vosotros", "ello", "ellos", "me", "te", "se", "nos", "os", "la", "las", "lo", "los", "mi", "ti", "si", "le", "lo", "la",
            "este", "esta", "ese", "aquel", "esto", "estos", "esos", "esas", "estas", "aquellos", "aquellas", "esta", "que", "quien", "cuyo", "cual", "cuantos",
            "mio", "tuyo", "suyo", "nuestro", "vuestro", "que", "quien", "cuanto", "cual", "donde", "del", "al", "su"
        });

        private static List<string> adverb = new List<string>(new string[]
        {
            "aqui", "ahi", "aca", "alla", "alli", "lejos", "cerca", "asi", "bien", "mal", "ayer", "nunca", "hoy", "jamas", "siempre", "veces",
            "quizas", "tal vez", "acaso", "mucho", "poco", "bastante", "demasiado", "si", "no", "un", "uno", "una",  "ya", "entro", "entra"
        });

        private static List<string> verbs = new List<string>(new string[]
        {
            "hay", "haber", "se", "ser", "estar"
        });

        private static List<string> preposition = new List<string>(new string[]
        {
            "a", "ante", /*"bajo",*/ "cabe", "con", /*"contra",*/ "de", "desde", "en", "entre", "hacia", "hasta",
            "para", "por", "segun", "sin", "so", /*"sobre",*/ "tras"
        });

        private static List<string> conjuntion = new List<string>(new string[]
        {
            "y", "e", "ni",
            "o", "u",
            "pero", "mas", "sino",
            "aunque",
            "porque", "pues",
            // "si"  Existe como advervio, aun que gramaticamente son diferentes
            "tan", "tanto", "que", "como",
            "luego",
            "para"
        });

        private static List<string> interjections = new List<string>(new string []
        {
            "eh", "ah", "ay", "hola", "oye", "oh", "vamos", "anda", "vaya", "ojala"
        });
        private static List<string> numbers = new List<string>(new string []
        {
            "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"
        });

        private static List<string> symbols = new List<string>(new string[]
        {
            "(", ")", "¡", "!", "¿", "?", "\"", "#", "$", "%", "&", "/", "\\", "'", "°", "|", "¬", "~", "*", "+", "=", "'",
            "{", "}", ".", "^", "[", "]", "-", ",", ":", ";", "_", "`", "@", "€", "æ", "–", "“", "”", "’"
        });

        private static List<string> mostException = new List<string>(new string[]
        {
            "presenta", "llega", "llamado", "nuevas", "sobre", "deja", "mil", "registro", "actualmente", "actual", "registra", 
        });

        private static string patternA = "[á|à|ä|â]";

        private static string patternE = "[é|è|ë|ê]";

        private static string patternI = "[í|ì|ï|î]";

        private static string patternO = "[ó|ò|ö|ô]";

        private static string patternU = "[ú|ù|ü|û]";

        public static string MagicWords(string phrase)
        {
            var wordsInTheBucket = new Dictionary<string, string>();

            phrase = phrase.Replace("\r\n", " ").Replace("\n", " "); // --------- Elimina saltos de linea
            var allPhraseWords = phrase.Split(' '); // -------------------------- Separa todas las palabras

            // Elimina "pronoun", "adverb", "preposition", "conjuntion", "interjections"
            foreach(var word in allPhraseWords)
            {
                var w = word.ToLower();
                w = RemoveAccents(w);

                foreach(var symbol in symbols)
                {
                    w = w.Replace(symbol, "");
                }

                foreach(var num in numbers)
                {
                    w = w.Replace(num, "");
                }

                var exist = false;

                exist = pronoun.Contains(w) || adverb.Contains(w) || preposition.Contains(w) || conjuntion.Contains(w) ||
                        interjections.Contains(w) || verbs.Contains(w);

                if (!exist && !wordsInTheBucket.ContainsKey(w) && !string.IsNullOrEmpty(w) && w.Length > 1)
                {
                    wordsInTheBucket.Add(w, "");
                }
            }

            var wordArray = wordsInTheBucket.Keys.ToArray();

            // Array.Sort(wordArray, StringComparer.InvariantCulture);

            return string.Join(' ', wordArray);
        }

        public static string MostWords(string phrase)
        {
            phrase = phrase.Replace("\r\n", " ").Replace("\n", " "); // --------- Elimina saltos de linea
            var allPhraseWords = phrase.Split(' '); // -------------------------- Separa todas las palabras

            // Elimina "pronoun", "adverb", "preposition", "conjuntion", "interjections"
            Dictionary<string, int> mostWords = new Dictionary<string, int>();
            foreach(var word in allPhraseWords)
            {
                var w = word.ToLower();
                w = RemoveAccents(w);

                foreach(var symbol in symbols)
                {
                    w = w.Replace(symbol, "");
                }

                foreach(var num in numbers)
                {
                    w = w.Replace(num, "");
                }

                var exist = false;

                exist = pronoun.Contains(w) || adverb.Contains(w) || preposition.Contains(w) || conjuntion.Contains(w) ||
                        interjections.Contains(w) || verbs.Contains(w) || mostException.Contains(w);
                
                if (!exist && mostWords.ContainsKey(w) && !string.IsNullOrEmpty(w) && w.Length > 1)
                {
                    int counter = 0;
                    mostWords.TryGetValue(w, out counter);
                    counter++;
                    mostWords[w] = counter;
                }
                else if (!exist && !mostWords.ContainsKey(w) && !string.IsNullOrEmpty(w) && w.Length > 1)
                {
                    mostWords.Add(w, 1);
                }
            }

            var sortMostWord = mostWords.ToList();
            string[] orderMostWord = new string[9];
            int i = 0;
            foreach (var word in sortMostWord.OrderByDescending( word => word.Value))
            {
                if (i+1 > orderMostWord.Length)
                {
                    break;
                }

                orderMostWord[i] = word.Key;
                i++;
            }

            return string.Join(' ', orderMostWord);
        }

        public static string ToLinkString(string text)
        {
            var link = text.ToLower();
            link = RemoveAccents(link);

            foreach(var symbol in symbols)
            {
                link = link.Replace(symbol, "-");
            }

            link = link.Replace("ñ", "n");
            link = link.Replace(" ", "-");

            return link;
        }

        public static string RemoveAccents(string word)
        {
            var w = word;
            w = Regex.Replace(w, patternA, "a");
            w = Regex.Replace(w, patternE, "e");
            w = Regex.Replace(w, patternI, "i");
            w = Regex.Replace(w, patternO, "o");
            w = Regex.Replace(w, patternU, "u");

            return w;
        }
    }
}