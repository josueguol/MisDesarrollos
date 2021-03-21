using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace TestMD5
{
    class Program
    {
        static void Main(string[] args)
        {
            var md5Generator = new MD5Generator.MD5Generator();

            var hash = md5Generator.GetMD5(@"\aasdasd\asd\asdasd.xml");

            Console.WriteLine(hash);

            Console.ReadKey();

        }
    }
}
