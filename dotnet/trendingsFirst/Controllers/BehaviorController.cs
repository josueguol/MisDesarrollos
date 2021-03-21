using System.Collections.Generic;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;
using Trendings.Models;

namespace Trendings.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class BehaviorController : ControllerBase
    {
        private readonly ILogger<SearchController> _logger;

        public BehaviorController(ILogger<SearchController> logger)
        {
            _logger = logger;
        }

        [HttpGet]
        public List<Entry> Get(SearchPayload payload)
        {  
            EntryStoreContext context = HttpContext.RequestServices.GetService(typeof(EntryStoreContext)) as EntryStoreContext;
  
            return context.GetBehavior(payload.Phrase);
        }


        [HttpPost]  
        public IActionResult Post([FromBody] View view)
        {  
            EntryStoreContext context = HttpContext.RequestServices.GetService(typeof(EntryStoreContext)) as EntryStoreContext;
            context.SetBehavior(view);

            return Ok();
        }
    }
}