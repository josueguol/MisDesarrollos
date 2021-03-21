using System;
using System.Collections.Generic;
using System.Xml.Serialization;

namespace Mcms.Models
{
    [XmlRoot]
    public class NavigationMenu
    {
        [XmlElement]
        public List<Menu> Menu { get; set; } 
    }

    public class Menu
    {
        [XmlIgnore]
        public bool Divider { get; set; }

        [XmlElement("Divider")]
        public string DividerElement
        {
            set
            {
                Divider = (value.ToLower() == "true") ? true : false;
            }
            get
            {
                return Divider.ToString();
            }
        }

        [XmlIgnore]
        public bool Title { get; set; }

        [XmlElement("Title")]
        public string TitleElement
        {
            set
            {
                Title = (value.ToLower() == "true") ? true : false;
            }
            get
            {
                return Title.ToString();
            }
        }

        [XmlElement]
        public string Name { get; set; }

        [XmlElement]
        public Wrapper Wrapper {get; set; }

        [XmlElement]
        public string Url { get; set; }

        [XmlElement]
        public string Icon { get; set; }

        [XmlElement]
        public Badge Badge { get; set; }

        [XmlElement]
        public string Class { get; set; }

        [XmlElement]
        public string Variant { get; set; }

        [XmlElement]
        public Attributes Attributes { get; set; }

        [XmlArray]
        public List<Menu> Children { get; set; }
    }

    public class Badge
    {
        [XmlElement]
        public string Variant { get; set; }

        [XmlElement]
        public string Text { get; set; }
    }

    public class Wrapper
    {
        [XmlElement]
        public string Element { get; set; }

        [XmlElement]
        public Attributes Attributes { get; set; }
    }

    public class Attributes
    {
        [XmlIgnore]
        public bool Disable { get; set; }

        [XmlElement("Disable")]
        public string DisableElement
        {
            set
            {
                Disable = (value.ToLower() == "true") ? true : false;
            }
            get
            {
                return Disable.ToString();
            }
        }

        [XmlElement]
        public string Target { get; set; }

        [XmlElement]
        public string Rel { get; set; }
    }
}