using System.Collections.Generic;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;

namespace s3editor.Controllers
{
    [ApiController]
    [Route("[controller]")]
    public class EjemploController : ControllerBase
    {

        private readonly ILogger<EjemploController> _logger;

        public EjemploController(ILogger<EjemploController> logger)
        {
            _logger = logger;
        }

        [HttpGet]
        public Ejemplo Get()
        {
            var ejemplo = new Ejemplo();

            ejemplo.SetNombre("Juan");
            ejemplo.Summary = "asd sadsa dsa dsa dsa";

            return ejemplo;
        }
    }
}
