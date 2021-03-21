using System.IO;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;
using RegisterADN40.Models;

namespace RegisterADN40.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class ReportController : ControllerBase
    {
        private readonly ILogger<ReportController> _logger;

        public ReportController(ILogger<ReportController> logger)
        {
            _logger = logger;
        }

        [HttpGet("DownloadFile")]
        public IActionResult DownloadFile()
        {
            ContactRegisterContext context = HttpContext.RequestServices.GetService(typeof(ContactRegisterContext)) as ContactRegisterContext;

            // string mimeType = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
            string mimeType = "application/octet-stream";
            var result = context.GetContacts();

            var file = context.ReadToEnd(result.Value);

            //return File(result.Value, mimeType, result.Key);
            return new FileContentResult(file, mimeType)
            {
                FileDownloadName = result.Key
            };
        }
    }
}