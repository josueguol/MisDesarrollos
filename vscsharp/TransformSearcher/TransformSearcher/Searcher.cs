using FileSearch;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Xml;
using System.Xml.XPath;

namespace TransformSearcher
{
    public class Searcher
    {

        private XPathSearch xSearch = new XPathSearch();

        public Searcher() { }

        public string Search(string path, string query, string order, string ordering, int top)
        {
            var xmls = top == 0
                ? xSearch.Search(path, query, new KeyValuePair<string, string>(ordering, order))
                : xSearch.Search(path, query, new KeyValuePair<string, string>(ordering, order), top);

            /*var xmlDoc = new XmlDocument();
            xmlDoc.AppendChild(xmlDoc.CreateElement("Xmls"));

            using (XmlWriter writer = xmlDoc.DocumentElement.CreateNavigator().AppendChild())
            {
                foreach (string xml in xmls)
                {
                    writer.WriteStartElement("Xml");
                    writer.WriteString(xml);
                    writer.WriteEndElement();
                }
            }

            return xmlDoc.DocumentElement.CreateNavigator().Select("Xml");*/

            return string.Join("|", xmls);
        }
    }
}
