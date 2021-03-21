using ColmenaLauncher.Models.Subscribers;
using System.Configuration;

namespace ColmenaLauncher.Models
{
    public class Launcher
    {
        private string rulesDirectory = ConfigurationManager.AppSettings.Get("RulesConfigDirectory").Replace('/', '\\');
            /*System.Reflection.Assembly.GetEntryAssembly().Location.Substring(0,
                System.Reflection.Assembly.GetEntryAssembly().Location.LastIndexOf('\\'));*/
        private string rulesConfiguratorFile = "Rules.xml";
        private ColmenaLogger logger = null;
        private RulesConfigurator rc;

        public Launcher(Notification notification)
        {
            logger = new ColmenaLogger(this.GetType().ToString());
            logger.SetInfo(string.Format("FlowPath: {0}, Item: {1}, Event: {2}", notification.FlowPath, notification.Item, notification.Event));

            //TODO: Leer reglas
            loadRules();

            //TODO: Lanzar
            launch(notification);
        }

        private void loadRules()
        {
            rc = RulesConfigurator.Load(rulesDirectory + "\\" + rulesConfiguratorFile);
        }

        private void launch(Notification notification)
        {
            switch (notification.Event)
            {
                case "created":
                    break;
                case "deleted":
                    break;
                case "modified":
                    break;
                default:
                    logger.SetWarn(string.Format("Event \"{0}\" not found.", notification.Event));
                    break;
            }

            logger.SetInfo("Lanzando en ...");
        }
    }
}