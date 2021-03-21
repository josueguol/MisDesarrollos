using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;
using Mcms.Models;

namespace Mcms.Controllers
{
    [ApiController]
    [Route("[controller]")]
    public class NavigationController : ControllerBase
    {

        private readonly ILogger<NavigationController> _logger;

        public NavigationController(ILogger<NavigationController> logger)
        {
            _logger = logger;
        }

        [HttpGet]
        public NavigationMenu Get()
        {
            var navigation = new Navigation("/home/josueguol/Yandex.Disk/var/mcms/storage/data/gui/NavigationMenu.xml");

            return navigation.LoadNavigatorMenu();
        }
    }
}
