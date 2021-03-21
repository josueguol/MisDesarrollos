using RestSharp;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;

namespace ConsoleApplication1
{
    class Program
    {
        static void Main(string[] args)
        {
           // Console.WriteLine(_getTwitter());
           // _getRestTweet();
            _getWebClient();
            Console.ReadKey();
        }

        private static string _getTwitter()
        {
            string json = "";

            var webrequest = (HttpWebRequest)WebRequest.Create("https://publish.twitter.com/oembed?url=https://twitter.com/Gizmodo/status/1156389144576364544");

            webrequest.Method = "GET";

            using (var response = webrequest.GetResponse())
            {
                var streamReader = new StreamReader(response.GetResponseStream(), Encoding.UTF8);
                json = streamReader.ReadToEnd();
            }

            return json;
        }
            
        private static void _getRestTweet()
        {
            var client = new RestClient("https://publish.twitter.com/oembed?url=https%3A%2F%2Ftwitter.com%2FGizmodo%2Fstatus%2F1156389144576364544");
            var request = new RestRequest(Method.GET);
            request.AddHeader("postman-token", "bae5e973-401e-0892-5a7a-4891f156f304");
            request.AddHeader("cache-control", "no-cache");
            IRestResponse response = client.Execute(request);
        }

        private static void _getWebClient()
        {
            var client = new WebClient();
            var content = client.DownloadString("https://publish.twitter.com/oembed?url=https://twitter.com/Gizmodo/status/1156389144576364544");
        }
    }
}
