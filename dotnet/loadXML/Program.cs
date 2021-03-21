using System;

namespace loadXML
{
    class Program
    {
        static void Main(string[] args)
        {
            var url = LoadUrlRSS("https://anchor.fm/s/2e5d6e38/podcast/rss");

            Console.WriteLine("Bye.");
        }

        public static System.Xml.XPath.XPathNodeIterator LoadUrlRSS(string url) {
            string xmlStr;
            System.Net.ServicePointManager.SecurityProtocol = System.Net.SecurityProtocolType.Tls | System.Net.SecurityProtocolType.Tls11 | System.Net.SecurityProtocolType.Tls12;

            using (var wc = new System.Net.WebClient())
            {
                xmlStr = wc.DownloadString(url);
            }

            var ini = DateTime.Now;
            System.Xml.XmlDocument xmlDoc = new System.Xml.XmlDocument();
            xmlDoc.LoadXml(xmlStr);

            var fin = DateTime.Now;
            var total = new TimeSpan(fin.Ticks - ini.Ticks);

            var msg = string.Format("[INFO] - Documento: {0}; Tiempo de carga: {1}", url, total);
            //Log(msg);

            return xmlDoc.CreateNavigator().Select("/*");
        }

    }
}
