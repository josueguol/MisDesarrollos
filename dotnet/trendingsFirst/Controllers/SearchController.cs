using System.Collections.Generic;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;
using Trendings.Models;

namespace Trendings.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class SearchController : ControllerBase
    {
        private readonly ILogger<SearchController> _logger;

        public SearchController(ILogger<SearchController> logger)
        {
            _logger = logger;
        }

        [HttpGet]
        public string Get()
        {  
            return "Ok";
        }

        [HttpPost]  
        public List<Entry> Post([FromBody] SearchPayload payload)  
        {  
            SearchEntriesContext context = HttpContext.RequestServices.GetService(typeof(SearchEntriesContext)) as SearchEntriesContext;
            var result = context.Search(payload);

            return result;
        }
    }
}