using System.Collections.Generic;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;
using Trendings.Models;

namespace Trendings.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class CubetizaController : ControllerBase
    {
        private readonly ILogger<SearchController> _logger;

        public CubetizaController(ILogger<SearchController> logger)
        {
            _logger = logger;
        }

        [HttpGet]
        public IActionResult Get()
        {  
            EntryStoreContext context = HttpContext.RequestServices.GetService(typeof(EntryStoreContext)) as EntryStoreContext;
  
            context.CubetizaAll();

            return Ok();
        }
    }
}