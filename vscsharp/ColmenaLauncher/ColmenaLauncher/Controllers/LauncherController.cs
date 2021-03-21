using System.Web.Http;
using ColmenaLauncher.Models;

namespace ColmenaLauncher.Controllers
{
    public class LauncherController : ApiController
    {
        [HttpPost]
        public Notification Notify([FromBody] Notification data)
        {
            var logger = new ColmenaLogger(this.GetType().ToString());
            logger.SetInfo(string.Format("FlowPath: {0}, Item: {1}, Event: {2}", data.FlowPath, data.Item, data.Event));

            var launcher = new Launcher(data);

            return data;
        }
    }
}
