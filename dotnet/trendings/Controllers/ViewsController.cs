using System.Collections.Generic;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;
using Trendings.Models;

namespace Trendings.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class ViewsController : ControllerBase
    {
        private readonly ILogger<SearchController> _logger;

        public ViewsController(ILogger<SearchController> logger)
        {
            _logger = logger;
        }

        [HttpPost]  
        public IActionResult Post([FromBody] View view)
        {  
            EntryStoreContext context = HttpContext.RequestServices.GetService(typeof(EntryStoreContext)) as EntryStoreContext;
            context.SetView(view);
            
            return Ok();
        }
    }
}