using System.IO;
using System.Xml.Serialization;

namespace Mcms.Models
{
    public class Navigation
    {
        private NavigationMenu _navigatorMenu;

        public Navigation(string navigationPath)
        {
            XmlSerializer serializer = 
            new XmlSerializer(typeof(NavigationMenu));

            using (Stream reader = new FileStream(navigationPath, FileMode.Open))
            {
                _navigatorMenu = (NavigationMenu)serializer.Deserialize(reader);          
            }
        }

        public NavigationMenu LoadNavigatorMenu()
        {
            return _navigatorMenu;
        }

    }
}
