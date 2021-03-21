using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace MD5Generator
{
    public class MD5Generator
    {
        public string GetMD5(string someString)
        {
            using (var md5 = System.Security.Cryptography.MD5.Create())
            {
                byte[] data = md5.ComputeHash(Encoding.UTF8.GetBytes(someString));
                var hash = BitConverter.ToString(md5.ComputeHash(data)).Replace("-", "");

                return hash;
            }
        }
    }
}
