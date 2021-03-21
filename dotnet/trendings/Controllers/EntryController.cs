using System.Collections.Generic;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;
using Trendings.Models;

namespace Trendings.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class EntryController : ControllerBase
    {
        private readonly ILogger<EntryController> _logger;

        public EntryController(ILogger<EntryController> logger)
        {
            _logger = logger;
        }

        [HttpGet]
        public List<Entry> Get()
        {
            EntryStoreContext context = HttpContext.RequestServices.GetService(typeof(EntryStoreContext)) as EntryStoreContext;
  
            return context.GetAllEntries();
        }

        [HttpPost]  
        public IActionResult Post([FromBody] Entry entry)
        {  
            EntryStoreContext context = HttpContext.RequestServices.GetService(typeof(EntryStoreContext)) as EntryStoreContext;
            context.SetEntry(entry);
            
            return Ok();
        }
    }
}