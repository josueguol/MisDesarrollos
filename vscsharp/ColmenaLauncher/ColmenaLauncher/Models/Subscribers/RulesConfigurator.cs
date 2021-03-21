using System;
using System.Collections.Generic;
using System.IO;
using System.Xml.Serialization;

namespace ColmenaLauncher.Models.Subscribers
{
    [Serializable]
    [XmlRoot("Configuration")]
    public class RulesConfigurator
    {
        private static ColmenaLogger logger = null;
        private RulesConfigurator rulesConfig;

        public RulesConfigurator()
        {
            logger = new ColmenaLogger(this.GetType().ToString());
        }

        public static RulesConfigurator Load(string rulesPath, int trie = 0)
        {
            logger = new ColmenaLogger(typeof(RulesConfigurator).ToString());
            logger.SetInfo(string.Format("Cargando reglas publicación: {0}", rulesPath));

            var tries = 5;
            var count = trie;

            try
            {
                XmlSerializer serializer = new XmlSerializer(typeof(RulesConfigurator));

                var fs = new FileStream(rulesPath, FileMode.Open, FileAccess.Read, FileShare.ReadWrite);
                using (var reader = new StreamReader(fs))
                {
                    return (RulesConfigurator)serializer.Deserialize(reader);
                }
            }
            catch (Exception e)
            {
                logger.SetWarn(string.Format("{0}", e.Message));
                if (e.InnerException != null)
                {
                    logger.SetWarn(string.Format("{0}", e.InnerException.Message));
                }

                if (count++ < tries)
                {
                    logger.SetInfo(string.Format("Intentando cargar nuevamente, intento {0} de {1}", count, tries));
                    Random random = new Random();

                    System.Threading.Thread.Sleep(random.Next(300, 1000));
                    return RulesConfigurator.Load(rulesPath, count);
                } else
                {
                    return null;
                }
            }
        }

        [XmlAttribute]
        public string RootPath { get; set; }

        [XmlAttribute]
        public string FlowPath { get; set; }

        [XmlElement]
        public List<ConfigPath> ConfigPath { get; set; }
    }

    public class ConfigPath
    {
        [XmlElement]
        public Created Created { get; set; }

        [XmlElement]
        public Created Modified { get; set; }

        [XmlElement]
        public Created Deleted { get; set; }
    }

    public class Created
    {
        [XmlElement]
        public List<Evaluate> Evaluate { get; set;}
    }

    public class Modified
    {
        [XmlElement]
        public List<Evaluate> Evaluate { get; set;}
    }

    public class Deleted
    {
        [XmlElement]
        public List<Evaluate> Evaluate { get; set;}
    }

    public class Evaluate 
    {
        [XmlAttribute]
        public string Path { get; set; }

        [XmlAttribute]
        public bool Enable { get; set; }

        [XmlAttribute]
        public string FileTypes { get; set; }

        [XmlElement]
        public List<Process> Process { get; set; }
    }

    public class Process
    {
        [XmlAttribute]
        public string Name { get; set; }

        [XmlAttribute]
        public string Description { get; set; }

        [XmlAttribute]
        public string Overwrite { get; set; }

        [XmlAttribute]
        public string Enable { get; set; }

        [XmlAttribute]
        public string Multiple { get; set; }

        [XmlAttribute]
        public string Hide { get; set; }

        [XmlAttribute]
        public string TaskFile { get; set; }

        [XmlText]
        public string Params { get; set; }
    }
}