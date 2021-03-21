using System;

namespace Cryptos
{
    class Program
    {
        static void Main(string[] args)
        {
            var command = args[0];
            var strToEncDec = args[1];
            var passphrase = args[2];

            Console.WriteLine("Argumentos: · " + args.Length);
            Console.WriteLine("Comando: ···· " + command);
            Console.WriteLine("Cadena: ····· " + strToEncDec);
            Console.WriteLine("Frase: ······ " + passphrase);

            switch (command)
            {
                case "-d":
                    Console.WriteLine("Desencriptando...");
                    Console.WriteLine(EncryptedString.DecryptString(strToEncDec, passphrase));
                    break;
                case "-e":
                    Console.WriteLine("Encriptando...");
                    Console.WriteLine(EncryptedString.EncryptString(strToEncDec, passphrase));
                    break;
                default:
                    Console.WriteLine("Falta especificar el destino de la entrada");
                    break;
            }

            Console.ReadKey();
        }
    }
}
