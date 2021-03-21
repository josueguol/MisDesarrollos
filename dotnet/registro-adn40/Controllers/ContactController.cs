using System;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;
using RegisterADN40.Models;
using RegisterADN40.Models.Entities;

namespace RegisterADN40.Controllers
{
    [ApiController]
    [Route("api/[controller]")]
    public class ContactController : ControllerBase
    {
        private readonly ILogger<ContactController> _logger;

        public ContactController(ILogger<ContactController> logger)
        {
            _logger = logger;
        }

        [HttpGet]
        public string Get()
        {  
            return "Hola. :)";
        }

        [HttpPost]
        public IActionResult Post([FromBody] Contact contact)
        {
            ContactRegisterContext context = HttpContext.RequestServices.GetService(typeof(ContactRegisterContext)) as ContactRegisterContext;

            var date = DateTime.Now;
            contact.FechaRegistro = date;
            
            context.SetContact(contact);

            return Ok();
        }
    }
}