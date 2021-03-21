using Newtonsoft.Json;
using Newtonsoft.Json.Linq;

namespace ColmenaLauncher.Models
{
    public class Notification
    {
        [JsonProperty(PropertyName = "status")]
        public bool Status;

        [JsonProperty(PropertyName = "statusCode")]
        public string StatusCode;

        [JsonProperty(PropertyName = "event")]
        public string Event;

        [JsonProperty(PropertyName = "flowPath")]
        public string FlowPath;

        [JsonProperty(PropertyName = "item")]
        public string Item;

        [JsonProperty(PropertyName = "processId")]
        public string ProcessID;

        [JsonProperty(PropertyName = "processName")]
        public string ProcessName;
        
        [JsonProperty(PropertyName = "data")]
        public JObject Data;
    }
}