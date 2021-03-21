using NLog;
using NLog.Targets;
using System.Configuration;

namespace ColmenaLauncher.Models
{
    public class ColmenaLogger
    {
        private Logger logger = LogManager.GetLogger("ColmenaLauncher");

        public ColmenaLogger()
        {
            setNLogConfig();
        }

        public ColmenaLogger(string sourceLogger)
        {
            logger = LogManager.GetLogger(sourceLogger);
            setNLogConfig();
        }

        public void SetInfo(string message)
        {
            logger.Info(message);
        }

        public void SetWarn(string message)
        {
            logger.Warn(message);
        }

        public void SetDebug(string message)
        {
            logger.Debug(message);
        }


        private void setNLogConfig()
        {
            var logDir = ConfigurationManager.AppSettings.Get("NLogPath").Replace('/', '\\');
            
            foreach (var target in LogManager.Configuration.AllTargets)
            {
                if (target is FileTarget)
                {
                    var t = target as FileTarget;
                    var fn = t.FileName.ToString().Trim('\'').Replace("/", "\\").Replace(logDir, "");
                    t.FileName = logDir + fn;
                }
            }
        }
    }
}