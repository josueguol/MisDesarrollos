using System.Collections.Generic;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;
using Trendings.Models;

namespace Trendings.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class TrendingController : ControllerBase
    {
        private readonly ILogger<SearchController> _logger;

        public TrendingController(ILogger<SearchController> logger)
        {
            _logger = logger;
        }

        [HttpGet]
        public List<Trending> Get()
        {  
            EntryStoreContext context = HttpContext.RequestServices.GetService(typeof(EntryStoreContext)) as EntryStoreContext;
  
            return context.GetTrendings();
        }

        [HttpPost]  
        public IActionResult Post()
        {  
            EntryStoreContext context = HttpContext.RequestServices.GetService(typeof(EntryStoreContext)) as EntryStoreContext;
            context.SetTrendings();
            
            return Ok();
        }
    }
}